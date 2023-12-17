<?php
declare(strict_types=1);

namespace Queue\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;
use Cake\I18n\DateTime;
use Cake\Log\Log;
use Queue\Model\Table\QueuedJobsTable;

/**
 * RunWorker command.
 */
class RunWorkerCommand extends Command
{
    protected QueuedJobsTable $jobsTable;
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->setDescription('Run a single worker job via CRON');

        return $parser;
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->jobsTable = $this->fetchTable('Queue.QueuedJobs');
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        /** @var \Queue\Model\Entity\QueuedJob $job */
        $job = $this->jobsTable->find()->where(['not_before <=' => DateTime::now()])
            ->orderByAsc('not_before')
            ->orderByDesc('priority')
            ->first();

        Log::setConfig('queue', Configure::read('Queue.log'));

        Log::info('Running worker', 'queue');

        if ($job) {
            try {
                Log::info('Running job: ' . $job->reference, 'queue');
                $instance = new $job->reference;
                if (!$instance->execute($job->data)) {
                    $io->err('Job failed: ' . $job->reference);
        
                    return static::CODE_ERROR;
                }

                if ($instance->getRecure() > 0) {
                    $this->jobsTable->rerunJob($job, $instance->getRecure());
                } else {
                    $this->jobsTable->deleteOrFail($job);
                }
            } catch (\Exception $e) {
                $io->err('Job failed: ' . $job->reference);
                $io->err($e->getMessage());

                Log::error('Job failed: ' . $job->reference, 'queue');
                Log::error($e->getMessage(), 'queue');
                Log::debug($e->getTraceAsString(), 'queue');

                return static::CODE_ERROR;
            }
        } else {
            Log::info('Queue is empty', 'queue');

            return static::CODE_SUCCESS;
        }
        Log::info('Job finished: ' . $job->reference, 'queue');

        return static::CODE_SUCCESS;
    }
}

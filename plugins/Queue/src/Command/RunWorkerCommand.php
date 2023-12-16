<?php
declare(strict_types=1);

namespace Queue\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\DateTime;

/**
 * RunWorker command.
 */
class RunWorkerCommand extends Command
{
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

        return $parser;
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
        /** @var \Queue\Model\Table\QueuedJobsTable $jobsTable */
        $jobsTable = $this->fetchTable('Queue.QueuedJobs');

        /** @var \Queue\Model\Entity\QueuedJob $job */
        $job = $jobsTable->find()->where(['not_before <=' => DateTime::now()])
            ->orderByAsc('not_before')
            ->orderByDesc('priority')
            ->first();

        if (!$job) {
            $io->out('No jobs found');

            return static::CODE_SUCCESS;
        }

        if (!class_exists($job->reference)) {
            $io->err('Class not found: ' . $job->reference);

            return static::CODE_ERROR;
        }

        $io->out('Running job: ' . $job->reference);
        $instance = new $job->reference;

        if (!$instance->execute($job->data)) {
            $io->err('Job failed: ' . $job->reference);

            return static::CODE_ERROR;
        }

        if ($instance->getRecure() > 0) {
            $jobsTable->rerunJob($job, $instance->getRecure());
        } else {
            $jobsTable->deleteOrFail($job);
        }

        $io->out('Job finished: ' . $job->reference);

        return static::CODE_SUCCESS;
    }
}

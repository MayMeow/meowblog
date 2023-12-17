<?php
declare(strict_types=1);

namespace Queue\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\DateTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Queue\Model\Table\QueuedJobsTable;

/**
 * Worker command.
 */
class WorkerCommand extends Command
{
    use LocatorAwareTrait;

    protected int $tick = 10;
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

        $parser->setDescription('Run Worker as a service');

        $parser->addArgument('worker_id', [
            'help' => 'The worker ID',
            'required' => false,
        ]);

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
        $i = 0;
        $id = $args->getArgument('worker_id');
        $id = $id ?? uniqid();
        $this->jobsTable = $this->fetchTable('Queue.QueuedJobs');

        while (true) {
            if ($i % 1000 === 0) {
                gc_collect_cycles();
            }

            /** @var \Queue\Model\Entity\QueuedJob $job */
            $job = $this->jobsTable->find()->where(['not_before <=' => DateTime::now()])
                ->orderByAsc('not_before')
                ->orderByDesc('priority')
                ->first();

            if ($job) {
                try {
                    $io->out('Running job: ' . $job->reference . 'via worker: ' . $id);
                    $instance = new $job->reference;
                    if (!$instance->execute($job->data)) {
                        $io->err('Job failed: ' . $job->reference);
                    }

                    if ($instance->getRecure() > 0) {
                        $this->jobsTable->rerunJob($job, $instance->getRecure());
                    } else {
                        $this->jobsTable->deleteOrFail($job);
                    }
                } catch (\Exception $e) {
                    $io->err('Job failed: ' . $job->reference);
                }

                sleep($this->tick);
            } else {
                $io->out(sprintf('Worker %s is running...', $id));

                sleep($this->tick * 2);
            }
            $i++;
        }
    }
}

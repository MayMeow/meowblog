<?php
declare(strict_types=1);

namespace Queue\Job;

use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use Queue\Model\Table\QueuedJobsTable;

class CleanupJob implements QueuedJobInterface
{
    use LocatorAwareTrait;

    protected int $recure = 60;

    protected Table | QueuedJobsTable $queuedJobs;

    public function __construct()
    {
        $this->recure = 60;
        $this->queuedJobs = $this->fetchTable('Queue.QueuedJobs');
    }

    public function getRecure(): int
    {
        return $this->recure;
    }

    public function execute(?string $data = null): bool
    {
        $this->queuedJobs->deleteAll(['not_before IS' => null]);

        return true;
    }
}
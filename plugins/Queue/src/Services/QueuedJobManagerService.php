<?php
declare(strict_types=1);

namespace Queue\Services;

use Cake\Database\Query\SelectQuery;
use Cake\I18n\DateTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use Queue\Model\Table\QueuedJobsTable;
use Queue\Utils\QueuedJobPriority;

class QueuedJobManagerService implements QueuedJobManagerServiceInterface
{
    use LocatorAwareTrait;

    protected Table | QueuedJobsTable $queuedJobsTable;

    public function __construct()
    {
        $this->queuedJobsTable = $this->fetchTable('Queue.QueuedJobs');
    }

    public function getAll(): Table|SelectQuery
    {
        return $this->queuedJobsTable->find()->orderByDesc('priority')->orderByAsc('not_before');
    }

    public function enqueue(string $jobClass, array|object $data = [], QueuedJobPriority $priority = QueuedJobPriority::MEDIUM, ?int $recuring = null, ?int $postpone = null): bool
    {
        $newJob = $this->queuedJobsTable->newEmptyEntity();

        $newJob->reference = $jobClass;
        $newJob->priority = $priority->value;
        !empty($data) ? $newJob->data = serialize($data) : null;
        $newJob->not_before = $postpone === null ? DateTime::now() : DateTime::now()->addMinutes($postpone);

        if ($this->queuedJobsTable->save($newJob)) {
            return true;
        }

        return false;
    }
}
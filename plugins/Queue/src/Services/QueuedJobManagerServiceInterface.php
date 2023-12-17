<?php
declare(strict_types=1);

namespace Queue\Services;

use Cake\Database\Query\SelectQuery;
use Cake\ORM\Table;
use Queue\Utils\QueuedJobPriority;

interface QueuedJobManagerServiceInterface
{
    public function getAll(): Table|SelectQuery;

    public function enqueue(string $jobClass, array $data = [], QueuedJobPriority $priority = QueuedJobPriority::MEDIUM, ?int $recuring = null, ?int $postpone = null): bool;
}
<?php
declare(strict_types=1);

namespace Queue\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Locator\LocatorAwareTrait;
use Queue\Model\Entity\QueuedJob;
use Queue\Services\QueuedJobManagerService;
use Queue\Services\QueuedJobManagerServiceInterface;
use Queue\Utils\QueuedJobPriority;

/**
 * Queue component
 */
class QueueComponent extends Component
{
    use LocatorAwareTrait;
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    public function push(string $jobClass, array $data = [], QueuedJobPriority $priority = QueuedJobPriority::MEDIUM, ?int $recuring = null, ?int $postpone = null): QueuedJob
    {
        /** @var \Queue\Model\Table\QueuedJobsTable $queueJobTable */
        $queueJobTable = $this->fetchTable('Queue.QueuedJobs');

        return $queueJobTable->createJob($jobClass, $data, $priority, $recuring, $postpone);
    }
}

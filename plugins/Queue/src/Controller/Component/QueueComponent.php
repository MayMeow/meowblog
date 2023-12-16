<?php
declare(strict_types=1);

namespace Queue\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Queue\Services\QueuedJobManagerService;
use Queue\Services\QueuedJobManagerServiceInterface;
use Queue\Utils\QueuedJobPriority;

/**
 * Queue component
 */
class QueueComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    public function enqueueJob(string $jobClass, array|object $data = [], QueuedJobPriority $priority = QueuedJobPriority::MEDIUM, ?int $recuring = null, ?int $postpone = null): bool {
        $queuedJobsService = new QueuedJobManagerService();

        return $queuedJobsService->enqueue($jobClass, $data, $priority, $recuring, $postpone);
    }
}

<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use MeowBlog\Controller\AppController;
use Queue\Services\QueuedJobManagerServiceInterface;

class QueuedJobsController extends AppController
{
    public function index(QueuedJobManagerServiceInterface $queuedJobManagerService)
    {
        $this->Authorization->skipAuthorization();
        
        $this->set('queuedJobs', $this->paginate($queuedJobManagerService->getAll()));
    }
}
<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Api\Version1;

use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\View\JsonView;
use MeowBlog\Controller\AppController;
use MeowBlog\Services\NodesManagerServiceInterface;

class NodesController extends AppController
{
    public function viewClasses(): array
    {
        return [
            JsonView::class
        ];
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['all']);
    
    }

    public function all(NodesManagerServiceInterface $nodesManager)
    {
        $this->Authorization->skipAuthorization();

        /** @var SelectQuery $nodes */
        $nodes = $nodesManager->getAll($this->request, $this, paginate: false);
        $nodes->contain(['Users', 'Blogs', 'Tags']);
        
        $this->set('nodes', $nodes);
        $this->viewBuilder()->setOption('serialize', 'nodes');
    }
}
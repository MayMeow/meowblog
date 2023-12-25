<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Api\Version1;

use Cake\Event\EventInterface;
use Cake\View\JsonView;
use MeowBlog\Controller\AppController;
use MeowBlog\Services\ArticlesManagerServiceInterface;

class ArticlesController extends AppController
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

    public function all(ArticlesManagerServiceInterface $articlesManager)
    {
        $this->Authorization->skipAuthorization();

        $articles = $articlesManager->getAll($this->request, $this);
        $this->set('articles', $articles);
        $this->viewBuilder()->setOption('serialize', 'articles');
    }
}
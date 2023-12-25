<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Api\Version1;

use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
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

        /** @var SelectQuery $articles */
        $articles = $articlesManager->getAll($this->request, $this, paginate: false);
        $articles->contain(['Users', 'Blogs', 'Tags']);
        
        $this->set('articles', $articles);
        $this->viewBuilder()->setOption('serialize', 'articles');
    }
}
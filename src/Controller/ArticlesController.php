<?php
declare(strict_types=1);

namespace MeowBlog\Controller;

use Cake\Database\Query;
use Cake\Event\EventInterface;
use MeowBlog\Model\Entity\ArticleType;
use MeowBlog\Services\ArticlesManagerServiceInterface;
use MeowBlog\Services\BlogsManagerServiceInterface;

/**
 * Articles Controller
 *
 * @property \MeowBlog\Model\Table\ArticlesTable $Articles
 * @method \MeowBlog\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * beforeFilter method
     *
     * @param \Cake\Event\EventInterface $event event
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'tags', 'view']);
    }

    /**
     * Index method
     *
     * @param \MeowBlog\Services\ArticlesManagerServiceInterface $articlesManager articlesManager
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(ArticlesManagerServiceInterface $articlesManager, BlogsManagerServiceInterface $blogsManager)
    {
        $this->Authorization->skipAuthorization();

        // Redirect to default route if it exists
        $dr = $blogsManager->getDefaultRoute($this->request);
        if (!is_null($dr) && $dr != '') {
            return $this->redirect($dr);
        }

        $homePage = $articlesManager->getHomePageContent($this->request);

        $this->paginate = [
            'contain' => ['Users', 'Blogs'],
            'order' => ['Articles.created' => 'DESC'],
            'limit' => 10,
        ];

        $articles = $articlesManager->getAll($this->request, $this);

        $this->set(compact('articles', 'homePage'));
    }

    /**
     * View method
     *
     * @param string $slug slug
     * @param \MeowBlog\Services\ArticlesManagerServiceInterface $articlesManager articlesManager
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(string $slug, ArticlesManagerServiceInterface $articlesManager)
    {
        if ($this->request->getParam('_matchedRoute') == '/page/{slug}') {
            $this->viewBuilder()->setTemplate('view_page');
        }
        
        $article = $articlesManager->getArticle($slug, $this->request);
        $this->Authorization->skipAuthorization();

        $this->set(compact('article'));
    }

    /**
     * Add method
     *
     * @param \MeowBlog\Services\ArticlesManagerServiceInterface $articlesManager articlesManager
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(ArticlesManagerServiceInterface $articlesManager)
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);
        if ($this->request->is('post')) {
            if ($articlesManager->saveToDatabase($article, $this->request)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string $slug Article islug
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(string $slug)
    {
        /** @var \Cake\ORM\Query $q */
        $q = $this->Articles->findBySlug($slug);

        /** @var \Cake\Datasource\EntityInterface $article */
        $article = $q->contain(['Tags'])->firstOrFail();
        $this->Authorization->authorize($article);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $tags = $this->Articles->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string $slug slug
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(string $slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        /** @var \Cake\ORM\Query $q */
        $q = $this->Articles->findBySlug($slug);

        /** @var \Cake\Datasource\EntityInterface $article */
        $article = $q->firstOrFail();
        $this->Authorization->authorize($article);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string ...$tags tags
     * @return void
     */
    public function tags(string ...$tags)
    {
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags,
        ])->contain(['Tags'])->all();
        $this->Authorization->skipAuthorization();

        $this->set([
            'articles' => $articles,
            'tags' => $tags,
            //'_serialize' => ['articles', 'tags']
        ]);
    }
}

<?php
declare(strict_types=1);

namespace MeowBlog\Controller;

use Cake\Database\Query;
use Cake\Event\EventInterface;
use Cake\I18n\Date;
use Cake\I18n\Time;
use DateTime;
use MeowBlog\Model\Entity\NodeType;
use MeowBlog\Services\NodesManagerService;
use MeowBlog\Services\NodesManagerServiceInterface;
use MeowBlog\Services\BlogsManagerServiceInterface;

/**
 * Nodes Controller
 *
 * @property \MeowBlog\Model\Table\NodesTable $Nodes
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NodesController extends AppController
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
        $this->Authentication->allowUnauthenticated(['index', 'tags', 'view', 'now', 'micro', 'stats']);
    }

    /**
     * Index method
     *
     * @param \MeowBlog\Services\NodesManagerServiceInterface $nodesManager nodesManager
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(NodesManagerServiceInterface $nodesManager, BlogsManagerServiceInterface $blogsManager)
    {
        $this->Authorization->skipAuthorization();

        // Redirect to default route if it exists
        $dr = $blogsManager->getDefaultRoute($this->request);
        if (!is_null($dr) && $dr != '') {
            return $this->redirect($dr);
        }

        $homePage = $nodesManager->getHomePageContent($this->request);

        $this->paginate = [
            'order' => ['Nodes.created' => 'DESC'],
            'limit' => 10,
        ];

        $nodes = $nodesManager->getAll($this->request, $this);

        $this->set(compact('nodes', 'homePage'));
    }

    /**
     * View method
     *
     * @param string $slug slug
     * @param \MeowBlog\Services\NodesManagerServiceInterface $nodesManager nodesManager
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(string $slug, NodesManagerServiceInterface $nodesManager)
    {
        if ($this->request->getParam('_matchedRoute') == '/page/{slug}') {
            $this->viewBuilder()->setTemplate('view_page');
        }
        $node = $nodesManager->getNode($slug, $this->request);
        $this->Authorization->skipAuthorization();

        $this->set(compact('node'));
    }

    /**
     * Add method
     *
     * @param \MeowBlog\Services\NodesManagerServiceInterface $nodesManager nodesManager
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(NodesManagerServiceInterface $nodesManager)
    {
        $node = $this->Nodes->newEmptyEntity();
        $this->Authorization->authorize($node);
        if ($this->request->is('post')) {
            if ($nodesManager->saveToDatabase($node, $this->request)) {
                $this->Flash->success(__('The node has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The node could not be saved. Please, try again.'));
        }
        $users = $this->Nodes->Users->find('list', ['limit' => 200])->all();
        $tags = $this->Nodes->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('node', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string $slug Node islug
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(string $slug)
    {
        /** @var \Cake\ORM\Query $q */
        $q = $this->Nodes->findBySlug($slug);

        /** @var \Cake\Datasource\EntityInterface $node */
        $node = $q->contain(['Tags'])->firstOrFail();
        $this->Authorization->authorize($node);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->getData());
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The node could not be saved. Please, try again.'));
        }
        $users = $this->Nodes->Users->find('list', ['limit' => 200])->all();
        $tags = $this->Nodes->Tags->find('list', ['limit' => 200])->all();
        $this->set(compact('node', 'users', 'tags'));
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
        $q = $this->Nodes->findBySlug($slug);

        /** @var \Cake\Datasource\EntityInterface $node */
        $node = $q->firstOrFail();
        $this->Authorization->authorize($node);
        if ($this->Nodes->delete($node)) {
            $this->Flash->success(__('The node has been deleted.'));
        } else {
            $this->Flash->error(__('The node could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string ...$tags tags
     * @return void
     */
    public function tags(string ...$tags)
    {
        $blog = $this->Nodes->Blogs->find()->where(['Blogs.domain' => $this->getRequest()->getUri()->getHost()])->first();
        $nodes = $this->Nodes->find('tagged', tags: $tags, blog: $blog)->contain(['Tags', 'Blogs'])->all();
        $this->Authorization->skipAuthorization();

        $this->set([
            'nodes' => $nodes,
            'tags' => $tags,
            //'_serialize' => ['nodes', 'tags']
        ]);
    }

    /**
     * Returns latest node tagged with NOW
     *
     * @param NodesManagerServiceInterface $nodesManager
     * @return void
     */
    public function now(NodesManagerServiceInterface $nodesManager)
    {
        $content = $nodesManager->getLatestNowPageContent($this->request);
        $this->Authorization->skipAuthorization();

        $this->set(compact('content'));
    }

    public function micro(NodesManagerServiceInterface $nodesManager)
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'order' => ['Nodes.created' => 'DESC'],
            'limit' => 50,
        ];

        $nodes = $nodesManager->getAll($this->request, $this, nodeType: NodeType::Micro);

        $this->set(compact('nodes'));
    }

    public function stats(BlogsManagerServiceInterface $blogsManager, NodesManagerServiceInterface $nodesManager)
    {
        $this->Authorization->skipAuthorization();

        if (!$blogsManager->getId($this->request)) {
            return $this->redirect(['action' => 'index']);
        }

        /** @var array<\MeowBlog\Model\Entity\Node> $nodes */
        $nodes = $nodesManager->getAll($this->request, $this);

        $daysWithNode = [];
        foreach ($nodes as $node) {
        
            $daysWithNode[] = date('z', $node->created->getTimestamp());
        }
        
        $day = new DateTime('2023-01-01');
        $offset = $day->format('N')-1;
        $daysCount = $day->format('L') ? 366 : 365;

        $this->set(compact('daysWithNode', 'offset', 'daysCount'));
    }
}

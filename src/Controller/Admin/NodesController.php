<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use Authorization\Exception\ForbiddenException;
use MeowBlog\Controller\AppController;
use MeowBlog\Job\UpdateAiSummaryJob;
use MeowBlog\Model\Entity\NodeType;
use MeowBlog\Services\NodesManagerServiceInterface;
use MeowBlog\Services\OpenaiChatServiceInterface;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Nodes Controller
 *
 * @property \MeowBlog\Model\Table\NodesTable $Nodes
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NodesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            //'contain' => ['Users', 'Blogs'],
        ];
        $nodes = $this->paginate($this->Nodes->find('all', [
            'contain' => ['Users', 'Blogs'],
        ]));

        $this->set(compact('nodes'));
    }

    /**
     * View method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $node = $this->Nodes->get($id, contain: ['Users', 'Tags', 'Blogs']);

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
        try {
            $this->Authorization->authorize($node);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to create nodes.'));

            return $this->redirect($this->referer());
        }

        if ($this->request->is('post')) {
            if ($nodesManager->saveToDatabase($node, $this->request)) {
                $this->Flash->success(__('The node has been saved.'));

                $data = [
                    'node_id' => $node->id,
                    'original_text' => $node->body,
                ];

                $this->Queue->push(UpdateAiSummaryJob::class, data: $data);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The node could not be saved. Please, try again.'));
        }

        $nodeTypes = NodeType::list();


        // $users = $this->Nodes->Users->find('list', ['limit' => 200])->all();
        // $tags = $this->Nodes->Tags->find('list', ['limit' => 200])->all();
        $blogs = $this->Nodes->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('blogs', 'node', 'nodeTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $node = $this->Nodes->get($id, contain: ['Tags']);

        try {
            $this->Authorization->authorize($node);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to edit this node.'));

            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->getData());
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                $data = [
                    'node_id' => $node->id,
                    'original_text' => $node->body,
                ];

                $this->Queue->push(UpdateAiSummaryJob::class, data: $data);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The node could not be saved. Please, try again.'));
        }

        $nodeTypes = NodeType::list();

        // $users = $this->Nodes->Users->find('list', ['limit' => 200])->all();
        // $tags = $this->Nodes->Tags->find('list', ['limit' => 200])->all();
        $blogs = $this->Nodes->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('blogs', 'node', 'nodeTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $node = $this->Nodes->get($id);

        try {
            $this->Authorization->authorize($node);
        } catch (ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to delete this node.'));

            return $this->redirect($this->referer());
        }

        if ($this->Nodes->delete($node)) {
            $this->Flash->success(__('The node has been deleted.'));
        } else {
            $this->Flash->error(__('The node could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function summarize(OpenaiChatServiceInterface $ai, $id = null)
    {
        $this->Authorization->skipAuthorization();

        $node = $this->Nodes->get($id);

        $result = $ai->getTextSummary($node->body);

        $node->summary = $result;
        $this->Nodes->save($node);
    }
}

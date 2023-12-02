<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use MeowBlog\Controller\AppController;
use MeowBlog\Services\TagsManagerServiceInterface;

/**
 * Tags Controller
 *
 * @property \MeowBlog\Model\Table\TagsTable $Tags
 * @method \MeowBlog\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{
    /**
     * Index method
     *
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags manager service.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(TagsManagerServiceInterface $tagsManager)
    {
        $this->Authorization->skipAuthorization();

        $tags = $this->paginate($tagsManager->getAll($this));

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags manager service.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id, TagsManagerServiceInterface $tagsManager)
    {
        $this->Authorization->skipAuthorization();

        $tag = $tagsManager->getOne((int)$id);

        $this->set(compact('tag'));
    }

    /**
     * Add method
     *
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags manager service.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(TagsManagerServiceInterface $tagsManager)
    {
        $tag = $this->Tags->newEmptyEntity();
        $this->Authorization->authorize($tag);

        if ($this->request->is('post')) {
            /** @var \MeowBlog\Model\Entity\Tag $tag */
            if ($tagsManager->saveToDatabase($tag, $this->request)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $articles = $this->Tags->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('tag', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags Manager
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id, TagsManagerServiceInterface $tagsManager)
    {
        $tag = $tagsManager->getOne((int)$id);
        $this->Authorization->authorize($tag);

        if ($this->request->is(['patch', 'post', 'put'])) {
            /** @var \MeowBlog\Model\Entity\Tag $tag */
            if ($tagsManager->saveToDatabase($tag, $this->request)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $articles = $this->Tags->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('tag', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags Manager
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id, TagsManagerServiceInterface $tagsManager)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $tagsManager->getOne((int)$id);
        $this->Authorization->authorize($tag);

        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

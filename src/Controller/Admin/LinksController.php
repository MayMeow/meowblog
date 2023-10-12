<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use MeowBlog\Controller\AppController;
use MeowBlog\Services\BlogsManagerServiceInterface;

/**
 * Links Controller
 *
 * @property \MeowBlog\Model\Table\LinksTable $Links
 * @method \MeowBlog\Model\Entity\Link[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LinksController extends AppController
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
            'contain' => ['Blogs'],
        ];
        $links = $this->paginate($this->Links);

        $this->set(compact('links'));
    }

    /**
     * View method
     *
     * @param string|null $id Link id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $link = $this->Links->get($id, contain: ['Blogs']);

        $this->Authorization->authorize($link);

        $this->set(compact('link'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(BlogsManagerServiceInterface $blogsManager)
    {
        $link = $this->Links->newEmptyEntity();
        $this->Authorization->authorize($link);

        if ($this->request->is('post')) {
            $link = $this->Links->patchEntity($link, $this->request->getData());
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been saved.'));

                $blogsManager->clearLinkCache($link->blog_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The link could not be saved. Please, try again.'));
        }
        $blogs = $this->Links->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('link', 'blogs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Link id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(BlogsManagerServiceInterface $blogsManager, ?string $id = null)
    {
        $link = $this->Links->get($id, contain: []);
        $this->Authorization->authorize($link);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $link = $this->Links->patchEntity($link, $this->request->getData());
            if ($this->Links->save($link)) {
                $this->Flash->success(__('The link has been saved.'));

                $blogsManager->clearLinkCache($link->blog_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The link could not be saved. Please, try again.'));
        }
        $blogs = $this->Links->Blogs->find('list', ['limit' => 200])->all();
        $this->set(compact('link', 'blogs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Link id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(BlogsManagerServiceInterface $blogsManager, ?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $link = $this->Links->get($id);
        $this->Authorization->authorize($link);
        
        if ($this->Links->delete($link)) {
            $blogsManager->clearLinkCache($link->blog_id);
            
            $this->Flash->success(__('The link has been deleted.'));
        } else {
            $this->Flash->error(__('The link could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

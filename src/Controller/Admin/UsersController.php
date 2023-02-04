<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use MeowBlog\Controller\AppController;
use MeowBlog\Services\UsersManagerServiceInterface;

/**
 * Users Controller
 *
 * @property \MeowBlog\Model\Table\UsersTable $Users
 * @method \MeowBlog\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(UsersManagerServiceInterface $usersManager)
    {
        $this->Authorization->skipAuthorization();
        $users = $this->paginate($usersManager->getAll());

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id, UsersManagerServiceInterface $usersManager)
    {
        $user = $usersManager->getOne($id, true);
        $this->Authorization->authorize($user);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(UsersManagerServiceInterface $usersManager)
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);

        if ($this->request->is('post')) {
            if ($usersManager->saveToDatabase($user, $this->request)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id, UsersManagerServiceInterface $userManager)
    {
        $user = $userManager->getOne($id);
        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($userManager->saveToDatabase($user, $this->request)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id, UsersManagerServiceInterface $usersManager)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $usersManager->getOne($id);
        $this->Authorization->authorize($user);
        
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

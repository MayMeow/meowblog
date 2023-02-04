<?php
declare(strict_types=1);

namespace MeowBlog\Controller;

use Cake\Event\EventInterface;
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
     * beforeFilter method
     *
     * @param \Cake\Event\EventInterface $event event
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'add']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @param \MeowBlog\Services\UsersManagerServiceInterface $usersManager Users Manager
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id, UsersManagerServiceInterface $usersManager)
    {
        $user = $usersManager->getOne($id);
        $this->Authorization->authorize($user);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @param \MeowBlog\Services\UsersManagerServiceInterface $usersManager Users Manager
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(UsersManagerServiceInterface $usersManager)
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->skipAuthorization();

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
     * Login method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/home';

            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username or password');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}

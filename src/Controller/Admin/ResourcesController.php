<?php
declare(strict_types=1);

namespace MeowBlog\Controller\Admin;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use MeowBlog\Controller\AppController;
use MeowBlog\Form\ResourceUploadForm;
use PSpell\Config;

/**
 * Resources Controller
 *
 * @property \MeowBlog\Model\Table\ResourcesTable $Resources
 * @property \FileUpload\Controller\Component\DownloadComponent $Download
 * @property \FileUpload\Controller\Component\UploadComponent $Upload
 */
class ResourcesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $config = Configure::read('Storage.' . 'bunny');

        $this->loadComponent('FileUpload.Upload', $config);
        $this->loadComponent('FileUpload.Download', $config);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $query = $this->Resources->find();
        $resources = $this->paginate($query);

        $this->set(compact('resources'));
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $resource = $this->Resources->get($id, contain: []);
        $this->set(compact('resource'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $resource = $this->Resources->newEmptyEntity();
        $form = new ResourceUploadForm();

        if ($this->request->is(['post'])) {
            $file = $this->Upload->getFile($this);
            $r = $this->Resources->newEmptyEntity();
            $r->name = $file->getFileName();
            $r->path = $file->get('storagePath');
            $r->size = $file->getOriginalData()->getSize();

            $this->Resources->save($r);
        };

        $this->set(compact('form'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();
        $resource = $this->Resources->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resource = $this->Resources->patchEntity($resource, $this->request->getData());
            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $this->set(compact('resource'));
    }

    public function download($id = null)
    {
        $this->Authorization->skipAuthorization();
        $resource = $this->Resources->get($id, contain: []);
        $file = $this->Download->getFile($resource->name);

        $response = $this->response;
        $response = $response->withStringBody($file->getContent());
        $response = $response->withType($file->getMimeType());
        $response = $response->withDownload($resource->name);
        return $response;
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);
        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('The resource has been deleted.'));
        } else {
            $this->Flash->error(__('The resource could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

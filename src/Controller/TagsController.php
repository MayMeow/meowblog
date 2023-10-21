<?php
declare(strict_types=1);

namespace MeowBlog\Controller;

use Cake\Event\EventInterface;
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
     * beforeFilter function
     *
     * @param \Cake\Event\EventInterface $event Event Interface
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

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
     * @param string $id Tag id.
     * @param \MeowBlog\Services\TagsManagerServiceInterface $tagsManager Tags manager service.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(string $id, TagsManagerServiceInterface $tagsManager)
    {
        $this->Authorization->skipAuthorization();

        $tag = $tagsManager->getOne((int)$id);

        $this->set(compact('tag'));
    }
}

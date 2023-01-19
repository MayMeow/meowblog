<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Tag;
use MeowBlog\Model\Table\TagsTable;

class TagsManagerService implements TagsManagerServiceInterface
{
    use LocatorAwareTrait;

    /**
     * Undocumented variable
     *
     * @var \Cake\ORM\Table|\MeowBlog\Model\Table\TagsTable
     */
    protected Table | TagsTable $tags;

    /**
     * TagsManagerService constructor.
     */
    public function __construct()
    {
        $this->tags = $this->fetchTable('Tags');
    }

    /**
     * Undocumented function
     *
     * @return \Cake\ORM\Table|\MeowBlog\Model\Table\TagsTable
     */
    public function getAll(): Table | TagsTable
    {
        return $this->tags;
    }

    /**
     * getOne function
     *
     * @param int $id Tag ID
     * @return \Cake\Datasource\EntityInterface|\MeowBlog\Model\Entity\Tag
     */
    public function getOne(int $id): EntityInterface | Tag
    {
        return $this->tags->get($id, [
            'contain' => ['Articles'],
        ]);
    }

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @param \Cake\Http\ServerRequest $request Request
     * @return \MeowBlog\Model\Entity\Tag|false
     */
    public function saveToDatabase(Tag $tag, ServerRequest $request): Tag | false
    {
        $tag = $this->tags->patchEntity($tag, $request->getData());

        return $this->tags->save($tag);
    }
}

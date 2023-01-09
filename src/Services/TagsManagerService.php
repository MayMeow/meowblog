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
     * @var Table|TagsTable
     */
    protected Table|TagsTable $tags;

    public function __construct()
    {
        $this->tags = $this->fetchTable('Tags');
    }

    /**
     * Undocumented function
     *
     * @return Table|TagsTable
     */
    public function getAll(): Table|TagsTable
    {
        return $this->tags;
    }

    /**
     * getOne function
     *
     * @param integer $id Tag ID
     * @return EntityInterface|Tag
     */
    public function getOne(int $id): EntityInterface|Tag
    {
        return $this->tags->get($id, [
            'contain' => ['Articles'],
        ]);
    }

    /**
     * saveToDatabase function
     *
     * @param Tag $tag Tag
     * @param ServerRequest $request Request
     * @return Tag|false
     */
    public function saveToDatabase(Tag $tag, ServerRequest $request): Tag|false
    {
        $tag = $this->tags->patchEntity($tag, $request->getData());

        return $this->tags->save($tag);
    }
}
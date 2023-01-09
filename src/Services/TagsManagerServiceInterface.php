<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Tag;
use MeowBlog\Model\Table\TagsTable;

interface TagsManagerServiceInterface
{
    /**
     * getAll function
     *
     * @return Table|TagsTable
     */
    public function getAll(): Table|TagsTable;

    /**
     * getOne function
     *
     * @param integer $id Tag ID
     * @return EntityInterface|Tag
     */
    public function getOne(int $id): EntityInterface|Tag;

    /**
     * saveToDatabase function
     *
     * @param Tag $tag Tag
     * @param ServerRequest $request Request
     * @return Tag|false
     */
    public function saveToDatabase(Tag $tag, ServerRequest $request): Tag | false;
}
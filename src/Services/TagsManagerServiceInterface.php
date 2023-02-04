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
     * @return \Cake\ORM\Table|\MeowBlog\Model\Table\TagsTable
     */
    public function getAll(): Table | TagsTable;

    /**
     * getOne function
     *
     * @param int $id Tag ID
     * @return \Cake\Datasource\EntityInterface|\MeowBlog\Model\Entity\Tag
     */
    public function getOne(int $id): EntityInterface | Tag;

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @param \Cake\Http\ServerRequest $request Request
     * @return \MeowBlog\Model\Entity\Tag|false
     */
    public function saveToDatabase(Tag|EntityInterface $tag, ServerRequest $request): Tag | false;
}

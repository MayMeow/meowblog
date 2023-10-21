<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Database\Query\SelectQuery;
use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use MeowBlog\Controller\AppController;
use MeowBlog\Model\Entity\Tag;

interface TagsManagerServiceInterface
{
    /**
     * getAll function
     * @param \MeowBlog\Controller\AppController $appController Application Controller
     * @return \Cake\ORM\Table
     */
    public function getAll(AppController $appController): Table|SelectQuery;

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
    public function saveToDatabase(Tag | EntityInterface $tag, ServerRequest $request): Tag | false;
}

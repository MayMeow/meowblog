<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Database\Query\SelectQuery;
use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Controller\AppController;
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
     * TagsManagerService
     */
    public function __construct()
    {
        $this->tags = $this->fetchTable('Tags');
    }

    /**
     * Undocumented function
     *
     * @return \Cake\ORM\Table
     */
    public function getAll(AppController $appController): Table|SelectQuery
    {
        $domain = $appController->getRequest()->getUri()->getHost();
        $blog = $this->tags->Nodes->Blogs->find()->where(['Blogs.Domain' => $domain])->select(['id'])->first();

        // all tags
        if (is_null($blog)) {
            return $this->tags;
        }

        // all tags where tags that are used on any of node
        $tags = $this->tags->find();
        $tags->matching(
            'Nodes', function (SelectQuery $q) use ($blog) {
                return $q->where(['blog_id' => $blog->id]);
            }
        );

        // update mysql config with SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
        $tags->distinct('Tags.' . $this->tags->getPrimaryKey());
        
        return $tags;
    }

    /**
     * getOne function
     *
     * @param int $id Tag ID
     * @return \Cake\Datasource\EntityInterface|\MeowBlog\Model\Entity\Tag
     */
    public function getOne(int $id): EntityInterface | Tag
    {
        return $this->tags->get($id, contain: ['Nodes']);
    }

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @param \Cake\Http\ServerRequest $request Request
     * @return \MeowBlog\Model\Entity\Tag|false
     */
    public function saveToDatabase(Tag | EntityInterface $tag, ServerRequest $request): Tag | false
    {
        $tag = $this->tags->patchEntity($tag, $request->getData());

        /** @var \MeowBlog\Model\Entity\Tag $tag */
        return $tag = $this->tags->save($tag) !== false ? $tag : false;
    }
}

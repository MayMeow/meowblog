<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use MeowBlog\Model\Entity\Node;
use MeowBlog\Model\Entity\NodeType;
use MeowBlog\Model\Entity\Blog;

/**
 * Nodes Model
 *
 * @property \MeowBlog\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MeowBlog\Model\Table\BlogsTable&\Cake\ORM\Association\BelongsTo $Blogs
 * @property \MeowBlog\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 * @method \MeowBlog\Model\Entity\Node newEmptyEntity()
 * @method \MeowBlog\Model\Entity\Node newEntity(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Node[] newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Node get($primaryKey, $options = [])
 * @method \MeowBlog\Model\Entity\Node findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MeowBlog\Model\Entity\Node patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Node[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Node|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Node saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @method \MeowBlog\Model\Entity\Node|\Cake\ORM\Query findBySlug($slug)
 */
class NodesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('nodes');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Blogs',[
            'foreignKey' => 'blog_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'node_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'nodes_tags',
            'dependent' => true,
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            //->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            //->requirePresence('slug', 'create')
            ->notEmptyString('slug');
            //->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->scalar('node_type')
            ->requirePresence('node_type', 'create')
            ->notEmptyString('node_type');

        $validator
            ->boolean('published')
            ->notEmptyString('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('blog_id', 'Blogs'), ['errorField' => 'blog_id']);
        $rules->add($rules->isUnique(['title', 'blog_id'], 'This slug is already in use on current blog'));

        return $rules;
    }

    public function validationCustom($validator)
    {

        return $validator;
    }

    /**
     * @param \Cake\Event\EventInterface $event Event
     * @param \MeowBlog\Model\Entity\Node|\Cake\Datasource\EntityInterface $entity Entity
     * @param array $options Options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, $options)
    {
        /** @var \MeowBlog\Model\Entity\Node $entity */
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 191);
        }

        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    /**
     * @param \Cake\ORM\Query\SelectQuery $query Server Query
     * @param array $tags Tags
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findTagged(SelectQuery $query, array $tags = [], ?Blog $blog = null): SelectQuery
    {
        $columns = [
            'Nodes.id', 'Nodes.user_id', 'Nodes.title',
            'Nodes.body', 'Nodes.published', 'Nodes.created',
            'Nodes.slug',
        ];

        // do not filter columns with (->select($columns))
        $query = $query->distinct($columns);

        if (empty($tags)) {
            // If there are no tags provided, find nodes that have no tags.
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            // Find nodes that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $tags]);
        }

        if (!is_null($blog)) {
            $query->matching(
                'Blogs', function (SelectQuery $q) use ($blog) {
                    return $q->where(['Blogs.Id' => $blog->id]);
                }
            );
        }

        return $query->groupBy(['Blogs.id', 'Nodes.id']);
    }

    /**
     * @param string $tagString Tag String
     * @return array<\MeowBlog\Model\Entity\Tag> Array of Tag entities
     */
    protected function _buildTags(string $tagString): array
    {
        // Trim tags
        $newTags = array_map('trim', explode(',', $tagString));
        // Remove all empty tags
        $newTags = array_filter($newTags);
        // Reduce duplicated tags
        $newTags = array_unique($newTags);

        $out = [];
        $tags = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags])
            ->all();

        // Remove existing tags from the list of new tags.
        foreach ($tags->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Add existing tags.
        foreach ($tags as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }

        return $out;
    }

    /**
     * Find Now page
     * 
     * Find all published nodes with tag 'now' ordered from newest to oldest
     *
     * @param SelectQuery $query
     * @param string $domain
     * @return SelectQuery
     */
    public function findNow(SelectQuery $query, string $domain): SelectQuery
    {
        $query = $query->find('tagged', tags: ['now'])->where([
            'Blogs.domain' => $domain,
            'Nodes.node_type' => NodeType::Node->value,
            'Nodes.published' => 1,
        ])->orderBy(['Nodes.created' => 'DESC']);

        return $query->contain(['Blogs', 'Tags']);
    }

    public function findSlug(SelectQuery $q, string $slug): SelectQuery
    {
        $q = $q->where(['Nodes.slug' => $slug]);

        return $q;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Tag;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Article newEmptyEntity()
 * @method \App\Model\Entity\Article newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
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

        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'articles_tags',
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
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    /**
     * @param EventInterface $event
     * @param $entity
     * @param $options
     * @return void
     */
    public function beforeSave(EventInterface $event, $entity, $options)
    {
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
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findTagged(Query $query, array $options): Query
    {
        $columns = [
            'Articles.id', 'Articles.user_id', 'Articles.title',
            'Articles.body', 'Articles.published', 'Articles.created',
            'Articles.slug',
        ];

        $query = $query->select($columns)->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find articles that have no tags.
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            // Find articles that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Articles.id']);
    }

    /**
     * @param string $tagString
     * @return array<Tag> Array of Tag entities
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
}

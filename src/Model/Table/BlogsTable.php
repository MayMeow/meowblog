<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blogs Model
 *
 * @property \MeowBlog\Model\Table\LinksTable&\Cake\ORM\Association\HasMany $Links
 * @method \MeowBlog\Model\Entity\Blog newEmptyEntity()
 * @method \MeowBlog\Model\Entity\Blog newEntity(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Blog[] newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Blog get($primaryKey, $options = [])
 * @method \MeowBlog\Model\Entity\Blog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MeowBlog\Model\Entity\Blog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Blog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Blog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Blog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @method \MeowBlog\Model\Entity\Blog|\Cake\ORM\Query findByDomain($domain)
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlogsTable extends Table
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

        $this->setTable('blogs');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Links', [
            'foreignKey' => 'blog_id',
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('domain')
            ->maxLength('domain', 255)
            ->requirePresence('domain', 'create')
            ->notEmptyString('domain');

        $validator
            ->scalar('theme')
            ->maxLength('theme', 255)
            ->requirePresence('theme', 'create')
            ->notEmptyString('theme');

        $validator
            ->scalar('scheme')
            ->maxLength('scheme', 255)
            ->requirePresence('scheme', 'create')
            ->notEmptyString('scheme');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->addDelete($rules->isNotLinkedTo(
            'Links',
            message: 'This Blog has Links. Please delete them first.'
        ));

        return $rules;
    }
}

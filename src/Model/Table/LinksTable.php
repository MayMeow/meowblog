<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Links Model
 *
 * @property \MeowBlog\Model\Table\BlogsTable&\Cake\ORM\Association\BelongsTo $Blogs
 *
 * @method \MeowBlog\Model\Entity\Link newEmptyEntity()
 * @method \MeowBlog\Model\Entity\Link newEntity(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Link[] newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Link get($primaryKey, $options = [])
 * @method \MeowBlog\Model\Entity\Link findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MeowBlog\Model\Entity\Link patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Link[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Link|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Link saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\Link[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Link[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Link[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\Link[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LinksTable extends Table
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

        $this->setTable('links');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Blogs', [
            'foreignKey' => 'blog_id',
            'joinType' => 'INNER',
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
            ->integer('blog_id')
            ->notEmptyString('blog_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->integer('weight')
            ->notEmptyString('weight');

        $validator
            ->boolean('external')
            ->notEmptyString('external');

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
        $rules->add($rules->existsIn('blog_id', 'Blogs'), ['errorField' => 'blog_id']);

        return $rules;
    }
}

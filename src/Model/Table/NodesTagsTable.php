<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NodesTags Model
 *
 * @property \MeowBlog\Model\Table\NodesTable&\Cake\ORM\Association\BelongsTo $Nodes
 * @property \MeowBlog\Model\Table\TagsTable&\Cake\ORM\Association\BelongsTo $Tags
 * @method \MeowBlog\Model\Entity\NodesTag newEmptyEntity()
 * @method \MeowBlog\Model\Entity\NodesTag newEntity(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[] newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag get($primaryKey, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\NodesTag[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class NodesTagsTable extends Table
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

        $this->setTable('nodes_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Nodes', [
            'foreignKey' => 'node_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
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
            ->integer('node_id')
            ->requirePresence('node_id', 'create')
            ->notEmptyString('node_id');

        $validator
            ->integer('tag_id')
            ->requirePresence('tag_id', 'create')
            ->notEmptyString('tag_id');

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
        $rules->add($rules->existsIn('node_id', 'Nodes'), ['errorField' => 'node_id']);
        $rules->add($rules->existsIn('tag_id', 'Tags'), ['errorField' => 'tag_id']);

        return $rules;
    }
}

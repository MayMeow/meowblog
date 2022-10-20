<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArticlesTags Model
 *
 * @property \MeowBlog\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 * @property \MeowBlog\Model\Table\TagsTable&\Cake\ORM\Association\BelongsTo $Tags
 * @method \MeowBlog\Model\Entity\ArticlesTag newEmptyEntity()
 * @method \MeowBlog\Model\Entity\ArticlesTag newEntity(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[] newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag get($primaryKey, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MeowBlog\Model\Entity\ArticlesTag[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ArticlesTagsTable extends Table
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

        $this->setTable('articles_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
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
            ->integer('article_id')
            ->requirePresence('article_id', 'create')
            ->notEmptyString('article_id');

        $validator
            ->scalar('tag_id')
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
        $rules->add($rules->existsIn('article_id', 'Articles'), ['errorField' => 'article_id']);
        $rules->add($rules->existsIn('tag_id', 'Tags'), ['errorField' => 'tag_id']);

        return $rules;
    }
}

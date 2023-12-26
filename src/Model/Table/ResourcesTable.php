<?php
declare(strict_types=1);

namespace MeowBlog\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Resources Model
 *
 * @method \MeowBlog\Model\Entity\Resource newEmptyEntity()
 * @method \MeowBlog\Model\Entity\Resource newEntity(array $data, array $options = [])
 * @method array<\MeowBlog\Model\Entity\Resource> newEntities(array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Resource get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \MeowBlog\Model\Entity\Resource findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \MeowBlog\Model\Entity\Resource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\MeowBlog\Model\Entity\Resource> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MeowBlog\Model\Entity\Resource|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \MeowBlog\Model\Entity\Resource saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\MeowBlog\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\MeowBlog\Model\Entity\Resource>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\MeowBlog\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\MeowBlog\Model\Entity\Resource> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\MeowBlog\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\MeowBlog\Model\Entity\Resource>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\MeowBlog\Model\Entity\Resource>|\Cake\Datasource\ResultSetInterface<\MeowBlog\Model\Entity\Resource> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResourcesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('resources');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('path')
            ->maxLength('path', 255)
            ->allowEmptyString('path');

        $validator
            ->allowEmptyString('size');

        return $validator;
    }
}

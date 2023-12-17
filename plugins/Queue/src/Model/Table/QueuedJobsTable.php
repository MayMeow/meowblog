<?php
declare(strict_types=1);

namespace Queue\Model\Table;

use Cake\I18n\DateTime;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Queue\Model\Entity\QueuedJob;
use Queue\Utils\QueuedJobPriority;

/**
 * QueuedJobs Model
 *
 * @method \Queue\Model\Entity\QueuedJob newEmptyEntity()
 * @method \Queue\Model\Entity\QueuedJob newEntity(array $data, array $options = [])
 * @method array<\Queue\Model\Entity\QueuedJob> newEntities(array $data, array $options = [])
 * @method \Queue\Model\Entity\QueuedJob get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \Queue\Model\Entity\QueuedJob findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \Queue\Model\Entity\QueuedJob patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\Queue\Model\Entity\QueuedJob> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Queue\Model\Entity\QueuedJob|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \Queue\Model\Entity\QueuedJob saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\Queue\Model\Entity\QueuedJob>|\Cake\Datasource\ResultSetInterface<\Queue\Model\Entity\QueuedJob>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\Queue\Model\Entity\QueuedJob>|\Cake\Datasource\ResultSetInterface<\Queue\Model\Entity\QueuedJob> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\Queue\Model\Entity\QueuedJob>|\Cake\Datasource\ResultSetInterface<\Queue\Model\Entity\QueuedJob>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\Queue\Model\Entity\QueuedJob>|\Cake\Datasource\ResultSetInterface<\Queue\Model\Entity\QueuedJob> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QueuedJobsTable extends Table
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

        $this->setTable('queued_jobs');
        $this->setDisplayField('reference');
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
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->requirePresence('reference', 'create')
            ->notEmptyString('reference');

        $validator
            ->scalar('data')
            ->allowEmptyString('data');

        $validator
            ->integer('priority')
            ->notEmptyString('priority');

        $validator
            ->dateTime('not_before')
            ->requirePresence('not_before', 'create')
            ->notEmptyDateTime('not_before');

        $validator
            ->dateTime('finished')
            ->allowEmptyDateTime('finished');

        return $validator;
    }

    public function createJob(string $jobClass, array $data = [], QueuedJobPriority $priority = QueuedJobPriority::MEDIUM, ?int $recuring = null, ?int $postpone = null): QueuedJob
    {
        $newJob = [
            'reference' => $jobClass,
            'priority' => $priority->value,
            'not_before' => $postpone === null ? DateTime::now() : DateTime::now()->addMinutes($postpone),
            'data' => !empty($data) ? json_encode($data) : null,
        ];

        $newJob = $this->newEntity($newJob);

        return $this->saveOrFail($newJob);
    }

    public function rerunJob(QueuedJob $job, int $postpone): QueuedJob
    {
        $job->not_before = DateTime::now()->addMinutes($postpone);

        return $this->saveOrFail($job);
    }
}

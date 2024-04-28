<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blockers Model
 *
 * @property \App\Model\Table\TeachersTable&\Cake\ORM\Association\BelongsTo $Teachers
 *
 * @method \App\Model\Entity\Blocker newEmptyEntity()
 * @method \App\Model\Entity\Blocker newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Blocker> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Blocker get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Blocker findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Blocker patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Blocker> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Blocker|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Blocker saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Blocker>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Blocker>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Blocker>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Blocker> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Blocker>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Blocker>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Blocker>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Blocker> deleteManyOrFail(iterable $entities, array $options = [])
 */
class BlockersTable extends Table
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

        $this->setTable('blockers');
        $this->setDisplayField('blocker_id');
        $this->setPrimaryKey('blocker_id');

        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id',
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
            ->integer('teacher_id')
            ->notEmptyString('teacher_id');

        $validator
            ->dateTime('start_time')
            ->requirePresence('start_time', 'create')
            ->notEmptyDateTime('start_time');

        $validator
            ->dateTime('end_time')
            ->requirePresence('end_time', 'create')
            ->notEmptyDateTime('end_time');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

        $validator
            ->boolean('recurring')
            ->allowEmptyString('recurring');

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
        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'), ['errorField' => 'teacher_id']);

        return $rules;
    }
}

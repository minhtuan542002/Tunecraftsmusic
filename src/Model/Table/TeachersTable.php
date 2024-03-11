<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Teachers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Teacher newEmptyEntity()
 * @method \App\Model\Entity\Teacher newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Teacher> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teacher get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Teacher findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Teacher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Teacher> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teacher|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Teacher saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Teacher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacher>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacher> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacher>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacher> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TeachersTable extends Table
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

        $this->setTable('teachers');
        $this->setDisplayField('teacher_id');
        $this->setPrimaryKey('teacher_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->allowEmptyString('user_id');

        $validator
            ->scalar('teacher_availability')
            ->maxLength('teacher_availability', 255)
            ->allowEmptyString('teacher_availability');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

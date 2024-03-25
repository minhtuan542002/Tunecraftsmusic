<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @method \App\Model\Entity\Package newEmptyEntity()
 * @method \App\Model\Entity\Package newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Package> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Package get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Package findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Package> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Package|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Package saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Package>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Package>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Package>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Package> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Package>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Package>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Package>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Package> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('package_id');
        $this->setPrimaryKey('package_id');
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
            ->scalar('package_name')
            ->maxLength('package_name', 255)
            ->requirePresence('package_name', 'create')
            ->notEmptyString('package_name');

        $validator
            ->integer('number_of_lessons')
            ->allowEmptyString('number_of_lessons');

        $validator
            ->integer('lesson_duration_minutes')
            ->allowEmptyString('lesson_duration_minutes');

        $validator
            ->decimal('cost_dollars')
            ->allowEmptyString('cost_dollars');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lessontypes Model
 *
 * @method \App\Model\Entity\Lessontype newEmptyEntity()
 * @method \App\Model\Entity\Lessontype newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Lessontype> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lessontype get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Lessontype findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Lessontype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Lessontype> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lessontype|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Lessontype saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Lessontype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lessontype>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lessontype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lessontype> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lessontype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lessontype>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Lessontype>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Lessontype> deleteManyOrFail(iterable $entities, array $options = [])
 */
class LessontypesTable extends Table
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

        $this->setTable('lessontypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('lesson_id');
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
            ->integer('duration_minutes')
            ->allowEmptyString('duration_minutes');

        $validator
            ->decimal('cost')
            ->allowEmptyString('cost');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Teacherlessons Model
 *
 * @property \App\Model\Table\TeachersTable&\Cake\ORM\Association\BelongsTo $Teachers
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\HasMany $Lessons
 *
 * @method \App\Model\Entity\Teacherlesson newEmptyEntity()
 * @method \App\Model\Entity\Teacherlesson newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Teacherlesson> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teacherlesson get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Teacherlesson findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Teacherlesson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Teacherlesson> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teacherlesson|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Teacherlesson saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Teacherlesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacherlesson>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacherlesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacherlesson> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacherlesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacherlesson>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Teacherlesson>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Teacherlesson> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TeacherlessonsTable extends Table
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

        $this->setTable('teacherlessons');
        $this->setDisplayField('Teacherlesson_id');
        $this->setPrimaryKey('Teacherlesson_id');

        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id',
        ]);
        $this->hasMany('Lessons', [
            'foreignKey' => 'teacherlesson_id',
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
            ->allowEmptyString('teacher_id');

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

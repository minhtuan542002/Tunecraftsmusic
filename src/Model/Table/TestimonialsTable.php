<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Testimonials Model
 *
 * @method \App\Model\Entity\Testimonial newEmptyEntity()
 * @method \App\Model\Entity\Testimonial newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Testimonial> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Testimonial get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Testimonial findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Testimonial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Testimonial> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Testimonial|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Testimonial saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Testimonial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Testimonial>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Testimonial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Testimonial> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Testimonial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Testimonial>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Testimonial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Testimonial> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TestimonialsTable extends Table
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

        $this->setTable('testimonials');
        $this->setDisplayField('student_name');
        $this->setPrimaryKey('testimonial_id');
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
            ->scalar('student_name')
            ->maxLength('student_name', 255)
            ->requirePresence('student_name', 'create')
            ->notEmptyString('student_name');

        $validator
            ->scalar('testimonial_title')
            ->maxLength('testimonial_title', 255)
            ->requirePresence('testimonial_title', 'create')
            ->notEmptyString('testimonial_title');

        $validator
            ->scalar('testimonial_text')
            ->requirePresence('testimonial_text', 'create')
            ->notEmptyString('testimonial_text');

        $validator
            ->integer('rating')
            ->requirePresence('rating', 'create')
            ->notEmptyString('rating');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 255)
            ->requirePresence('image_url', 'create')
            ->notEmptyString('image_url');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
    }
}

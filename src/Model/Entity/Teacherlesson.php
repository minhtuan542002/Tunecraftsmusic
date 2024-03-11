<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Teacherlesson Entity
 *
 * @property int $teacherlesson_id
 * @property int|null $teacher_id
 * @property int|null $lesson_id
 *
 * @property \App\Model\Entity\Teacher $teacher
 * @property \App\Model\Entity\Lesson $lesson
 */
class Teacherlesson extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'teacher_id' => true,
        'lesson_id' => true,
        'teacher' => true,
        'lesson' => true,
    ];
}

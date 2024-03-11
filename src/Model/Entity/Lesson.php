<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lesson Entity
 *
 * @property int $lesson_id
 * @property int|null $teacherlesson_id
 * @property \Cake\I18n\DateTime|null $lesson_start_datetime
 * @property int|null $lesson_duration_minutes
 * @property string|null $notes
 *
 * @property \App\Model\Entity\Teacherlesson $teacherlesson
 */
class Lesson extends Entity
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
        'teacherlesson_id' => true,
        'lesson_start_datetime' => true,
        'lesson_duration_minutes' => true,
        'notes' => true,
        'teacherlesson' => true,
    ];
}

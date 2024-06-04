<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blocker Entity
 *
 * @property int $blocker_id
 * @property int $teacher_id
 * @property \Cake\I18n\DateTime $start_time
 * @property \Cake\I18n\DateTime $end_time
 * @property string|null $note
 * @property bool|null $recurring
 *
 * @property \App\Model\Entity\Teacher $teacher
 */
class Blocker extends Entity
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
        'start_time' => true,
        'start_time_time' => true,
        'end_time' => true,
        'end_time_time' => true,
        'note' => true,
        'recurring' => true,
        'teacher' => true,
        'week_day' => true,
    ];
}

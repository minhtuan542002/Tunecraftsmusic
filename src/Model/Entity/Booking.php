<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $booking_id
 * @property int $student_id
 * @property int $package_id
 * @property \Cake\I18n\DateTime $booking_datetime
 * @property bool|null $is_paid
 * @property bool $completed
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\Lesson[] $lessons
 */
class Booking extends Entity
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
        'student_id' => true,
        'package_id' => true,
        'booking_datetime' => true,
        'is_paid' => true,
        'completed' => true,
        'student' => true,
        'package' => true,
        'lessons' => true,
        'start_date_time' => true,
    ];
}

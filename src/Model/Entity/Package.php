<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $package_id
 * @property string|null $package_name
 * @property int|null $number_of_lessons
 * @property int|null $lesson_duration_minutes
 * @property string|null $cost
 * @property string|null $description
 */
class Package extends Entity
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
        'package_name' => true,
        'number_of_lessons' => true,
        'lesson_duration_minutes' => true,
        'cost' => true,
        'description' => true,
    ];
}

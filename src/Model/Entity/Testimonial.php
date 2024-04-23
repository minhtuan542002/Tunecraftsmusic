<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Testimonial Entity
 *
 * @property int $id
 * @property string $student_name
 * @property string $testimonial_title
 * @property string $testimonial_text
 * @property int $rating
 * @property string $image_url
 * @property \Cake\I18n\DateTime $created_at
 */
class Testimonial extends Entity
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
        'student_name' => true,
        'testimonial_title' => true,
        'testimonial_text' => true,
        'rating' => true,
        'image_url' => true,
        'created_at' => true,
    ];
}

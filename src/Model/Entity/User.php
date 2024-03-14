<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $user_id
 * @property string|null $email
 * @property string|null $password
 * @property string|null $phone
 * @property string|null $nonce
 * @property \Cake\I18n\DateTime|null $nonce_expiry
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $role_id
 * @property string|null $note
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'phone' => true,
        'nonce' => true,
        'nonce_expiry' => true,
        'first_name' => true,
        'last_name' => true,
        'role_id' => true,
        'note' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Hash the password before setting password
     *
     * @var password<string>
     */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}

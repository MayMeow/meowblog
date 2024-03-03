<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \MeowBlog\Model\Entity\Node[] $nodes
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
        'created' => true,
        'modified' => true,
        'nodes' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
        'email'
    ];

    protected array $_virtual = [
        'username'
    ];

    /**
     * Set user password
     *
     * @param string $password Password
     * @return string
     */
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($password);
    }

    protected function _getUsername(): ?string
    {
        if (isset($this->_fields['username'])) {
            return $this->_fields['username'];
        }

        if ($this->isEmpty('email')) {
            return null;
        }

        [$username, $_] = explode('@', $this->email);
        return $username;
    }
}

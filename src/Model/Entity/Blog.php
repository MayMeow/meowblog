<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $domain
 * @property string $theme
 * @property string $scheme
 * @property string $verification
 * @property string $default_route
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * 
 * @property \MeowBlog\Model\Entity\Link[] $links
 */
class Blog extends Entity
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
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'domain' => true,
        'theme' => true,
        'scheme' => true,
        'verification' => true,
        'created' => true,
        'modified' => true,
        'default_route' => true,
        'links' => true,
    ];
}

<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

use Cake\ORM\Entity;

/**
 * Link Entity
 *
 * @property int $id
 * @property int $blog_id
 * @property string $title
 * @property string $url
 * @property int $weight
 * @property bool $external
 *
 * @property \MeowBlog\Model\Entity\Blog $blog
 */
class Link extends Entity
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
        'blog_id' => true,
        'title' => true,
        'url' => true,
        'weight' => true,
        'external' => true,
        'blog' => true,
    ];
}

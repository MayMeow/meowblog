<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodesTag Entity
 *
 * @property int $id
 * @property int $node_id
 * @property int $tag_id
 *
 * @property \MeowBlog\Model\Entity\Node $node
 * @property \MeowBlog\Model\Entity\Tag $tag
 */
class NodesTag extends Entity
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
        'node_id' => true,
        'tag_id' => true,
        'node' => true,
        'tag' => true,
    ];
}

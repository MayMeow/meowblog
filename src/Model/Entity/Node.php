<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

use Cake\Collection\Collection;
use Cake\ORM\Entity;

/**
 * Node Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property bool $published
 * @property string $node_type
 * @property string $summary
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \MeowBlog\Model\Entity\User $user
 * @property \MeowBlog\Model\Entity\Blog $blog
 * @property \MeowBlog\Model\Entity\Tag[] $tags
 * @property string $tag_string
 * @method \MeowBlog\Model\Entity\Node findBySlug($slug)
 */
class Node extends Entity
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
        'user_id' => true,
        'blog_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'tags' => true,
        'tag_string' => true,
        'node_type' => true,
        'summary' => true,
    ];

    protected array $_virtual = [
        'tag_string',
        'type_name',
        'created_timestamp',
    ];

    /**
     * Return tags in string format
     *
     * @return string
     */
    protected function _getTagString()
    {
        if (isset($this->_fields['tag_string'])) {
            return $this->_fields['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');

        return trim($str, ', ');
    }

    protected function _getTypeName(): ?string
    {
        if (isset($this->_fields['type_name'])) {
            return $this->_fields['type_name'];
        }

        if (!isset($this->_fields['type_name'])) {
            return null;
        }
        return strtolower(NodeType::from($this->node_type)->name);
    }

    protected function _getCreatedTimestamp(): ?int
    {
        if (isset($this->_fields['created_timestamp'])) {
            return $this->_fields['created_timestamp'];
        }
        
        if (!isset($this->_fields['created_timestamp'])) {
            return null;
        }
        return $this->created->getTimestamp();
    }
}

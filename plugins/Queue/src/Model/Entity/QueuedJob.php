<?php
declare(strict_types=1);

namespace Queue\Model\Entity;

use Cake\ORM\Entity;

/**
 * QueuedJob Entity
 *
 * @property int $id
 * @property string $reference
 * @property string|null $data
 * @property int $priority
 * @property \Cake\I18n\DateTime $not_before
 * @property \Cake\I18n\DateTime|null $finished
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class QueuedJob extends Entity
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
        'reference' => true,
        'data' => true,
        'priority' => true,
        'not_before' => true,
        'finished' => true,
        'created' => true,
        'modified' => true,
    ];
}

<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var iterable<\MeowBlog\Model\Entity\Node> $nodes
 */

use MeowBlog\Model\Entity\NodeType;

?>
<div class="admin">
    <h3><?= __('Nodes') ?></h3>
        <div class="new-menu">
        <?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        </div>
    <div class="table-responsive">
        <table role="grid">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th>
                        <?= $this->Paginator->sort('title') ?>
                    </th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nodes as $node): ?>
                <tr>
                    <td><?= $this->Number->format($node->id) ?></td>
                    <td>
                        <?= $node->blog->title ?> /
                        <?php if ($node->title == $node->blog->domain) : ?>
                        <span data-tooltip="<?= __('This Is Homepage of {0} blog', $node->blog->title) ?>">
                            <?= h($node->title) ?>
                        </span>
                        <?php else : ?>
                            <?= h($node->title) ?>
                        <?php endif; ?>
                        <mark><?= NodeType::from($node->node_type)->name ?></mark>
                    </td>
                    <td>
                        <span data-tooltip="<?= $node->slug ?>">
                            <?= $node->published ? __('Yes') : __('No') ?>
                        </span>
                    </td>
                    <td><?= h($node->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $node->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $node->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

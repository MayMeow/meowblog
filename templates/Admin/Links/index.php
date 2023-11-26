<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var iterable<\MeowBlog\Model\Entity\Link> $links
 */
?>
<div class="admin">
    <h3><?= __('Links') ?></h3>
    <div class="new-menu">
        <?= $this->Html->link(__('New Link'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('blog_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th><?= $this->Paginator->sort('weight') ?></th>
                    <th><?= $this->Paginator->sort('external') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link): ?>
                <tr>
                    <td><?= $this->Number->format($link->id) ?></td>
                    <td><?= $link->has('blog') ? $this->Html->link($link->blog->title, ['controller' => 'Blogs', 'action' => 'view', $link->blog->id]) : '' ?></td>
                    <td><?= h($link->title) ?></td>
                    <td><?= h($link->url) ?></td>
                    <td><?= $this->Number->format($link->weight) ?></td>
                    <td><?= h($link->external) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $link->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $link->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $link->id], ['confirm' => __('Are you sure you want to delete # {0}?', $link->id)]) ?>
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

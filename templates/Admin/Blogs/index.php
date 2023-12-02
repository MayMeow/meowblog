<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var iterable<\MeowBlog\Model\Entity\Blog> $blogs
 */

?>
<div class="admin">
    <h3><?= __('Blogs') ?></h3>
    <div class="new-menu">
    <?= $this->Html->link(__('New Blog'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('domain') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?= $this->Number->format($blog->id) ?></td>
                    <td><?= h($blog->title) ?></td>
                    <td><?= $this->Html->link($blog->domain, 'https://' . $blog->domain) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $blog->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blog->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id)]) ?>
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

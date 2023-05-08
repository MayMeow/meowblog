<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var iterable<\MeowBlog\Model\Entity\Article> $articles
 */

use MeowBlog\Model\Entity\ArticleType;

?>
<div class="articles index content">
    <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Articles') ?></h3>
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
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <td>
                        <?= $article->blog->title ?> /
                        <?php if ($article->title == $article->blog->domain) : ?>
                        <span data-tooltip="<?= __('This Is Homepage of {0} blog', $article->blog->title) ?>">
                            <?= h($article->title) ?>
                        </span>
                        <?php else : ?>
                            <?= h($article->title) ?>
                        <?php endif; ?>
                        <mark><?= ArticleType::from($article->article_type)->name ?></mark>
                    </td>
                    <td>
                        <span data-tooltip="<?= $article->slug ?>">
                            <?= $article->published ? __('Yes') : __('No') ?>
                        </span>
                    </td>
                    <td><?= h($article->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
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

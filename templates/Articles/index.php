<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 * @var bool $currentBlog
 */
?>
<div class="articles index content">
    <h3><?= __('Latest Articles') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($articles as $article): ?>
        <div>
            <a href="<?= !$currentBlog ? 'https://'. $article->blog->domain : '' ?><?= $this->Url->build([
                'controller' => 'Articles',
                'action' => 'view',
                $article->slug
            ]) ?>" class="contrast"><?= $article->title ?></a>
            <small>
                <?= __('on') ?>
                <?= $article->created->format('d/m/Y') ?>
                <?php if (!$currentBlog) : ?>
                    <?= __('in') ?>
                    <?= $this->Html->link($article->blog->title, 'https://' . $article->blog->domain) ?>
                <?php endif; ?>
            </small>
        </div>
    <?php endforeach; ?>
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

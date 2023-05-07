<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var array<\MeowBlog\Model\View\ArticleViewModel> $articles
 * @var bool $currentBlog
 */
?>
<div class="articles index content">
    <h3><?= __('Latest Articles') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($articles as $article): ?>
        <div>
            <a href="<?= !$article->isCurrentBlog() ? 'https://'. $article->getArticle()->blog->domain : '' ?><?= $this->Url->build([
                'controller' => 'Articles',
                'action' => 'view',
                $article->getArticle()->slug
            ]) ?>" class="contrast"><?= $article->getArticle()->title ?></a>
            <small>
                <?php if (!$article->isCurrentBlog()) : ?>
                    <?= __('in') ?>
                    <?= $this->Html->link($article->getArticle()->blog->title, 'https://' . $article->getArticle()->blog->domain) ?>
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

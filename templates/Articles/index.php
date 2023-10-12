<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \Meowblog\Model\Entity\Article[] $articles
 * @var bool $currentBlog
 */
?>
<div class="articles index content">

    <?= $homePage ? $this->Markdown->parse($homePage) : '' ?>

    <h3><?= __('Latest Articles') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($articles as $article): ?>
        <div>
            <a href="<?= !$this->Articles->isInCurrentBlog($article) ? 'https://'. $article->blog->domain : '' ?><?= $this->Url->build([
                'controller' => 'Articles',
                'action' => 'view',
                $article->slug
            ]) ?>" class="contrast"><?= $article->title ?></a>
            <small>
                <?php if (!$this->Articles->isInCurrentBlog($article)) : ?>
                    <?= __('in') ?>
                    <?= $this->Html->link($article->blog->title, 'https://' . $article->blog->domain) ?>
                <?php endif; ?>
            </small>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="paginator">
        <nav>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?php //$this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        </nav>
        <p>
            <small><?= $this->Paginator->counter(__('This blog has {{count}} article(s) total')) ?></small>
        </p>
    </div>
</div>

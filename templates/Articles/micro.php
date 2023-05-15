<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var array<\MeowBlog\Model\View\ArticleViewModel> $articles
 */
?>
<div class="articles index content">

    <h3><?= __('Microblog') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($articles as $article): ?>
        <div class="micro-post">
            <div style="margin-bottom: 8px;">
            <mark data-tooltip="<?= $article->getArticle()->created ?>"><?= $this->Time->timeAgoInWords($article->getArticle()->created) ?></mark>
            </div>
            <?= $this->Markdown->parse($article->getArticle()->body)?>
            <!--<small><a class="contrast" href="#">Conversation</a></small>-->
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

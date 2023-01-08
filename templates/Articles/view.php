<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article $article
 */
?>
<div id="article">
    <h1><?= $article->title ?></h1>
    <div id="article-info">
        at <?= $article->created ?> by <?= $article->user->email ?>
    </div>
    <div>
        <?= $this->Markdown->parse($article->body); ?>
    </div>
</div>

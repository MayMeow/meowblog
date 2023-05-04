<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article $article
 */
?>
<div class="headings">
    <h2><?= $article->title ?></h2>
    <h3>at <?= $article->created ?>
</div>
<div id="article">
    <div>
        <?= $this->Markdown->parse($article->body); ?>
    </div>
</div>

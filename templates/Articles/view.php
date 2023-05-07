<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article $article
 */
?>
<div class="headings">
    <h2><?= $article->title ?></h2>
    <h3>at <?= $article->created ?></h3>
</div>
<div id="article">
    <div>
        <?= $this->Markdown->parse($article->body); ?>
    </div>
    <?php if ($article->tags) : ?>
        <div class="tags">
            <nav>
                <ul>
                    <?php foreach ($article->tags as $tag) : ?>
                        <li><?= $this->Html->link($tag->title, ['controller' => 'Tags', 'action' => 'view', $tag->id], ['role' => 'button']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
</div>

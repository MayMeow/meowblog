<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article $article
 */
?>

<div class="article">

    <div class="headings">
        <h2><?= $article->title ?></h2>
        <h3>at <?= $article->created ?></h3>
    </div>
    <?php if ($article->summary) : ?>
        <details>
            <summary role="button">🤖 <?= __('AI Summary')?></summary>
            <?= $this->Html->tag('div', $article->summary, ['class' => 'summary']) ?>
        </details>
    <?php endif; ?>

    <div id="article">
            <?= $this->Markdown->parse($article->body); ?>
        </div>
        <?php if ($article->tags) : ?>
            <div class="tags">
                <nav>
                    <ul>
                        <?php foreach ($article->tags as $tag) : ?>
                            <li><?= $this->Html->link($tag->title, ['controller' => 'Articles', 'action' => 'tags', $tag->title], ['role' => 'button']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>

</div>

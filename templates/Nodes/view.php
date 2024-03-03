<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Node $node
 */
?>

<div class="node">

    <div class="headings">
        <h2><?= $node->title ?></h2>
        <h3>at <?= $node->created ?></h3>
    </div>
    <?php if ($node->summary) : ?>
        <details>
            <summary>🤖 <?= __('AI Summary')?></summary>
            <?= $this->Html->tag('div', $node->summary) ?>
        </details>
    <?php endif; ?>

    <div id="node">
            <?= $this->Markdown->parse($node->body); ?>
        </div>
        <?php if ($node->tags) : ?>
            <div class="tags">
                <nav>
                    <ul>
                        <?php foreach ($node->tags as $tag) : ?>
                            <li><?= $this->Html->link($tag->title, ['controller' => 'Nodes', 'action' => 'tags', $tag->title], ['role' => 'button']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>

</div>

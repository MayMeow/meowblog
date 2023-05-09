<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var ?\MeowBlog\Model\Entity\Article $content
 */
?>
<div class="headings">
    <h2><?= __('Now') ?></h2>
    <h3><?= $content ? __('Last updated {0}', $content->created ) : '' ?></h3>
</div>
<div id="article">
    <p><?= __('This is my {0} page, a summary of what im currently doing or enjoying.', $this->Html->link('/now', 'https://nownownow.com/about', ['target' => '_blank']))?></p>
    <div>
        <?php if (!$content) : ?>
            <p><?= __('There is no update, come back later.') ?></p>
        <?php else : ?>
            <?= $this->Markdown->parse($content->body); ?>
        <?php endif; ?>
    </div>
</div>

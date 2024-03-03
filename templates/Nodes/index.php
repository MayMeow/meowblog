<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \Meowblog\Model\Entity\Node[] $nodes
 * @var bool $currentBlog
 */
?>
<div class="nodes index content">

    <?= $homePage ? $this->Markdown->parse($homePage) : '' ?>

    <h3><?= __('Latest Nodes') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($nodes as $node): ?>
        <div>
            <a href="<?= !$this->Nodes->isInCurrentBlog($node) ? 'https://'. $node->blog->domain : '' ?><?= $this->Url->build([
                'controller' => 'Nodes',
                'action' => 'view',
                $node->slug
            ]) ?>" class="contrast"><?= $node->title ?></a>
            <small>
                <?php if (!$this->Nodes->isInCurrentBlog($node)) : ?>
                    <?= __('in') ?>
                    <?= $this->Html->link($node->blog->title, 'https://' . $node->blog->domain) ?>
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
            <small><?= $this->Paginator->counter(__('This blog has {{count}} node(s) total')) ?></small>
        </p>
    </div>
</div>

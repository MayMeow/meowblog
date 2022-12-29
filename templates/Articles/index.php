<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="articles index content">
    <h3><?= __('Latest Articles') ?></h3>
    <div style="margin-bottom: 1em;">
    <?php foreach ($articles as $article): ?>
        <div>
            <?= $this->Html->link($article->title, [
                'action' => 'view',
                $article->slug
            ])?>
            <small>
                <?= __('on') ?>
                <?= $article->created->format('d/m/Y') ?>
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

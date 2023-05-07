<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Link $link
 * @var \Cake\Collection\CollectionInterface|string[] $blogs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Links'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="links form content">
            <?= $this->Form->create($link) ?>
            <fieldset>
                <legend><?= __('Add Link') ?></legend>
                <?php
                    echo $this->Form->control('blog_id', ['options' => $blogs]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('url');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('external');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

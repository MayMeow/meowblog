<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Blog $blog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $blog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Blogs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="blogs form content">
            <?= $this->Form->create($blog) ?>
            <fieldset>
                <legend><?= __('Edit Blog') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
                    echo $this->Form->control('domain');
                    echo $this->Form->control('theme', ['options' => $colorSchemes]);
                    echo $this->Form->control('default_route');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

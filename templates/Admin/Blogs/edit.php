<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Blog $blog
 */
?>
<div class="admin forms">
    <div class="new-menu">
        <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $blog->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'side-nav-item']
        ) ?>
        <?= $this->Html->link(__('List Blogs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
    <div>
        <?= $this->Form->create($blog) ?>
            <?php
                echo $this->Form->control('title');
                echo $this->Form->control('description');
                echo $this->Form->control('domain');
                echo $this->Form->control('default_route');
            ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

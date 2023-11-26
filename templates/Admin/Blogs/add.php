<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Blog $blog
 * @var string $colorSchemes
 */
?>
<div class="admin forms">
    <div class="new-menu">
    <?= $this->Html->link(__('List Blogs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
    <div>
        <?= $this->Form->create($blog) ?>
            <?php
                echo $this->Form->control('title');
                echo $this->Form->control('description');
                echo $this->Form->control('domain');
                echo $this->Form->control('theme', ['options' => $colorSchemes]);
                echo $this->Form->control('scheme', ['options' => $colorSchemeVariants]);
                // echo $this->Form->control('verification');
            ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

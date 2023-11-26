<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="new-menu">
        <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
    <div>
        <?= $this->Form->create($user) ?>
            <?php
                echo $this->Form->control('email');
                echo $this->Form->control('password');
            ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

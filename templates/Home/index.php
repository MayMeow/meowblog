<?php
/**
 * @var \MeowBlog\View\AppView $this;
 */
?>

<div class="article">
    <h2>Home</h2>

    <div class="new-menu">
        <?= $this->Html->link('Articles', [
            'action' => 'Index',
            'controller' => 'Articles',
            'prefix' => 'Admin'
        ]); ?>

        <?= $this->Html->link('Tags', [
            'action' => 'Index',
            'controller' => 'Tags',
            'prefix' => 'Admin'
        ]); ?>

        <?= $this->Html->link('Users', [
            'action' => 'Index',
            'controller' => 'Users',
            'prefix' => 'Admin'
        ]); ?>

        <?= $this->Html->link('Blogs', [
            'action' => 'Index',
            'controller' => 'Blogs',
            'prefix' => 'Admin'
        ]); ?>

        <?= $this->Html->link('Links', [
            'action' => 'Index',
            'controller' => 'Links',
            'prefix' => 'Admin'
        ]); ?>
    </div>

</div>
<?php
/**
 * @var \MeowBlog\View\AppView $this;
 */
?>

<div class="article">
    <h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
        </svg>
        Home
    </h2>

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

    <?= $this->Html->link('Queued Jobs', [
            'action' => 'Index',
            'controller' => 'QueuedJobs',
            'prefix' => 'Admin'
        ]); ?>

    <?= $this->Html->link('Resources (Files)', [
            'action' => 'Index',
            'controller' => 'Resources',
            'prefix' => 'Admin'
        ]); ?>
    </div>

</div>
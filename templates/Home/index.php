<?php
/**
 * @var \MeowBlog\View\AppView $this;
 */
?>

<div id="home-page">
    <h2>Home</h2>

    <ul>
        <li>
        <?= $this->Html->link('Articles', [
            'action' => 'Index',
            'controller' => 'Articles',
            'prefix' => 'Admin'
        ]); ?>
        </li>
        <li>
        <?= $this->Html->link('Tags', [
            'action' => 'Index',
            'controller' => 'Tags',
            'prefix' => 'Admin'
        ]); ?>
        </li>
        <li>
        <?= $this->Html->link('Users', [
            'action' => 'Index',
            'controller' => 'Articles',
            'prefix' => 'Admin'
        ]); ?>
        </li>
    </ul>

</div>
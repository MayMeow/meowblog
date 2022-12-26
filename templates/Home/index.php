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
        <?= $this->Html->link('Logout', [
            'action' => 'Logout',
            'controller' => 'Users',
            'prefix' => false
        ]); ?>
        </li>
    </ul>

</div>
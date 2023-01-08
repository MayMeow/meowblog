<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \MeowBlog\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['/app/assets/index-4dfde9ce']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <main class="container">
        <div id="app">
            <div id="header">
                <nav>
                    <ul>
                        <li>
                            <strong>
                                <?= $this->Html->link('Meowblog.app', url:'/') ?>
                            </strong> <br />
                            <small>Simple blogging app made with PHP</small>
                        </li>
                    </ul>
                    <ul>
                        <?php if ($this->Blog->isLoggedIn()) : ?>
                            <li><a href="/home">Admin</a></li>
                            <li><a href="/users/logout" role="button">Logout</a></li>
                        <?php else : ?>
                            <li><a href="/users/login" role="button">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer class="container">
        <small>
            Meowblog v0.18 <a href="https://github.com/MayMeow/meowblog">Source Code</a>
        </small>
    </footer>
</body>
</html>

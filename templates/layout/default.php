<?php
$appVersion = '0.19';
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

    <?= $this->Html->css(['/app/assets/index-4dfde9ce', 'https://cdn.maymeow.com/css/prism.css']) ?>

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
                        <li><a href="/tags">Tags</a></li>
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
            Meowblog v<?= $appVersion ?> <a href="https://github.com/MayMeow/meowblog">Source Code</a>
        </small>
    </footer>

    <?= $this->Html->script(['https://cdn.maymeow.com/js/prism.js']) ?>
</body>
</html>

<?php
$appVersion = '0.40.0';
$appDescription = $this->Blog->getName() ?? 'Meowblog';
?>
<!DOCTYPE html>
<html <?= $this->Blog->getSchemeVariant() ?>>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $appDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['main', 'https://cdn.maymeow.com/css/prism.css', $this->Blog->getTheme()]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <header class="mm-header">
            <div class="mm-header-inner">
                <div class=logo>
                    <span style="font-size: 2em; font-family: VC Honey Deck,Noto Serif KR,serif;">
                        <?= $this->Html->link($this->Blog->getName(), url:'/') ?>
                    </span> <br />
                    <small><?= $this->Blog->getDescription() ?></small><br />
                </div>
                <nav class="new-menu">
                    <?php if ($this->Blog->getLinks() != null) : ?>
                        <?php foreach ($this->Blog->getLinks() as $link) : ?>
                            <?= $this->Html->link($link->title, $link->url, ['target' => $link->external ? '_blank': null]) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($this->Blog->isLoggedIn()) : ?>
                        <a href="/home">Admin</a>
                        <a href="/users/logout">Logout</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>
        <div class="content">            
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <footer class="footer">
            <div style="text-align: center;">
                <small>Meowblog v<?= $appVersion ?> <a href="https://github.com/MayMeow/meowblog">Source Code</a></small>
            </div>
        </footer>
    </div>
    <?= $this->Html->script(['https://cdn.maymeow.com/js/prism.js']) ?>
</body>
</html>

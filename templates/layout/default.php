<?php
$appVersion = '0.35.0';
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

    <?= $this->Html->css(['/app/assets/index-283b9b1f', 'https://cdn.maymeow.com/css/prism.css', $this->Blog->getTheme()]) ?>

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
                            <span style="font-size: 2em; font-family: VC Honey Deck,Noto Serif KR,serif;">
                                <?= $this->Html->link($this->Blog->getName(), url:'/') ?>
                            </span> <br />
                            <small><?= $this->Blog->getDescription() ?></small><br />
                            <ul>
                                <?php if ($this->Blog->getLinks() != null) : ?>
                                    <?php foreach ($this->Blog->getLinks() as $link) : ?>
                                        <li><?= $this->Html->link($link->title, $link->url, ['target' => $link->external ? '_blank': null]) ?></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($this->Blog->isLoggedIn()) : ?>
                                    <li><a href="/home">Admin</a></li>
                                    <li><a href="/users/logout">Logout</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer class="container">
            <div style="text-align: center;">
                <small>Meowblog v<?= $appVersion ?> <a href="https://github.com/MayMeow/meowblog">Source Code</a></small>
            </div>
    </footer>

    <?= $this->Html->script(['https://cdn.maymeow.com/js/prism.js']) ?>
</body>
</html>

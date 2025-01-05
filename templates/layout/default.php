<?php
$appVersion = '0.54.1';
$appDescription = $this->Blog->getName() ?? 'Meowblog';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $appDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['main', 'https://cdn.maymeow.com/css/prism.css']) ?>

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
                        <a href="/home">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                    <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
                                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>
                                </svg>
                                Admin
                            </span>
                        </a>
                        <a href="/users/logout">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                                </svg>
                                Logout
                            </span>
                        </a>
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

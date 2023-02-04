<?php
$appVersion = '0.21.2';
$appDescription = 'Meowblog';
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

    <?= $this->Html->css(['/app/assets/index-62d919fa', 'https://cdn.maymeow.com/css/prism.css', $this->Blog->getTheme()]) ?>

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
                                <?= $this->Html->link($this->Blog->getName(), url:'/') ?>
                            </strong> <br />
                            <small><?= $this->Blog->getDescription() ?></small>
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
        <div class="grid">
            <div>
                <small>Meowblog v<?= $appVersion ?> <a href="https://github.com/MayMeow/meowblog">Source Code</a></small>
            </div>
            <div style="text-align: right;">
                <small>
                    Made with 
                    <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.99987 6.00001C10.6646 3.66763 14.4999 6.50001 15.9999 8.50001C17.4999 6.5 21.3351 3.66763 25.9999 6.00001C31.9999 8.99999 30.4998 16.5 25.9998 21C23.8041 23.1958 19.9371 27.0628 17.1087 29.2137C16.4552 29.7106 15.5614 29.6884 14.9226 29.1728C12.3299 27.08 8.16491 23.165 5.99987 21C1.49986 16.5 -0.000126839 8.99999 5.99987 6.00001Z" fill="#F8312F"/>
                    <path d="M15.9998 8.49998V11.5492C17.2695 8.86501 20.4252 5.28051 25.6578 5.83746C21.1482 3.80623 17.463 6.54908 15.9998 8.49998Z" fill="#CA0B4A"/>
                    <path d="M11.9456 5.53691C10.2614 4.95005 8.22499 4.88745 5.99987 6.00001C-0.000126839 8.99999 1.49986 16.5 5.99987 21C8.16491 23.165 12.3299 27.08 14.9226 29.1728C15.5614 29.6884 16.4552 29.7106 17.1087 29.2137C17.3629 29.0204 17.6255 28.8132 17.8945 28.5946C15.0398 26.4524 11.0335 23.0762 8.85898 21.1325C3.90218 16.702 2.24993 9.31788 8.85898 6.36425C9.93279 5.88435 10.9667 5.62654 11.9456 5.53691Z" fill="#CA0B4A"/>
                    <ellipse cx="23.4771" cy="12.5937" rx="2.83554" ry="4.78125" transform="rotate(30 23.4771 12.5937)" fill="#F37366"/>
                    </svg>
                    <a href="https://maymeow.com/">May</a></small>
            </div>
        </div>
    </footer>

    <?= $this->Html->script(['https://cdn.maymeow.com/js/prism.js']) ?>
</body>
</html>

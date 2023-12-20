<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
<rss version="2.0">
    <channel>
        <?php foreach ($articles as $article): ?>
            <item>
                <title><?= h($article->title) ?></title>
                <content type="html">
                    <?php
                        $cleanedContent = htmlspecialchars($this->Markdown->parse($article->body), ENT_XML1 | ENT_SUBSTITUTE, 'UTF-8');
                        $cleanedContent = str_replace(["\r\n", "\r", "\n"], ' ', $cleanedContent);
                    ?>
                    <?= sprintf('<![CDATA[ %s ]]>', $cleanedContent) ?>
                </content>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
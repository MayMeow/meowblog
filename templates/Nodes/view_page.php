<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Node $node
 */
?>
<div class="headings">
    <h2><?= $node->title ?></h2>
    <h3></h3>
</div>
<div id="node">
    <div>
        <?= $this->Markdown->parse($node->body); ?>
    </div>
</div>

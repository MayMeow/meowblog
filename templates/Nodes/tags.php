<!-- In templates/Nodes/tags.php -->
<h1>
    Nodes tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
<?php foreach ($nodes as $node): ?>
    <node>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $node->title,
            ['controller' => 'Nodes', 'action' => 'view', $node->slug]
        ); ?></h4>
        <span><?= h($node->created) ?></span>
        <span>
            &sharp;<?= $node->tag_string ?>
            <?php if ($this->Nodes->isInCurrentBlog($node)): ?>
                in  <?= $this->Html->link(
                    $node->blog->title,
                    'https://' . $node->blog->domain
                ); ?>
            <?php endif; ?>
        </span>
    </node>
<?php endforeach; ?>
</section>
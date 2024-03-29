<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Article $article
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<div class="admin forms">
    <div class="new-menu">
        <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $article->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']
        ) ?>
        <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
    <div>
        <?= $this->Form->create($article) ?>
            <?php
                echo $this->Form->control('blog_id', ['options' => $blogs]);
                echo $this->Form->control('title');
                echo $this->Form->control('article_type', ['options' => $articleTypes]);
                echo $this->Form->control('body');
                echo $this->Form->control('published');
                // echo $this->Form->control('tags._ids', ['options' => $tags]);
                echo $this->Form->control('tag_string', ['type' => 'text']);
                echo $this->Form->control('created');
            ?>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Blog $blog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Blog'), ['action' => 'edit', $blog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Blog'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Blogs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Blog'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="blogs view content">
            <h3><?= h($blog->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($blog->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($blog->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Domain') ?></th>
                    <td><?= h($blog->domain) ?></td>
                </tr>
                <tr>
                    <th><?= __('Theme') ?></th>
                    <td><?= h($this->Blog->getThemeName($blog->theme)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Scheme variant') ?></th>
                    <td><?= h($this->Blog->getSchemeName($blog->scheme)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Default route') ?></th>
                    <td><?= h($blog->default_route) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($blog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($blog->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($blog->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Verification') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($blog->verification)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

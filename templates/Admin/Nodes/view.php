<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Node $node
 */

use MeowBlog\Model\Entity\NodeType;

?>
<div class="admin">
    <div class="new-menu">
        <?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id], ['class' => 'side-nav-item']) ?>
        <?= $this->Form->postLink(__('Delete Node'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'side-nav-item']) ?>
        <?= $this->Html->link(__('List Nodes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        <?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
    </div>
    <div class="column-responsive column-80">
        <div class="nodes view content">
            <h3><?= h($node->title) ?> 
                <mark><?= $node->title == $node->blog->domain ? __('Home Page of {0}', $node->blog->title) : NodeType::from($node->node_type)->name ?></mark>
            </h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $node->has('user') ? $this->Html->link($node->user->id, ['controller' => 'Users', 'action' => 'view', $node->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($node->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($node->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($node->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Blog') ?></th>
                    <td><?= $node->has('blog') ? $this->Html->link($node->blog->title, ['controller' => 'Users', 'action' => 'view', $node->blog->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($node->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($node->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $node->published ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <div class="grid">
                    <div>
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($node->body)); ?>
                    </blockquote>
                    </div>
                    <div>
                        <?= $this->Markdown->parse($node->body) ?>
                    </div>
                </div>
            </div>
            <div class="related">
                <h4><?= __('Related Tags') ?></h4>
                <?php if (!empty($node->tags)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($node->tags as $tags) : ?>
                        <tr>
                            <td><?= h($tags->id) ?></td>
                            <td><?= h($tags->title) ?></td>
                            <td><?= h($tags->created) ?></td>
                            <td><?= h($tags->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

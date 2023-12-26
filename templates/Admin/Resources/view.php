<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Resource $resource
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Resource'), ['action' => 'edit', $resource->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Resource'), ['action' => 'delete', $resource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Resource'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="resources view content">
            <h3><?= h($resource->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($resource->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Path') ?></th>
                    <td>
                        <?= h($resource->path) ?>
                        <div>
                            <?= $this->Html->link('Link', h($resource->path) . '/' . h($resource->name)) ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($resource->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Size') ?></th>
                    <td><?= $resource->size === null ? '' : $this->Number->format($resource->size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($resource->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($resource->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

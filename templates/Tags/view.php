<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var \MeowBlog\Model\Entity\Tag $tag
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="tags view content">
            <h3><?= h($tag->title) ?> <mark><?= __('Tag') ?></mark></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($tag->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tag->id) ?></td>
                </tr>
            </table>
    </div>
</div>

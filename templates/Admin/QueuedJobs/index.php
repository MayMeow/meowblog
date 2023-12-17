<?php
/**
 * @var \MeowBlog\View\AppView $this
 * @var iterable<\Queue\Model\Entity\QueuedJob> $queuedJobs
 */

use Queue\Utils\QueuedJobPriority;

?>

<div class="admin">
<h3><?= __('Queued Jobs') ?></h3>

<div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('Reference') ?></th>
                    <th><?= __('Not before') ?></th>
                    <th><?= __('Priority') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($queuedJobs as $job): ?>
                <tr>
                    <td><?= h($job->reference) ?></td>
                    <td><?= h($job->not_before) ?></td>
                    <td><?= h(QueuedJobPriority::from($job->priority)->name) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
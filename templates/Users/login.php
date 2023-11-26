
<div class="admin">
    <?= $this->Form->create() ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    <?= $this->Form->button(__('Login'), ['class' => 'w100']); ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->Form->create(null, ['class' => 'custom-form-class']); ?>
<div class="form-group">
    <?= $this->Form->control('field1', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Field 1']); ?>
</div>
<div class="form-group">
    <?= $this->Form->control('field2', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Field 2']); ?>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>

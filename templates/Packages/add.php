<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<style>
    .package-details table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .package-details th,
    .package-details td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }
</style>

<div class="content mt-3">
    <h3><?= __('Add Package') ?></h3>
    <div class="package-details">
        <?= $this->Form->create($package) ?>
        <fieldset>
            <?= $this->Form->control('package_name', [
                'required' => 'required',
                ]) ?>
            <?= $this->Form->control('number_of_lessons', [
                'required' => 'required',
                'min' => '1',
                ]) ?>
            <?= $this->Form->control('lesson_duration_minutes', [
                'label' => 'Lesson Duration (Minutes)',
                'required' => 'required',
                'min' => '1',
                ]) ?>
            <?= $this->Form->control('cost_dollars', [
                'label' => 'Cost (AUD)',
                'required' => 'required',
                'min' => '0',
                ]) ?>
            <?= $this->Form->control('description', [
                'rows' => '3',
                'type' => 'textarea',
                ]) ?>
        </fieldset>
        <div class="d-flex gap-3 mt-3">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

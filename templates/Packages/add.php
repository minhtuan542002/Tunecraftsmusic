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
    .content {
        margin: 20px;
    }

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

    .package-actions {
        margin-top: 20px;
    }

    .side-nav {
        padding-left: 10px;
    }

    .side-nav h4.heading {
        margin-top: 0;
        color: #3498db;
    }

    .btn {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .btn i {
        margin-right: 5px;
    }
</style>

<div class="content">
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
    </div>
</div>
<aside class="user-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i> Add', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'id' => 'submit-form']) ?>
        <?= $this->Form->end() ?>
    </div>
</aside>
<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>

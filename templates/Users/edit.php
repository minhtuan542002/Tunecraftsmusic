<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    .user-details table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .user-details th,
    .user-details td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .note {
        margin-top: 20px;
        background-color: #f5f5f5;
        padding: 10px;
        border-left: 3px solid #3498db;
    }

</style>

<div class="mt-3">
    <h3><?= __('Edit User') ?></h3>
    <div class="user-details">
        <?= $this->Form->create($user) ?>
        <h4><?= __('User ID: {0}', $user->user_id) ?></h4>
        <fieldset>
            <?= $this->Form->control('first_name'), [
                'required' => true,
            ] ?> 
            <?= $this->Form->control('last_name'), [
                'required' => true,
            ] ?>
            <?= $this->Form->control('email'), [
                'type' => 'email',
                'required' => true,
            ] ?>
            <?= $this->Form->control('phone', [
                'type' => 'tel',
                'required' => true,
            ]) ?>
            <?= $this->Form->control('note', [
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



<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
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
    <h3><?= h("View User") ?></h3>
    <div class="user-details">
        <table>
            <tr>
                <th><?= __('Role') ?></th>
                <td><?= h($user->role->role_name) ?></td>
            </tr>
            <tr>
                <th><?= __('First Name') ?></th>
                <td><?= h($user->first_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Last Name') ?></th>
                <td><?= h($user->last_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Phone') ?></th>
                <td><?= h($user->phone) ?></td>
            </tr>
            <tr>
                <th><?= __('User Id') ?></th>
                <td><?= $this->Number->format($user->user_id) ?></td>
            </tr>
        </table>
        <div class="note">
            <strong><?= __('Note') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($user->note)); ?>
            </blockquote>
        </div>
    </div>
</div>
<div class="d-flex gap-3 mt-3">
    <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
    <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $user->user_id], ['escape' => false, 'class' => 'btn btn-success']) ?>
    <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $user->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->first_name)]) ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

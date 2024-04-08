<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    .content {
        margin: 20px;
    }

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

    .user-actions {
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
    <h3><?= __('Edit User') ?></h3>
    <div class="user-details">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <table>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $this->Form->select('role_id', $roles, ['empty' => false]) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= $this->Form->control('first_name', ['style' => 'width: 25%;']) ?></td> 
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= $this->Form->control('last_name', ['style' => 'width: 25%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= $this->Form->control('email', ['style' => 'width: 30%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= $this->Form->control('phone', ['style' => 'width: 15%;']) ?></td> 
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Form->control('user_id', ['disabled' => true, 'style' => 'width: 25%;']) ?></td> 
                </tr>
                <tr>
                    <th><?= __('Note') ?></th>
                    <td><?= $this->Form->textarea('note', ['style' => 'width: 50%; resize: vertical;']) ?></td>

                </tr>
            </table>
        </fieldset>
    </div>
</div>

<aside class="user-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i> Save', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'id' => 'submit-form']) ?>
        <?= $this->Form->end() ?>
    </div>
</aside>

<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>

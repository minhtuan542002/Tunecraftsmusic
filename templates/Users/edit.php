<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
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
                    <td><?= $this->Form->input('first_name') ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= $this->Form->input('last_name') ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= $this->Form->input('email') ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= $this->Form->input('phone') ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Form->input('user_id', ['disabled' => true]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Note') ?></th>
                    <td><?= $this->Form->input('note', ['rows' => 5]) ?></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<aside class="user-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i>', ['action' => 'index'], ['escape' => false, 'title' => __('Back'), 'class' => 'side-nav-item']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i>', '#', ['escape' => false, 'title' => __('Submit'), 'class' => 'submit-link side-nav-item', 'id' => 'submit-form']) ?>
    </div>
</aside>

<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>

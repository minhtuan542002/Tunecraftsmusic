<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="content">
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

<aside class="user-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i>', ['action' => 'index'], ['escape' => false, 'title' => __('Back')]) ?>
        <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $user->user_id], ['escape' => false, 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $user->id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $user->first_name)]) ?>
    </div>
</aside>

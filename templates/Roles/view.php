<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->role_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->role_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="roles view content">
            <h3><?= h($role->role_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Role Name') ?></th>
                    <td><?= h($role->role_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role Id') ?></th>
                    <td><?= $this->Number->format($role->role_id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Role Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($role->role_description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

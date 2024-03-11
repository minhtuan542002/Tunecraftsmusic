<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacher $teacher
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Teacher'), ['action' => 'edit', $teacher->teacher_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Teacher'), ['action' => 'delete', $teacher->teacher_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->teacher_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Teachers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Teacher'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teachers view content">
            <h3><?= h($teacher->teacher_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $teacher->hasValue('user') ? $this->Html->link($teacher->user->user_id, ['controller' => 'Users', 'action' => 'view', $teacher->user->user_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Teacher Availability') ?></th>
                    <td><?= h($teacher->teacher_availability) ?></td>
                </tr>
                <tr>
                    <th><?= __('Teacher Id') ?></th>
                    <td><?= $this->Number->format($teacher->teacher_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

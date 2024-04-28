<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blocker $blocker
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Blocker'), ['action' => 'edit', $blocker->blocker_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Blocker'), ['action' => 'delete', $blocker->blocker_id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocker->blocker_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Blockers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Blocker'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="blockers view content">
            <h3><?= h($blocker->blocker_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Teacher') ?></th>
                    <td><?= $blocker->hasValue('teacher') ? $this->Html->link($blocker->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $blocker->teacher->teacher_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Blocker Id') ?></th>
                    <td><?= $this->Number->format($blocker->blocker_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Time') ?></th>
                    <td><?= h($blocker->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Time') ?></th>
                    <td><?= h($blocker->end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Recurring') ?></th>
                    <td><?= $blocker->recurring ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($blocker->note)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

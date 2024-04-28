<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Blocker> $blockers
 */
?>
<div class="blockers index content">
    <?= $this->Html->link(__('New Blocker'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Blockers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('blocker_id') ?></th>
                    <th><?= $this->Paginator->sort('teacher_id') ?></th>
                    <th><?= $this->Paginator->sort('start_time') ?></th>
                    <th><?= $this->Paginator->sort('end_time') ?></th>
                    <th><?= $this->Paginator->sort('recurring') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blockers as $blocker): ?>
                <tr>
                    <td><?= $this->Number->format($blocker->blocker_id) ?></td>
                    <td><?= $blocker->hasValue('teacher') ? $this->Html->link($blocker->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $blocker->teacher->teacher_id]) : '' ?></td>
                    <td><?= h($blocker->start_time) ?></td>
                    <td><?= h($blocker->end_time) ?></td>
                    <td><?= h($blocker->recurring) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $blocker->blocker_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blocker->blocker_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blocker->blocker_id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocker->blocker_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

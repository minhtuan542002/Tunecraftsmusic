<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Teacher> $teachers
 */
?>
<div class="teachers index content">
    <?= $this->Html->link(__('New Teacher'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Teachers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('teacher_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('teacher_availability') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?= $this->Number->format($teacher->teacher_id) ?></td>
                    <td><?= $teacher->hasValue('user') ? $this->Html->link($teacher->user->user_id, ['controller' => 'Users', 'action' => 'view', $teacher->user->user_id]) : '' ?></td>
                    <td><?= h($teacher->teacher_availability) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $teacher->teacher_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teacher->teacher_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teacher->teacher_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->teacher_id)]) ?>
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

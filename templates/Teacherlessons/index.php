<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Teacherlesson> $teacherlessons
 */
?>
<div class="teacherlessons index content">
    <?= $this->Html->link(__('New Teacherlesson'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Teacherlessons') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('teacherlesson_id') ?></th>
                    <th><?= $this->Paginator->sort('teacher_id') ?></th>
                    <th><?= $this->Paginator->sort('lesson_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teacherlessons as $teacherlesson): ?>
                <tr>
                    <td><?= $this->Number->format($teacherlesson->teacherlesson_id) ?></td>
                    <td><?= $teacherlesson->hasValue('teacher') ? $this->Html->link($teacherlesson->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $teacherlesson->teacher->teacher_id]) : '' ?></td>
                    <td><?= $teacherlesson->hasValue('lesson') ? $this->Html->link($teacherlesson->lesson->lesson_id, ['controller' => 'Lessons', 'action' => 'view', $teacherlesson->lesson->lesson_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $teacherlesson->teacherlesson_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teacherlesson->teacherlesson_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teacherlesson->teacherlesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacherlesson->teacherlesson_id)]) ?>
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

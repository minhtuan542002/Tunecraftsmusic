<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
?>
<div class="lessons index content">
    <?= $this->Html->link(__('New Lesson'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lessons') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('lesson_id') ?></th>
                    <th><?= $this->Paginator->sort('booking_id') ?></th>
                    <th><?= $this->Paginator->sort('teacher_id') ?></th>
                    <th><?= $this->Paginator->sort('lesson_start_time') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= $this->Number->format($lesson->lesson_id) ?></td>
                    <td><?= $lesson->hasValue('booking') ? $this->Html->link($lesson->booking->booking_id, ['controller' => 'Bookings', 'action' => 'view', $lesson->booking->booking_id]) : '' ?></td>
                    <td><?= $lesson->hasValue('teacher') ? $this->Html->link($lesson->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $lesson->teacher->teacher_id]) : '' ?></td>
                    <td><?= h($lesson->lesson_start_time) ?></td>
                    <td class="d-flex gap-3">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lesson->lesson_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lesson->lesson_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lesson->lesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->lesson_id)]) ?>
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

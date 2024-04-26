<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lesson'), ['action' => 'edit', $lesson->lesson_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lesson'), ['action' => 'delete', $lesson->lesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->lesson_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lesson'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessons view content">
            <h3><?= h($lesson->lesson_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Booking') ?></th>
                    <td><?= $lesson->hasValue('booking') ? $this->Html->link($lesson->booking->booking_id, ['controller' => 'Bookings', 'action' => 'view', $lesson->booking->booking_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Teacher') ?></th>
                    <td><?= $lesson->hasValue('teacher') ? $this->Html->link($lesson->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $lesson->teacher->teacher_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Id') ?></th>
                    <td><?= $this->Number->format($lesson->lesson_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Start Time') ?></th>
                    <td><?= h($lesson->lesson_start_time) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($lesson->note)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

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
                    <th><?= __('Teacherlesson') ?></th>
                    <td><?= $lesson->hasValue('teacherlesson') ? $this->Html->link($lesson->teacherlesson->teacherlesson_id, ['controller' => 'Teacherlessons', 'action' => 'view', $lesson->teacherlesson->teacherlesson_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Id') ?></th>
                    <td><?= $this->Number->format($lesson->lesson_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Duration Minutes') ?></th>
                    <td><?= $lesson->lesson_duration_minutes === null ? '' : $this->Number->format($lesson->lesson_duration_minutes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Start Datetime') ?></th>
                    <td><?= h($lesson->lesson_start_datetime) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($lesson->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

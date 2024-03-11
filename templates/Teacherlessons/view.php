<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacherlesson $teacherlesson
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Teacherlesson'), ['action' => 'edit', $teacherlesson->teacherlesson_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Teacherlesson'), ['action' => 'delete', $teacherlesson->teacherlesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacherlesson->teacherlesson_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Teacherlessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Teacherlesson'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teacherlessons view content">
            <h3><?= h($teacherlesson->teacherlesson_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Teacher') ?></th>
                    <td><?= $teacherlesson->hasValue('teacher') ? $this->Html->link($teacherlesson->teacher->teacher_id, ['controller' => 'Teachers', 'action' => 'view', $teacherlesson->teacher->teacher_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson') ?></th>
                    <td><?= $teacherlesson->hasValue('lesson') ? $this->Html->link($teacherlesson->lesson->lesson_id, ['controller' => 'Lessons', 'action' => 'view', $teacherlesson->lesson->lesson_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Teacherlesson Id') ?></th>
                    <td><?= $this->Number->format($teacherlesson->teacherlesson_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

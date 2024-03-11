<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 * @var \Cake\Collection\CollectionInterface|string[] $teacherlessons
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessons form content">
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                <legend><?= __('Add Lesson') ?></legend>
                <?php
                    echo $this->Form->control('teacherlesson_id', ['options' => $teacherlessons, 'empty' => true]);
                    echo $this->Form->control('lesson_start_datetime', ['empty' => true]);
                    echo $this->Form->control('lesson_duration_minutes');
                    echo $this->Form->control('notes');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

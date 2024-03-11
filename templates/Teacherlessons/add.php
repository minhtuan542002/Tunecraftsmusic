<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacherlesson $teacherlesson
 * @var \Cake\Collection\CollectionInterface|string[] $teachers
 * @var \Cake\Collection\CollectionInterface|string[] $lessons
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Teacherlessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teacherlessons form content">
            <?= $this->Form->create($teacherlesson) ?>
            <fieldset>
                <legend><?= __('Add Teacherlesson') ?></legend>
                <?php
                    echo $this->Form->control('teacher_id', ['options' => $teachers, 'empty' => true]);
                    echo $this->Form->control('lesson_id', ['options' => $lessons, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

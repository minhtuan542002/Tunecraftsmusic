<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->student_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->student_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Students'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="students form content">
            <?= $this->Form->create($student) ?>
            <fieldset>
                <legend><?= __('Edit Student') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

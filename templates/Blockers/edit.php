<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blocker $blocker
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $blocker->blocker_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $blocker->blocker_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Blockers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="blockers form content">
            <?= $this->Form->create($blocker) ?>
            <fieldset>
                <legend><?= __('Edit Blocker') ?></legend>
                <?php
                    echo $this->Form->control('teacher_id', ['options' => $teachers]);
                    echo $this->Form->control('start_time');
                    echo $this->Form->control('end_time');
                    echo $this->Form->control('note');
                    echo $this->Form->control('recurring');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

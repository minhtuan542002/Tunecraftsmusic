<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lessontype $lessontype
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lessontypes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessontypes form content">
            <?= $this->Form->create($lessontype) ?>
            <fieldset>
                <legend><?= __('Add Lessontype') ?></legend>
                <?php
                    echo $this->Form->control('duration_minutes');
                    echo $this->Form->control('cost');
                    echo $this->Form->control('name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
            <?= $this->Html->link(__('Edit Lessontype'), ['action' => 'edit', $lessontype->lesson_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lessontype'), ['action' => 'delete', $lessontype->lesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessontype->lesson_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lessontypes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lessontype'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessontypes view content">
            <h3><?= h($lessontype->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($lessontype->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Id') ?></th>
                    <td><?= $this->Number->format($lessontype->lesson_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration Minutes') ?></th>
                    <td><?= $lessontype->duration_minutes === null ? '' : $this->Number->format($lessontype->duration_minutes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $lessontype->cost === null ? '' : $this->Number->format($lessontype->cost) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

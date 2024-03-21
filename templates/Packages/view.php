<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->package_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->package_id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->package_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="packages view content">
            <h3><?= h($package->package_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Package Name') ?></th>
                    <td><?= h($package->package_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Id') ?></th>
                    <td><?= $this->Number->format($package->package_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number Of Lessons') ?></th>
                    <td><?= $package->number_of_lessons === null ? '' : $this->Number->format($package->number_of_lessons) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Duration Minutes') ?></th>
                    <td><?= $package->lesson_duration_minutes === null ? '' : $this->Number->format($package->lesson_duration_minutes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost Dollars') ?></th>
                    <td><?= $package->cost_dollars === null ? '' : $this->Number->format($package->cost_dollars) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($package->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

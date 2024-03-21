<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="content">
    <h3><?= h("View Package") ?></h3>
    <div class="package-details">
        <table>
            <tr>
                <th><?= __('Package Name') ?></th>
                <td><?= h($package->package_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Package ID') ?></th>
                <td><?= $this->Number->format($package->package_id) ?></td>
            </tr>
            <tr>
                <th><?= __('Number of Lessons') ?></th>
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

<aside class="package-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i>', ['action' => 'index'], ['escape' => false, 'title' => __('Back')]) ?>
        <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $package->package_id], ['escape' => false, 'title' => __('Edit')]) ?>
        <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $package->package_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $package->package_id)]) ?>
    </div>
</aside>

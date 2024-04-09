<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<style>
    .content {
        margin: 20px;
    }

    .package-details table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .package-details th,
    .package-details td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .note {
        margin-top: 20px;
        background-color: #f5f5f5;
        padding: 10px;
        border-left: 3px solid #3498db;
    }

</style>

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
        <div class="note">
            <strong><?= __('Description') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($package->description)); ?>
            </blockquote>
        </div>
    </div>
</div>


<div class="d-flex gap-3 mt-3 ms-3">
    <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
    <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $package->package_id], ['escape' => false, 'class' => 'btn btn-success']) ?>
    <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $package->package_id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $package->package_id)]) ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

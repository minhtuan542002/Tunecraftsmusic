<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    .resource-details table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .resource-details th,
    .resource-details td {
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

<div class="mt-3">
    <h3><?= h("View Resource") ?></h3>
    <div class="resource-details">
        <table>
        <tr>
                <th><?= __('Heading') ?></th>
                <td><?= h($resource->heading) ?></td>
            </tr>
            <tr>
                <th><?= __('Resource Link') ?></th>
                <td><?= h($resource->resource) ?></td>
            </tr>
            <tr>
                <th><?= __('Resource ID') ?></th>
                <td><?= $this->Number->format($resource->resource_id) ?></td>
            </tr>
        </table>
        <div class="note">
            <strong><?= __('Resource Description') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($resource->description)); ?>
            </blockquote>
        </div>
    </div>
</div>
<div class="d-flex gap-3 mt-3">
    <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
    <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $resource->resource_id], ['escape' => false, 'class' => 'btn btn-success']) ?>
    <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $resource->resource_id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $resource->resource_id)]) ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

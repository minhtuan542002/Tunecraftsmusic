<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<div class="mt-3">
    <h3><?= __('Edit Learning Resource') ?></h3>
    <div class="resource-details">
        <?= $this->Form->create($resource) ?>
        <h4><?= __('Resource ID: {0}', $resource->id) ?></h4>
        <fieldset>
            <div class="mb-3">
                <?= $this->Form->control('heading') ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('description', ['rows' => '3', 'type' => 'textarea']) ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('resource', ['label' => 'Resource']) ?>
            </div>
        </fieldset>
        <div class="d-flex gap-3 mt-3">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<style>
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
</style>

<div class="mt-3">
    <h3><?= __('Edit Package') ?></h3>
    <div class="package-details">
        <?= $this->Form->create($package) ?>
        <fieldset>
            <table>
                <tr>
                    <th><?= __('Package Name') ?></th>
                    <td><?= $this->Form->control('package_name', ['style' => 'width: 30%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of Lessons') ?></th>
                    <td><?= $this->Form->control('number_of_lessons', ['style' => 'width: 10%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Duration (Minutes)') ?></th>
                    <td><?= $this->Form->control('lesson_duration_minutes', ['style' => 'width: 10%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost (Dollars)') ?></th>
                    <td><?= $this->Form->control('cost_dollars', ['style' => 'width: 10%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $this->Form->textarea('description', ['style' => 'width: 75%; resize: vertical;']) ?></td>
                </tr>
            </table>
        </fieldset>
        <div class="d-flex gap-3 mt-3">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>


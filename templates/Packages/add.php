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

    .package-actions {
        margin-top: 20px;
    }

    .side-nav {
        padding-left: 10px;
    }

    .side-nav h4.heading {
        margin-top: 0;
        color: #3498db;
    }

    .btn {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .btn i {
        margin-right: 5px;
    }
</style>

<div class="content">
    <h3><?= __('Add Package') ?></h3>
    <div class="package-details">
        <?= $this->Form->create($package) ?>
        <fieldset>
            <table>
                <tr>
                    <th><?= __('Package Name') ?></th>
                    <td><?= $this->Form->control('package_name', [
                            'style' => 'width: 30%;',
                            
                        ]) ?></td>
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
                    <th><?= __('Cost (AUD)') ?></th>
                    <td><?= $this->Form->control('cost_dollars', ['style' => 'width: 10%;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $this->Form->textarea('description', ['style' => 'width: 75%; resize: vertical;']) ?></td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>
<aside class="user-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i> Add', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'id' => 'submit-form']) ?>
        <?= $this->Form->end() ?>
    </div>
</aside>
<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>

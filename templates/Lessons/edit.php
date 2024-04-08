<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 * @var string[]|\Cake\Collection\CollectionInterface $bookings
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
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
    <div class="lessons-edit">
        <div class="lessons form content">
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                <legend><?= __('Edit Lesson') ?></legend>
                <table class = "table">
                    <tr>
                        <th><?= __('Lesson Start Time and Date') ?></th>
                        <td><?= $this->Form->input('lesson_start_time', [
                            'type' => 'datetime-local',
                            'required' => "required",
                            'class'=>'form-control',
                        ]) ?></td>
                    </tr>
                    <tr>
                        <th><?= __("Teacher's Note") ?></th>
                        <td><?= $this->Form->input('note', [
                            'type' => 'textarea',
                            'rows' => '4',
                            'class'=>'form-control',
                        ]) ?></td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
    <aside class="user-actions">
        <div class="side-nav">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['controller'=>'bookings','action' => 'view',  $lesson->booking_id], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('<i class="fas fa-save fa-fw"></i> Save', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'id' => 'submit-form']) ?>
            <?= $this->Form->end() ?>
        </div>
    </aside>
</div>
<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>
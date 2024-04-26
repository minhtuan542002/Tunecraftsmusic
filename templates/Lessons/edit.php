<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 * @var string[]|\Cake\Collection\CollectionInterface $bookings
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<div class="content">
    <div class="lessons-edit">
        <div class="lessons form content">
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                <legend><?= __('Edit Lesson') ?></legend>
                <table class = "table">
                    <tr>
                        <th><?= __('Lesson Start Time and Date') ?></th>
                        <td><?php
                            echo $this->Form->control('lesson_start_time', [
                                'label' => false,
                                'required' => "required",
                                'class'=>'form-control',
                            ]) ?>
                            Note that scheduling the lesson time to the past imply that it is completed 
                            <br>
                            While scheduling to the future imply it is yet to happen
                        </td>
                    </tr>
                    <tr>
                        <th><?= __("Teacher's Note") ?></th>
                        <td><?= $this->Form->control('note', [
                            'label' => false,
                            'type' => 'textarea',
                            'rows' => '4',
                            'class'=>'form-control',
                        ]) ?></td>
                    </tr>
                </table>
            </fieldset>
            <div class="d-flex gap-3 mt-3">
                <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['controller'=>'bookings','action' => 'view',  $lesson->booking_id], ['escape' => false, 'class' => 'btn btn-primary']) ?>
                <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blocker $blocker
 * @var \Cake\Collection\CollectionInterface|string[] $teachers
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
<div class="row">     
    <div class="column column-80">
        <div class="blockers form content  mb-3">
            <?= $this->Form->create($blocker) ?>
            <fieldset>
                <legend><?= __('Add New Schedule Blocker') ?></legend>
                <?php
                    //echo $this->Form->control('teacher_id', ['options' => $teachers]);
                    echo '
                    <div class="form-group mb-3 row ">
                        <label class="col-sm-2 col-form-label" for="start-time-time">
                            <span>Weekday</span>
                        </label>
                        <div class="col-sm-10">';
        
                    echo $this->Form->select('week_day', [
                        '1' => 'Monday',
                        '2' => 'Tuesday',
                        '3' => 'Wednesday',
                        '4' => 'Thursday',
                        '5' => 'Friday',
                        '6' => 'Saturday',
                        '7' => 'Sunday',
                    ], [
                        'required' => "required",
                        'class' => 'form-control'
                    ]);
                    echo '
                        </div>
                    </div>';

                    echo $this->Form->control('start_time_time', [
                        'label'=> 'Start Time',
                        'type' => 'time',
                        'step' => 900,
                        'required' => "required",
                    ]);
                    echo $this->Form->control('end_time_time', [
                        'label'=> 'End Time',
                        'type' => 'time',
                        'step' => 900,
                        'required' => "required",
                    ]);
                    echo $this->Form->control('note', [
                        'required' => "required",
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', 
                ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 
                'class' => 'btn btn-success', 'type' => 'submit']) ?>
            <?= $this->Form->end() ?>
        </div>
            <div id='calendar-wrap'>
        <div id='calendar'></div>
    </div> 
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
            },
            locale: 'au',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            slotMinTime: '08:00:00',
            slotMaxTime: '22:00:00',
            aspectRatio: 2, // Adjust aspect ratio based on screen size
            height: '50vh',
            events: [
                <?php foreach ($lessons as $line): ?>
                    {
                    title: 'Lesson with <?= $line->student_name ?>',
                    start: '<?= $line->lesson_start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $line->lesson_end_time->format('Y-m-d H:i:s') ?>',
                    url: '<?= $this->Url->build(['controller'=>'lessons', 
                        'action'=> 'edit_admin', $line->lesson_id ]) ?>',
                    <?= $line->booking->is_paid? "" : "color: 'orange',"  ?>
                    durationEditable: false,
                    },
                <?php endforeach; ?>
                <?php foreach ($blockers as $line): ?>
                    <?php if ($line->recurring):?>
                        {
                        title: 'Recurring: <?= $line->note ?>',
                        daysOfWeek: [ '<?= $line->end_time->format('N') ?>' ],
                        startTime: '<?= $line->start_time->format('H:i:s') ?>',
                        endTime: '<?= $line->end_time->format('H:i:s') ?>',
                        url: '<?= $this->Url->build(['controller'=>'blockers', 
                            'action'=> 'edit', $line->blocker_id ]) ?>',
                        color: 'gray',
                        },
                    <?php else: ?>
                        {
                        title: '<?= $line->note ?>',
                        start: '<?= $line->start_time->format('Y-m-d H:i:s') ?>',
                        end: '<?= $line->end_time->format('Y-m-d H:i:s') ?>',
                        url: '<?= $this->Url->build(['controller'=>'blockers', 
                            'action'=> 'edit', $line->blocker_id ]) ?>',
                        color: 'gray',
                        },
                    <?php endif; ?>
                <?php endforeach; ?>
            ],
            
            eventOverlap: false,
            slotDuration: '00:15:00',
            eventConstraint: {
                start:new Date().toISOString().split('T')[0], // Prevent events from being moved to dates before today
            },
        });
        calendar.render();
    });

    $('#start-time-time').on('input', function() {
        $('#end-time-time').attr('min', $('#start-time-time').val());
    });
    $('#end-time-time').on('input', function() {
        $('#start-time-time').attr('max', $('#end-time-time').val());
    });
</script>
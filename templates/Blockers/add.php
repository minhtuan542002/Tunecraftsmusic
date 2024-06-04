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
    <div class="column column-80 mb-3">
        <div class="blockers form content">
            <?= $this->Form->create($blocker) ?>
            <fieldset>
                <legend><?= __('Add New Schedule Blocker') ?></legend>
                <?php
                    //echo $this->Form->control('teacher_id', ['options' => $teachers]);
                    echo $this->Form->control('start_time', [
                        'min'=> date('Y-m-d H').":00:00",
                        'step' => 900,
                        'required' => "required",
                    ]);
                    echo $this->Form->control('end_time', [
                        'min'=> date('Y-m-d H').":00:00",
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
    </div>
    
    <div id='calendar-wrap'>
        <div id='calendar'></div>
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
            height: '55vh',
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

    $('#start-time').on('input', function() {
        $('#end-time').attr('min', $('#start-time').val());
    });
    $('#end-time').on('input', function() {
        $('#start-time').attr('max', $('#end-time').val());
    });
</script>
<style>
    @media (max-width: 768px) {

        .fc-col-header-cell-cushion {
            font-size: 0.8em;
        }

        .fc .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr{
            display: flex;
            flex-direction: column;
        }
    }
</style>
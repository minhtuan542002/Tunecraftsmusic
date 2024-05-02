<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blocker $blocker
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
<div class="">
    <div id='calendar-wrap' class= 'mb-3'>
        <div id='calendar'></div>
    </div>    
    <?= $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $blocker->blocker_id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $blocker->blocker_id),
            'class' => 'btn btn-danger']
    ) ?>
    <div class="column column-80">
        <div class="blockers form content">
            <?= $this->Form->create($blocker) ?>
            <fieldset>
                <legend><?= __('Edit Blocker') ?></legend>
                <?php
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
            slotMinTime: '06:00:00',
            slotMaxTime: '24:00:00',
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
                    {
                    title: '<?= $line->note ?>',
                    start: '<?= $line->start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $line->end_time->format('Y-m-d H:i:s') ?>',
                    url: '<?= $this->Url->build(['controller'=>'blockers', 
                        'action'=> 'edit', $line->blocker_id ]) ?>',
                    color: '<?= $line->blocker_id === $blocker->blocker_id ? "purple" : "gray" ?>',
                    editable: <?= $line->blocker_id === $blocker->blocker_id ? "true" : "false" ?>,
                    },
                <?php endforeach; ?>
            ],
            initialDate: "<?= $blocker->start_time->format('Y-m-d') ?>",
            eventOverlap: false,
            slotDuration: '00:15:00',
            aspectRatio: 2, // Adjust aspect ratio based on screen size
            height: 'auto',
            eventDrop: function(arg) {
                // Perform your action here
                //console.log('Event dropped:', arg);
                //console.log('Delta:', arg.event.start); 
                var startDate = arg.event.start;
                var formattedStartDate = startDate.getFullYear() + '-' +
                    ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + startDate.getDate()).slice(-2) + 'T' +
                    ('0' + startDate.getHours()).slice(-2) + ':' +
                    ('0' + startDate.getMinutes()).slice(-2);
                console.log('HH:', formattedStartDate); 
                $('#start-time').val(formattedStartDate);
                var startDate = arg.event.end;
                var formattedStartDate = startDate.getFullYear() + '-' +
                    ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + startDate.getDate()).slice(-2) + 'T' +
                    ('0' + startDate.getHours()).slice(-2) + ':' +
                    ('0' + startDate.getMinutes()).slice(-2);
                console.log('HH:', formattedStartDate); 
                $('#end-time').val(formattedStartDate);
            },
            eventResize: function(arg) {
                // Perform your action here
                //console.log('Event dropped:', arg);
                //console.log('Delta:', arg.event.start); 
                var startDate = arg.event.start;
                var formattedStartDate = startDate.getFullYear() + '-' +
                    ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + startDate.getDate()).slice(-2) + 'T' +
                    ('0' + startDate.getHours()).slice(-2) + ':' +
                    ('0' + startDate.getMinutes()).slice(-2);
                console.log('HH:', formattedStartDate); 
                $('#start-time').val(formattedStartDate);
                var startDate = arg.event.end;
                var formattedStartDate = startDate.getFullYear() + '-' +
                    ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + startDate.getDate()).slice(-2) + 'T' +
                    ('0' + startDate.getHours()).slice(-2) + ':' +
                    ('0' + startDate.getMinutes()).slice(-2);
                console.log('HH:', formattedStartDate); 
                $('#end-time').val(formattedStartDate);
            },
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
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blocker $blocker
 * @var \Cake\Collection\CollectionInterface|string[] $teachers
 */
$this->setLayout('dashboard');
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
<div class="row">
    
    <div id='calendar-wrap' class= 'mb-3'>
        <div id='calendar'></div>
    </div>      
    <div class="column column-80">
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
            <?= $this->Form->button(__('Submit')) ?>
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
                        'action'=> 'edit', $line->lesson_id ]) ?>',
                    <?= $line->booking->is_paid? "" : "color: 'orange',"  ?>
                    durationEditable: false,
                    },
                <?php endforeach; ?>
            ],
            
            eventOverlap: false,
            slotDuration: '00:15:00',
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
                $('#lesson-start-time').val(formattedStartDate);
            },
            eventConstraint: {
                start:new Date().toISOString().split('T')[0], // Prevent events from being moved to dates before today
            },
        });
        calendar.render();
    });
</script>
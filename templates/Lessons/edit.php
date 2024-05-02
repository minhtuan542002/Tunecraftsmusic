<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 * @var string[]|\Cake\Collection\CollectionInterface $bookings
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
 */
$this->layout = "default";
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
<div class="content">
    <div class="lessons-edit">
        <div class="lessons form content">
            <h4><?= 'Lesson with '. $lesson->student_name ?></h4>
            <!-- <div id='external-events'>
                <h4>Draggable Events</h4>

                <div id='external-events-list'>
                    <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 1</div>
                    </div>
                </div>
            </div> -->

            <div id='calendar-wrap' class= 'mb-3'>
                <div id='calendar'></div>
            </div>
            <p><b>Change to different views and move the lesson around</b> to input your prefered start date</p>
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                <table class = "table">
                    <tr>
                        <th id="time-date-name"><?= __('Lesson Start Time and Date') ?></th>
                        <td>
                            <b id="write-time-start">
                                <?= $lesson->lesson_start_time->format('d/m/Y  H:i') ?>
                            </b>
                            <div style = "display: None;">
                            <?php
                            echo $this->Form->control('lesson_start_time', [
                                'label' => false,
                                'required' => "required",
                                'class'=>'form-control',
                                'min'=> date('Y-m-d H', strtotime("+7 days")).":00:00",
                                'step' => 900,
                                //'format'=> 'dd-MM-YYYY hh:mm',
                                //'value'=> $lesson->lesson_start_time->format('c'),
                            ]) ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><?= __("Is completed") ?></th>
                        <td><?= $lesson->lesson_end_time < date('d-m-Y')? 'Completed':'Incomplete'?></td>
                    </tr>
                    <tr>
                        <th><?= __("Lesson Duration") ?></th>
                        <td><?= $lesson ->duration . " minutes" ?></td>
                    </tr>
                    <tr>
                        <th><?= __("Teacher's Note") ?></th>
                        <td><?= $lesson ->note? $lesson ->note:"None" ?></td>
                    </tr>
                    
                </table>
            </fieldset>
            <div class="d-flex gap-3 mt-3">
                <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Go to Booking', ['controller'=>'bookings','action' => 'view_one',  $lesson->booking_id], ['escape' => false, 'class' => 'btn btn-primary']) ?>
                <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    function getMinDate(){
        var minDate = new Date();
        minDate.setDate(new Date().getDate() + 7);
        minDate.setHours(6);
        minDate.setMinutes(0);
        minDate.setSeconds(0);
        //console.log("-----"+minDate.toISOString());
        return minDate;
    }
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
            aspectRatio: 2, // Adjust aspect ratio based on screen size
            height: 'auto',
            events: [
                {
                    start: "2023-01-29T20:00:00",
                    end: getMinDate().toISOString().split('T')[0],
                    display: 'background',
                    color: 'gray',
                },
                <?php foreach ($lessons as $line): ?>
                    {
                    title: 'Violin Lesson',
                    start: '<?= $line->lesson_start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $line->lesson_end_time->format('Y-m-d H:i:s') ?>',
                    url: '<?= $this->Url->build(['controller'=>'lessons', 
                        'action'=> 'edit', $line->lesson_id ]) ?>',
                    <?= $line->lesson_id === $lesson->lesson_id ? "color: 'purple'," : 
                        ($line->booking->is_paid? "" : "color: 'orange',") ?>
                    editable: <?= $line->lesson_id === $lesson->lesson_id ? "true" : "false" ?>,
                    durationEditable: false,
                    },
                <?php endforeach; ?>
                <?php foreach ($blockers as $blocker): ?>
                    {
                    start: '<?= $blocker->start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $blocker->end_time->format('Y-m-d H:i:s') ?>',
                    color: 'gray',
                    overlap: false,
                    display: 'background',
                    },
                <?php endforeach; ?>
                <?php foreach ($block_lessons as $line): ?>
                    {
                    start: '<?= $line->lesson_start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $line->lesson_end_time->format('Y-m-d H:i:s') ?>',
                    color: 'gray',
                    overlap: false,
                    display: 'background',
                    },
                <?php endforeach; ?>
            ],
            initialDate: "<?= $lesson->lesson_start_time->format('Y-m-d') ?>",
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
                $('#write-time-start').text(startDate.toLocaleString('en-AU', {
                    hour12: true,}));
            },
            eventConstraint: {
                start:getMinDate().toISOString().split('T')[0], 
            },
        });
        calendar.render();
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
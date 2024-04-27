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
            <button id="completed" type="button" class="btn btn-outline-warning">
                Mark as Completed
            </button>
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                Please notify the students of changes in case they do not check in the website in time
                <table class = "table">
                    <tr>
                        <th id="time-date-name"><?= __('Lesson Start Time and Date') ?></th>
                        <td><?php
                            echo $this->Form->control('lesson_start_time', [
                                'label' => false,
                                'required' => "required",
                                'class'=>'form-control',
                                'min'=> date('Y-m-d H').":00:00",
                                'step' => 900,
                                //'format'=> 'dd-MM-YYYY hh:mm',
                                //'value'=> $lesson->lesson_start_time->format('c'),
                            ]) ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= __("Is completed") ?></th>
                        <td><?= $lesson->lesson_end_time < date('d-m-Y')? 'Completed':'Incomplete'?></td>
                    </tr>
                    <tr>
                        <th><?= __("Student Full Name") ?></th>
                        <td><?= $lesson ->student_full_name ?></td>
                    </tr>
                    <tr>
                        <th><?= __("Lesson Duration") ?></th>
                        <td><?= $lesson ->duration . " minutes" ?></td>
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
                    <?= $line->lesson_id === $lesson->lesson_id ? "color: 'purple'," : "" ?>
                    editable: <?= $line->lesson_id === $lesson->lesson_id ? "true" : "false" ?>,
                    durationEditable: false,
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
            },
            eventConstraint: {
                start:new Date().toISOString().split('T')[0], // Prevent events from being moved to dates before today
            },
        });
        calendar.render();
    });

    $('#completed').click(function(){
        if($('#completed').hasClass('is-active')){
            $('#completed').removeClass('is-active');
            $('#completed').text('Mark as Completed');
            $('#time-date-name').text("Lesson Start Time and Date");
            $('#lesson-start-time').attr('min', $('#lesson-start-time').attr('max'));
            $('#lesson-start-time').removeAttr('max');
            $('#completed').css({"background-color": "", "color":''});
        } else {
            $('#time-date-name').text("Lesson Started At");
            $('#lesson-start-time').attr('max', $('#lesson-start-time').attr('min'));
            $('#lesson-start-time').removeAttr('min');
            $('#completed').css({"background-color": "orange", "color": 'black'});
            $('#completed').addClass('is-active');
            $('#completed').text('Reschedule');
        }
    });
</script>
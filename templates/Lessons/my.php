<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
$this->layout = 'default';
?>
<div class="lessons index content mt-3">
    <div class="d-flex gap-5 mb-3">
        <h3><?= __('My calendar') ?> </h3>
            
    </div>
    <div id='calendar'></div>
    <div class = 'mt-3 d-flex justify-content-left gap-2 border border-dark rounded p-3'>
        <div class="badge text-bg-primary">
            Paid Lesson
        </div>
        <div class="badge text-bg-warning">
            Unpaid Lesson
        </div>        
        <div class="badge text-bg-secondary">
            Cannot be modified
        </div>        
    </div>
    
</div>
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
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
            initialView: 'timeGridWeek',
        },
        locale: 'au',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        eventOverlap: false,
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
            <?php foreach ($lessons as $lesson): ?>
                {
                title: 'Violin Lesson',
                start: '<?= $lesson->lesson_start_time->format('Y-m-d H:i:s') ?>',
                end: '<?= $lesson->lesson_end_time->format('Y-m-d H:i:s') ?>',
                <?= (strtotime($lesson->lesson_end_time) >= strtotime("+7 days"))?
                    "url: '". $this->Url->build(['controller'=>'lessons', 
                    'action'=> 'edit', $lesson->lesson_id ]) . "'," : "" ?>
                <?= $lesson->booking->is_paid? "" : "color: 'orange'," ?>
                },
            <?php endforeach; ?>
        ]
        });
    calendar.render();
    });

</script>

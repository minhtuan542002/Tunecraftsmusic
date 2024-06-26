<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
$this->layout = 'default';
?>
<div class="lessons index content mt-3">
    <p> The studio is located at 4 Tyrone street, Camberwell VIC 3124. On your first lesson,
        please arrive on time.
    </P>
    <div class="d-flex gap-5 mb-3">
        <h3><?= __('My Calendar') ?> </h3>
            
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
            Occupied
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
        slotMinTime: '08:00:00',
        slotMaxTime: '22:00:00',
        aspectRatio: 2, // Adjust aspect ratio based on screen size
        slotDuration: '00:15:00',
        height: '70vh',
        events: [
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
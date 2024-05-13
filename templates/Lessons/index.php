<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
?>
<div class="lessons index content mt-3">
    <div class="d-flex gap-5 mb-3">
        <h3><?= __('My Calendar') ?> </h3>
            
    </div>
    <div class = 'mt-3 d-flex gap-2 border border-dark rounded p-3'>
        <div class="badge text-bg-primary">
            Paid Lesson
        </div>
        <div class="badge text-bg-warning">
            Unpaid Lesson
        </div>
    </div>
    <div class = 'my-3'>
        <?= $this->Html->link(__('Add Temporary Blockers'), 
            ['controller'=>'blockers', 'action' => 'add'], ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link(__('Add Recurring Blockers'), 
            ['controller'=>'blockers', 'action' => 'addRecur'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div id='calendar-wrap'>
        <div id='calendar'></div>
    </div>
</div>
<?= $this->Html->script('/vendor/fullcalendar-6.1.11/dist/index.global.min.js') ?>
<script>
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
        height: 'auto',
        slotDuration: '00:15:00',
        events: [
            <?php foreach ($lessons as $lesson): ?>
                {
                title: 'Lesson with <?= $lesson->student_name ?>',
                start: '<?= $lesson->lesson_start_time->format('Y-m-d H:i:s') ?>',
                end: '<?= $lesson->lesson_end_time->format('Y-m-d H:i:s') ?>',
                url: '<?= $this->Url->build(['controller'=>'lessons', 
                    'action'=> 'edit_admin', $lesson->lesson_id ]) ?>',
                <?= $lesson->booking->is_paid? "" : "color: 'orange'," ?>
                },
            <?php endforeach; ?>
            <?php foreach ($blockers as $blocker): ?>
                <?php if ($blocker->recurring):?>
                    {
                    title: 'Recurring: <?= $blocker->note ?>',
                    daysOfWeek: [ '<?= $blocker->end_time->format('N')=="7" ? "0" : 
                        $blocker->end_time->format('N')?>' ],
                    startTime: '<?= $blocker->start_time->format('H:i:s') ?>',
                    endTime: '<?= $blocker->end_time->format('H:i:s') ?>',
                    url: '<?= $this->Url->build(['controller'=>'blockers', 
                        'action'=> 'edit', $blocker->blocker_id ]) ?>',
                    color: 'gray',
                    },
                <?php else: ?>
                    {
                    title: '<?= $blocker->note ?>',
                    start: '<?= $blocker->start_time->format('Y-m-d H:i:s') ?>',
                    end: '<?= $blocker->end_time->format('Y-m-d H:i:s') ?>',
                    url: '<?= $this->Url->build(['controller'=>'blockers', 
                        'action'=> 'edit', $blocker->blocker_id ]) ?>',
                    color: 'gray',
                    },
                <?php endif; ?>
            <?php endforeach; ?>
        ]
        });
    calendar.render();
    });

</script>

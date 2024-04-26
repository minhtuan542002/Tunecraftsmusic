<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
?>
<div class="lessons index content mt-3">
    <div class="d-flex gap-5 mb-3">
        <h3><?= __('My calendar') ?> </h3>
        <?= $this->Html->link('<i class="fas fa-plus fa-fw"></i> Add Package', ['action' => 'add'], 
            ['escape' => false, 'class' => 'btn btn-info']) ?> 
    </div>
    <div id='calendar'></div>
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
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        selectable: true,
        });
    calendar.render();
    });

</script>

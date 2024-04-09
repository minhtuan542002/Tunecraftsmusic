<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<section id="my-lesson" class="my-lesson "> 
    <div class="bookings my content mt-5 pt-5">
        <div class="bookings index content my-bookings">
            <div class="d-flex gap-5">
                <h3><?= __('My Bookings') ?> </h3>
                <?= $this->Html->link('<i class="fas fa-plus fa-fw"></i> New Booking', ['action' => 'add'], 
                    ['escape' => false, 'class' => 'btn btn-info']) ?> 
            </div>
            <div class="table-responsive user-table-container pt-5">
                <table class= "table dataTable" id= 'dataTable'>
                    <thead>
                        <tr>
                            <th><?= h('#ID') ?></th>
                            <th><?= h('Weekly Date & Time') ?></th>
                            <th><?= h('Remaining Lessons') ?></th>
                            <th><?= h('Upcoming Lesson') ?></th>
                            <th><?= h('Each Lesson Duration') ?></th>
                            <th><?= h('Is Paid for') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?= $booking->booking_id ?></td>
                                <td><?= $booking->booking_datetime->format('l H:i') ?></td>
                                <td><?= $booking->remain_count ?></td>
                                <td><?= $booking->upcoming != null ? $booking->upcoming->lesson_start_time->format('d/m/Y  H:i') : 'None' ?></td>
                                <td><?= $booking->package->lesson_duration_minutes . " mins" ?></td>
                                <td><?= $booking->is_paid? "Yes":"No" ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view_one', $booking->booking_id], ['class' => 'btn btn-info']) ?>
                                    <?php if(!$booking->is_paid):?>
                                        <?= $this->Form->postLink(__('Cancel'), ['action' => 'delete', $booking->booking_id], [
                                            'confirm' => __('Are you sure you want to cancel your booking?'), 'class' => 'btn btn-warning']) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->booking_id], ['class' => 'btn btn-primary']) ?>
                                    <?php else:?>
                                    
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "columnDefs": [
                {
                    "targets": [6],
                    "orderable": false
                }
            ],
            "language": {
                "emptyTable": "No data available in table",
                "search": '<i class="fas fa-search"></i>',
                "searchPlaceholder": "Search...",
            },
            "dom": '<"top"lf>rt<"bottom"ip><"clear">'
        });
    });
</script>

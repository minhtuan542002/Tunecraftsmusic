<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
$this->layout = 'dashboard';
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<section class="page-section clearfix">
    <div class="bookings index mt-3">
        <h3><?= __('All Bookings') ?></h3>
        <div class="table-responsive user-table-container">
            <table class="table dataTable" id="dataTable">
                <thead>
                    <tr>
                        <th><?= h('#ID') ?></th>
                        <th><?= h('Customer Name') ?></th>
                        <th><?= h('Weekly Date & Time') ?></th>
                        <th><?= h('Remaining Lessons') ?></th>
                        <th><?= h('Upcoming Lesson') ?></th>
                        <th><?= h('Each Lesson Duration') ?></th>
                        <th><?= h('Is Paid for') ?></th>
                        <th><?= h('Notes') ?></th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= $booking->booking_id ?></td>
                        <td><?= $booking->student->user->first_name . " " . $booking->student->user->last_name ?></td>
                        <td><?= $booking->booking_datetime->format('l H:i') ?></td>
                        <td><?= $booking->remain_count ?></td>
                        <td><?= $booking->upcoming != null ? $booking->upcoming->lesson_start_time->format('d/m/Y  H:i') : 'None' ?></td>
                        <td><?= $booking->package->lesson_duration_minutes . " mins" ?></td>
                        <td><?= $this->Form->postLink(__($booking->is_paid? "Yes":"No" ), ['action' => 'togglePaid', $booking->booking_id], 
                            ['class' => 'btn btn-outline-success btn-sm', 
                                'confirm' => __('Are you sure you want confirm the payment status as '. ($booking->is_paid? "UNPAID":"PAID" ))]) ?></td>
                        <td><?= $booking->note==NULL? "None":$booking->note ?></td>
                        <td class="d-flex gap-2">
                            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i> View', ['action' => 'view', $booking->booking_id], 
                                ['escape' => false, 'class' => 'btn btn-primary btn-sm']) ?>
                            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit_admin', $booking->booking_id], 
                                ['escape' => false, 'class' => 'btn btn-success btn-sm']) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', 
                                ['action' => 'delete', $booking->booking_id], 
                                ['escape' => false, 'class' => 'btn btn-danger btn-sm', 
                                    'confirm' => __('Are you sure you want to cancel booking # {0}?', $booking->booking_id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                    "targets": [7],
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

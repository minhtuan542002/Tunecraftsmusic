<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
$this->layout = 'dashboard';
?>
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="card shadow mt-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Manage <em>Bookings</em></h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Weekly Date & Time</th>
                        <th>Lessons Left</th>
                        <th>Upcoming Lesson</th>
                        <th>Duration</th>
                        <th>Paid</th>
                        <th>Booking ID</th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= $booking->student->user->first_name . " " . $booking->student->user->last_name ?></td>
                            <td><?= $booking->booking_datetime->format('l H:i') ?></td>
                            <td><?= $booking->remain_count ?></td>
                            <td  data-sort = "<?= h($booking->upcoming->lesson_start_time->format('Y-m-d H:i')) ?>">
                                <?= $booking->upcoming != null ? h($booking->upcoming->lesson_start_time->format('H:ia l, d M Y')) : 'None' ?>
                            </td>
                            <td><?= $booking->package->lesson_duration_minutes . " mins" ?></td>
                            <td><?= $this->Form->postLink(__($booking->is_paid? "Paid":"Unpaid" ), ['action' => 'togglePaid', $booking->booking_id], 
                                    ['class' => __('btn '. ($booking->is_paid?'btn-success':'btn-outline-success') .' btn-sm paid-button'),
                                        'confirm' => __('Are you sure you want confirm the payment status as '. ($booking->is_paid? "UNPAID":"PAID" ))]) ?></td>
                            <td><?= $booking->booking_id ?></td>
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthMenu": [10, 25, 50, 100], // Show entries options
            "language": {
                "lengthMenu": "Show _MENU_ entries", // Customize show entries label
                "search": '<i class="fas fa-search" aria-hidden="true"></i>', // Custom search icon
                "searchPlaceholder": "Search...", // Placeholder text for search input
            },
            "columnDefs": [
                { "targets": 7, "sortable": false, "searchable": false }, // Disable sorting and searching for the Actions column (0-based index)
                {
                    "render": function ( data, type, row ) {
                        // Format date as desired (e.g., DD/MM/YYYY)
                        return new Date(data).toLocaleDateString('en-AU') + ' ' + 
                            new Date(data).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    },
                    "targets": 3 // Apply to the second column (Date)
                }
            ],
            "dom": '<"row align-items-center mb-3"<"col-md-6"l><"col-md-6"f>>' +
                   '<"table-responsive"t>' +
                   '<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>', // Adjust the DOM layout for search and show entries on the same row
        });
    });
</script>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="row mb-5 mt-2">
    <!-- <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i>', ['action' => 'view', $booking->booking_id], ['escape' => false, 'title' => __('View')]) ?>
            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $booking->booking_id], ['escape' => false, 'title' => __('Edit')]) ?>
            <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $booking->booking_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to cancel booking # {0}?', $booking->booking_id)]) ?>
        </div>
    </aside> -->
    <div class="column-responsive column-80">
        <div class="bookings view content">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['controller'=>'bookings','action' => 'index'], 
                ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <div class="d-flex gap-5 mt-3">
                <h3>View My Booking </h3>
                
            </div>
            <?= $this->Flash->render() ?>
            <div class = "table-responsive pb-5">
                <table class="table">
                    <tr>
                        <th><?= __('Student') ?></th>
                        <td>
                            <?php if ($booking->has('student')) : ?>
                                <?= $this->Html->link(
                                    h($booking->student->user->first_name . ' ' . 
                                        $booking->student->user->last_name). ' - User ID: ' .
                                        $booking->student->user->user_id,
                                    ['controller' => 'Users', 'action' => 'view', $booking->student->user->user_id]
                                ) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($booking->booking_id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Weakly Datetime') ?></th>
                        <td><?= $booking->booking_datetime->format('l H:i') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Each Lesson Duration') ?></th>
                        <td><?= $booking->package->lesson_duration_minutes . " mins" ?></td>
                    </tr>
                    <tr>
                        <th><?= h('Upcoming Lesson') ?></th>
                        <td><?= $booking->upcoming->lesson_start_time->format('d/m/Y  H:i') ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Number of Remaining Lessons') ?></th>
                        <td><?= $booking->remain_count ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Payment Confirmed') ?></th>
                        <td><?= $booking->is_paid? "Yes":"No" ?></td>
                    </tr>
                </table>
            </div>

            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit Booking', ['action' => 'edit', $booking->booking_id], 
                    ['escape' => false, 'class' => 'btn btn-success']) ?> 
            <div class="related pt-5">
                <?php if (!($booking->remain_count == 0)) : ?>
                    <h4><?= __('Included Lessons') ?></h4>                
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th><?= __('Lesson Schedule') ?></th>
                                    <th><?= __('Is completed') ?></th>
                                    <th><?= __("Teacher's Note") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lessons as $lesson) : ?>
                                <tr>
                                    <td><?= h($lesson->lesson_start_time) ?></td>
                                    <td><?= h($lesson->lesson_start_time  < date('Y-m-d H:i:s')? 'Yes':'No') ?></td>
                                    <td><?= h($lesson->note != null? $lesson->note:"None") ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i> Back to My Bookings', ['action' => 'index'], 
                ['escape' => false, 'class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>
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
                    "targets": [2],
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

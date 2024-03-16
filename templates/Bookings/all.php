<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
$this->layout = 'main_page';
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<section class="page-section clearfix">
<div class="container">
    <div class="row">
        <div class="col-xl-9 mx-auto bg-faded p-5 rounded">
<div class="bookings index content">
    <h3><?= __('My Bookings') ?></h3>
    <?= $this->Flash->render() ?>
    <div class="table-responsive">
        <table class= "table dataTable" id= 'dataTable'>
            <thead>
                <tr>
                    <th><?= h('Start Date & Time') ?></th>
                    <th><?= h('End Date & Time') ?></th>
                    <th><?= h('Service Completed') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= h($booking->start_datetime) ?></td>
                    <td><?= h($booking->end_datetime) ?></td>
                    <td><?= ($booking->service_completed)? "Yes":"No" ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View Booking'), ['action' => 'view_one', $booking->id], ['class' => 'btn btn-info']) ?>
                        <?= $this->Form->postLink(__('Cancel Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to cancel your booking?'), 'class' => 'btn btn-warning']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</div>
</div>
</div>
</div>
    </section>

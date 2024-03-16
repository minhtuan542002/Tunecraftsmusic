<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<div class="bookings index content">
    <div class="d-flex">
        <div style="margin-top: 10px;"><h3><?= __('Bookings') ?></h3></div>
        <!-- <div style="margin-left: 20px;"><?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'btn btn-info', 'style' => 'margin-top: 10px;']) ?></div> -->
    </div>
    <div class="table-responsive">
        <table class= "table dataTable" id= 'dataTable'>
            <thead>
                <tr>
                    <th><?=h('Booking Id') ?></th>
                    <th><?= h('Customer Name') ?></th>
                    <th><?= h('Customer Id') ?></th>
                    <th><?= h('Start Date & Time') ?></th>
                    <th><?= h('End Date & Time') ?></th>
                    <th><?= h('Service Completed') ?></th>
                    <th><?=h('Additional Notes') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $this->Number->format($booking->id) ?></td>
                    <td>
                        <?php
                        if ($booking->has('customer')) {
                            echo $this->Html->link($booking->customer->first_name . ' ' . $booking->customer->last_name, ['controller' => 'Customers', 'action' => 'view', $booking->customer->id]);
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </td>
                    <td><?= $booking->has('customer') ? $this->Html->link($booking->customer->id, ['controller' => 'Customers', 'action' => 'view', $booking->customer->id]) : '' ?></td>
                    <td><?= h($booking->start_datetime) ?></td>
                    <td><?= h($booking->end_datetime) ?></td>
                    <td><?= ($booking->service_completed)? 'Yes':'No' ?></td>
                    <td><?= h($booking->additional_notes) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $booking->id], ['class' => 'btn btn-info']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->id], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'btn btn-danger']) ?>
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

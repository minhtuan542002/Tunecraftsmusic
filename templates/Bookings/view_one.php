<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i>', ['action' => 'view', $booking->booking_id], ['escape' => false, 'title' => __('View')]) ?>
            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $booking->booking_id], ['escape' => false, 'title' => __('Edit')]) ?>
            <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $booking->booking_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to cancel booking # {0}?', $booking->booking_id)]) ?>
            <!-- <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'btn btn-success']) ?> -->
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings view content">
            <h3>Booking ID: <?= h($booking->booking_id) ?></h3>
            <?= $this->Flash->render() ?>
            <div class = "table-responsive">
            <table class="table">
                <tr>
                    <th><?= __('Customer') ?></th>
                    <td>
                        <?php if ($booking->has('customer')) : ?>
                            <?= $this->Html->link(
                                h($booking->customer->id . ' - ' . $booking->customer->first_name . ' ' . $booking->customer->last_name),
                                ['controller' => 'Customers', 'action' => 'view', $booking->customer->id]
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
                    <th><?= __('Payment Confirmed') ?></th>
                    <td><?= $booking->is_paid? "Yes":"No" ?></td>
                </tr>
            </table>
            </div>
            <div class="related">
                <h4><?= __('Included Lessons') ?></h4>
                <?php if (!($booking->remaining == 0)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Service Name') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('No Of Unit') ?></th>
                            <!--<th class="actions"><?= __('Actions') ?></th>-->
                        </tr>
                        <?php foreach ($booking_lines as $bookingLines) : ?>
                        <tr>
                            <td><?= h($bookingLines->id) ?></td>
                            
                            <!--<td><?= h($bookingLines->booking_id) ?></td>-->
                            <td><?= h($bookingLines->service->service_name) ?></td>
                            <td><?= h($bookingLines->service_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BookingLines', 'action' => 'view', $bookingLines->id], ['class' => 'btn btn-info']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BookingLines', 'action' => 'edit', $bookingLines->id], ['class' => 'btn btn-warning']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BookingLines', 'action' => 'delete', $bookingLines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookingLines->id), 'class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <!--<div class="related">
                <h4><?= __('Related Invoices') ?></h4>
                <?php if (!empty($booking->invoices)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Invoice Total') ?></th>
                            <th><?= __('Pay Datetime') ?></th>
                            <th><?= __('Booking Id') ?></th>
                            <th><?= __('Surcharge') ?></th>
                            <th><?= __('Discount') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($booking->invoices as $invoices) : ?>
                        <tr>
                            <td><?= h($invoices->id) ?></td>
                            <td><?= h($invoices->invoice_total) ?></td>
                            <td><?= h($invoices->pay_datetime) ?></td>
                            <td><?= h($invoices->booking_id) ?></td>
                            <td><?= h($invoices->surcharge) ?></td>
                            <td><?= h($invoices->discount) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'my', $invoices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>-->
        </div>
    </div>
</div>

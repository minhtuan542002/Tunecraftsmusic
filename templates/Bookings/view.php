<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
$this->layout = 'dashboard';
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link(__('View All Bookings'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
            <?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->id], ['class' => 'btn btn-warning']) ?>
            <?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'btn btn-danger']) ?>
            <!-- <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'btn btn-success']) ?> -->
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings view content">
            <h3>Booking ID: <?= h($booking->id) ?></h3>
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
                    <td><?= $this->Number->format($booking->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Datetime') ?></th>
                    <td><?= h($booking->start_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Datetime') ?></th>
                    <td><?= h($booking->end_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Service Completed') ?></th>
                    <td><?= $booking->service_completed ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            </div>
            <div class="related">
                <h4><?= __('All Booking Lines') ?></h4>
                <?php if (!empty($booking->booking_lines)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <!--<th><?= __('Booking Id') ?></th>-->
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
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

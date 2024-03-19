<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Booking> $bookings
 */
?>
<div class="bookings index content">
    <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bookings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('booking_id') ?></th>
                    <th><?= $this->Paginator->sort('student_id') ?></th>
                    <th><?= $this->Paginator->sort('package_id') ?></th>
                    <th><?= $this->Paginator->sort('booking_datetime') ?></th>
                    <th><?= $this->Paginator->sort('is_paid') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $this->Number->format($booking->booking_id) ?></td>
                    <td><?= $booking->hasValue('student') ? $this->Html->link($booking->student->student_id, ['controller' => 'Students', 'action' => 'view', $booking->student->student_id]) : '' ?></td>
                    <td><?= $booking->hasValue('package') ? $this->Html->link($booking->package->package_id, ['controller' => 'Packages', 'action' => 'view', $booking->package->package_id]) : '' ?></td>
                    <td><?= h($booking->booking_datetime) ?></td>
                    <td><?= h($booking->is_paid) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $booking->booking_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->booking_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booking->booking_id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->booking_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

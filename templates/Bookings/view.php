<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->booking_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->booking_id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->booking_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bookings view content">
            <h3><?= h($booking->booking_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Student') ?></th>
                    <td><?= $booking->hasValue('student') ? $this->Html->link($booking->student->student_id, ['controller' => 'Students', 'action' => 'view', $booking->student->student_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Teacherlesson') ?></th>
                    <td><?= $booking->hasValue('teacherlesson') ? $this->Html->link($booking->teacherlesson->teacherlesson_id, ['controller' => 'Teacherlessons', 'action' => 'view', $booking->teacherlesson->teacherlesson_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Booking Id') ?></th>
                    <td><?= $this->Number->format($booking->booking_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Booking Datetime') ?></th>
                    <td><?= h($booking->booking_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Paid') ?></th>
                    <td><?= $booking->is_paid ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

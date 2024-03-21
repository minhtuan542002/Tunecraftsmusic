<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
$this->layout = 'dashboard';
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link(__('Back To All Bookings'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
            <?= $this->Form->postLink(
                __('Delete Booking'),
                ['action' => 'delete', $booking->booking_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $booking->booking_id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings form content">
            <?= $this->Form->create($booking) ?>
            <fieldset>
                <legend><?= __('Edit Booking') ?></legend>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Weekly date time:</th>
                            <td><?php
                                echo $this->Form->control('booking_datetime', [
                                    'label' => false,
                                ]);?>
                                Note that you reschedule all the lessons starting a week from now
                            </td>
                        </tr>
                        <tr>
                            <th>Note:</th>
                            <td><?php
                                echo $this->Form->control('note', [
                                    'label' => false,
                                    'rows' => '3',
                                    'type' => 'textarea',
                                    'class' => 'col-md-9',
                                    'required' => "required",
                                    'min' => date('Y-m-d', strtotime("+6 days")) . 'T07:00',
                                ]);?>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class'=>"btn btn-success"]) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

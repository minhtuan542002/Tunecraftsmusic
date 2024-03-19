<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link(__('Back To All Bookings'), ['action' => 'index'], ['class' => 'btn btn-info']) ?>
            <?= $this->Form->postLink(
                __('Delete Booking'),
                ['action' => 'delete', $booking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings form content">
            <?= $this->Form->create($booking) ?>
            <fieldset>
                <legend><?= __('Edit Booking') ?></legend>
                <?php
                    echo $this->Form->control('start_datetime');
                    echo $this->Form->control('end_datetime');
                    // echo $this->Form->control('customer_id', ['options' => $customers]);
                    echo $this->Form->control('service_completed');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class'=>"btn btn-success"]) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('') ?></h4>
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i>', ['action' => 'index'], ['escape' => false, 'title' => __('Back'), 'class' => 'side-nav-item']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i>', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'submit-link side-nav-item', 'id' => 'submit-form']) ?><?= $this->Form->end() ?>
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
                                    'required' => "required",
                                    'class'=>'form-control',
                                    'min' => date('Y-m-d', strtotime("+6 days")) . 'T07:00',
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
                                    'class' => 'col-md-9 form-control',
                                ]);?>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <aside class="user-actions">
                <div class="side-nav d-flex justify-content-between">
                    <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['controller'=>'bookings','action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
                    <?= $this->Form->button('Save', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
                </div>
            </aside>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


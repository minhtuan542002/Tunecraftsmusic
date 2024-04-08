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
        </div>
    </div>
</div>

<aside class="user-actions">
    <div class="side-nav">
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['controller'=>'bookings','action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
        <?= $this->Html->postLink('<i class="fas fa-save fa-fw"></i> Save', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'id' => 'submit-form']) ?>
        <?= $this->Form->end() ?>
    </div>
</aside>

<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>
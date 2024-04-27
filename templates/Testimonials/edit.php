<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Testimonial $testimonial
 */
$this->loadHelper('Form', [
    'templates' => 'app_form',
]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<div class="mt-3">
    <h3><?= __('Edit Testimonial') ?></h3>
    <div class="testimonial-details">
        <?= $this->Form->create($testimonial) ?>
        <h4><?= __('Testimonial ID: {0}', $testimonial->testimonial_id) ?></h4>
        <fieldset>
            <div class="mb-3">
                <?= $this->Form->control('testimonial_text', ['rows' => '3', 'type' => 'textarea']) ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('student_name') ?>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('testimonial_title') ?>
            </div>
            <div class="mb-3">
                <div class="form-group row">
                    <?= $this->Form->label('rating', 'Rating', ['class' => 'col-sm-2 col-form-label']) ?>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <?= $this->Form->select('rating', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], ['empty' => 'Choose Rating', 'class' => 'form-select']) ?>
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <?= $this->Form->control('image_url', ['label' => 'Image URL']) ?>
            </div>
        </fieldset>
        <div class="d-flex gap-3 mt-3">
            <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Testimonial $testimonial
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    .testimonial-details table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .testimonial-details th,
    .testimonial-details td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .note {
        margin-top: 20px;
        background-color: #f5f5f5;
        padding: 10px;
        border-left: 3px solid #3498db;
    }
</style>

<div class="mt-3">
    <h3><?= h("View Testimonial") ?></h3>
    <div class="testimonial-details">
        <table>
        <tr>
                <th><?= __('Student Name') ?></th>
                <td><?= h($testimonial->student_name) ?></td>
            </tr>
            <tr>
                <th><?= __('Testimonial Title') ?></th>
                <td><?= h($testimonial->testimonial_title) ?></td>
            </tr>
            <tr>
                <th><?= __('Rating') ?></th>
                <td><?= $testimonial->rating ?></td>
            </tr>
            <tr>
                <th><?= __('Image URL') ?></th>
                <td><?= h($testimonial->image_url) ?></td>
            </tr>
            <tr>
                <th><?= __('Testimonial ID') ?></th>
                <td><?= $this->Number->format($testimonial->testimonial_id) ?></td>
            </tr>
        </table>
        <div class="note">
            <strong><?= __('Testimonial Text') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($testimonial->testimonial_text)); ?>
            </blockquote>
        </div>
    </div>
</div>
<div class="d-flex gap-3 mt-3">
    <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
    <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $testimonial->testimonial_id], ['escape' => false, 'class' => 'btn btn-success']) ?>
    <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $testimonial->testimonial_id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $testimonial->testimonial_id)]) ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

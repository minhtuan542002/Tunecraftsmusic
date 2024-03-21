<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="content">
    <h3><?= __('Edit Package') ?></h3>
    <div class="package-details">
        <?= $this->Form->create($package) ?>
        <fieldset>
            <table>
                <tr>
                    <th><?= __('Package Name') ?></th>
                    <td><?= $this->Form->input('package_name') ?></td>
                </tr>
                <tr>
                    <th><?= __('Number of Lessons') ?></th>
                    <td><?= $this->Form->input('number_of_lessons') ?></td>
                </tr>
                <tr>
                    <th><?= __('Lesson Duration (Minutes)') ?></th>
                    <td><?= $this->Form->input('lesson_duration_minutes') ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost (Dollars)') ?></th>
                    <td><?= $this->Form->input('cost_dollars') ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $this->Form->input('description', ['rows' => 5]) ?></td>
                </tr>
            </table>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>

<aside class="package-actions">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i>', ['action' => 'index'], ['escape' => false, 'title' => __('Back'), 'class' => 'side-nav-item']) ?>
        <?= $this->Html->link('<i class="fas fa-save fa-fw"></i>', '#', ['escape' => false, 'title' => __('Save'), 'class' => 'submit-link side-nav-item', 'id' => 'submit-form']) ?>
    </div>
</aside>

<script>
document.getElementById('submit-form').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('form').submit();
});
</script>

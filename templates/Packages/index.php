<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<div class="packages index content">
    <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Packages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('package_id') ?></th>
                    <th><?= $this->Paginator->sort('package_name') ?></th>
                    <th><?= $this->Paginator->sort('number_of_lessons') ?></th>
                    <th><?= $this->Paginator->sort('lesson_duration_minutes') ?></th>
                    <th><?= $this->Paginator->sort('cost_dollars') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?= $this->Number->format($package->package_id) ?></td>
                    <td><?= h($package->package_name) ?></td>
                    <td><?= $package->number_of_lessons === null ? '' : $this->Number->format($package->number_of_lessons) ?></td>
                    <td><?= $package->lesson_duration_minutes === null ? '' : $this->Number->format($package->lesson_duration_minutes) ?></td>
                    <td><?= $package->cost_dollars === null ? '' : $this->Number->format($package->cost_dollars) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $package->package_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $package->package_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $package->package_id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->package_id)]) ?>
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

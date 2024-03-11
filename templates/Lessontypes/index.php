<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lessontype> $lessontypes
 */
?>
<div class="lessontypes index content">
    <?= $this->Html->link(__('New Lessontype'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lessontypes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('lesson_id') ?></th>
                    <th><?= $this->Paginator->sort('duration_minutes') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessontypes as $lessontype): ?>
                <tr>
                    <td><?= $this->Number->format($lessontype->lesson_id) ?></td>
                    <td><?= $lessontype->duration_minutes === null ? '' : $this->Number->format($lessontype->duration_minutes) ?></td>
                    <td><?= $lessontype->cost === null ? '' : $this->Number->format($lessontype->cost) ?></td>
                    <td><?= h($lessontype->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lessontype->lesson_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lessontype->lesson_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lessontype->lesson_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessontype->lesson_id)]) ?>
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

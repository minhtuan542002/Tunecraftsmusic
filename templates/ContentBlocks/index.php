<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ContentBlock> $contentBlocks
 */
?>
<div class="contentBlocks index content">
    <?= $this->Html->link('Content Blocks', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index']) ?>
    <?= $this->Html->link(__('New Content Block'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Content Blocks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('contentblock_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contentBlocks as $contentBlock): ?>
                <tr>
                    <td><?= $this->Number->format($contentBlock->contentblock_id) ?></td>
                    <td><?= h($contentBlock->title) ?></td>
                    <td><?= h($contentBlock->published) ?></td>
                    <td><?= h($contentBlock->created) ?></td>
                    <td><?= h($contentBlock->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contentBlock->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentBlock->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]) ?>
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

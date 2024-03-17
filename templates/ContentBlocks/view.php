<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContentBlock $contentBlock
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Content Block'), ['action' => 'edit', $contentBlock->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Content Block'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Content Blocks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Content Block'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="contentBlocks view content">
            <h3><?= h($contentBlock->label) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($contentBlock->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contentblock Id') ?></th>
                    <td><?= $this->Number->format($contentBlock->contentblock_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($contentBlock->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($contentBlock->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $contentBlock->published ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contentBlock->body)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>

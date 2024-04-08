<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\ContentBlocks\Model\Entity\ContentBlock> $contentBlocksGrouped
 */

$this->assign('title', 'Content Blocks');

$this->Html->css('ContentBlocks.content-blocks', ['block' => true]);

$slugify = function($text) {
    return preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
}

?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<div class="contentBlocks index content">

    <?php
    /*
    // TODO: Think of a way to allow this for developers, but not for the actual website. Adding a content block doesn't
    //       mean anything for end users - it needs to be hard coded into a template somewhere to make sense. Perhaps
    //       it can just be guarded behind a DEBUG flag with an appropriate confirm() dialog warning that it needs to
    //       be used in a template after being added...
    echo $this->Html->link(__('New Content Block'), ['action' => 'add'], ['class' => 'button button-outline float-right'])
    */
    ?>

    <h3><?= __('Content Blocks') ?></h3>

    <div>
        Quick links
        <?php foreach(array_keys($contentBlocksGrouped) as $parent) { ?>
            :: <a href="#<?= $slugify($parent) ?>"><?= $parent ?></a>
        <?php } ?>
    </div>

    <?php foreach($contentBlocksGrouped as $parent => $contentBlocks) { ?>

        <h4 class="content-blocks--list-subheading">
            <a href="#<?= $slugify($parent)?>" id="<?= $slugify($parent)?>">
                <?= $parent ?>
            </a>
        </h4>

        <ul class="content-blocks--list-group">
            <?php foreach($contentBlocks as $contentBlock) { ?>
                <li class="content-blocks--list-group-item">
                    <div class="content-blocks--text">
                        <div class="content-blocks--display-name">
                            <?= $contentBlock['label'] ?>
                        </div>
                        <div class="content-blocks--description">
                            <?= $contentBlock['description'] ?>
                        </div>
                    </div>
                    <div class="content-blocks--actions">
                        <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $contentBlock->id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
                        <?php if (!empty($contentBlock->previous_value)) echo " :: " . $this->Form->postlink('<i class="fas fa-history fa-fw"></i> Restore', ['action' => 'restore', $contentBlock->id], ['escape' => false, 'title' => __('Restore'), 'class' => 'btn btn-warning btn-sm', 'confirm' => __("Are you sure you want to restore the previous version for this item?\n{0}/{1}\nNote: You cannot cancel this action!", $contentBlock->parent, $contentBlock->slug)]) ?>
                    </div>
                </li>
            <?php } ?>
        </ul>

    <?php } ?>

</div>

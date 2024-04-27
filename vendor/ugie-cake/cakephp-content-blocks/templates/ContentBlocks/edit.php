<?php
/**
 * @var \App\View\AppView $this
 * @var \ContentBlocks\Model\Entity\ContentBlock $contentBlock
 */

$this->assign('title', 'Edit Content Block - Content Blocks');

$this->Html->script('ContentBlocks.ckeditor/ckeditor', ['block' => true]);

$this->Html->css('ContentBlocks.content-blocks', ['block' => true]);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<div class="row">
    <div class="column-responsive">

        <div class="contentBlocks form content mt-3">

            <h3 class="content-blocks--form-heading"><?= $contentBlock->label ?></h3>

            <div class="content-blocks--form-description">
                <?= $contentBlock->description ?>
            </div>

            <?= $this->Form->create($contentBlock, ['type' => 'file']) ?>

            <?php
            if ($contentBlock->type === 'text') {
                echo $this->Form->control('value', [
                    'type' => 'textarea',
                    'value' => html_entity_decode($contentBlock->value),
                    'label' => false,
                    'style' => 'width: 80%; resize: both;'
                ]);
            } else if ($contentBlock->type === 'html') {
                echo $this->Form->control('value', [
                    'type' => 'textarea',
                    'label' => false,
                    'id' => 'content-value-input',
                    'style' => 'width: 80%; resize: both;'
                ]);

                ?>
                <!-- Load CKEditor. -->
                <script>
                    /*
                    Create our CKEditor instance in a DOMContentLoaded event callback, to ensure
                    the library is available when we call `create()`.
                    Fixes https://github.com/ugie-cake/cakephp-content-blocks/issues/4.
                    */
                    document.addEventListener("DOMContentLoaded", (event) => {
                        CKSource.Editor.create(
                            document.getElementById('content-value-input'),
                            {
                                toolbar: [
                                    "heading", "|",
                                    "bold", "italic", "underline", "|",
                                    "bulletedList", "numberedList", "|",
                                    "alignment", "blockQuote", "|",
                                    "indent", "outdent", "|",
                                    "link", "|",
                                    "insertTable", "imageInsert", "mediaEmbed", "horizontalLine", "|",
                                    "removeFormat", "|",
                                    "sourceEditing", "|",
                                    "undo", "redo",
                                ],
                                simpleUpload: {
                                    uploadUrl: <?= json_encode($this->Url->build(['action' => 'upload'])) ?>,
                                    headers: {
                                    'X-CSRF-TOKEN': <?= json_encode($this->request->getAttribute('csrfToken')) ?>,
                                    }
                                }
                            }
                        ).then(editor => {
                        console.log(Array.from( editor.ui.componentFactory.names() ));
                        });
                    });
                </script>
                <?php
            } else if ($contentBlock->type === 'image') {

                if ($contentBlock->value) {
                    echo $this->Html->image($contentBlock->value, ['class' => 'content-blocks--image-preview']);
                }

                echo $this->Form->control('value', [
                    'type' => 'file',
                    'accept' => 'image/*',
                    'label' => false,
                ]);
            }

            ?>

            <div class="d-flex gap-3 mt-3">
                <?= $this->Html->link('<i class="fas fa-chevron-left fa-fw"></i> Back', ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-primary']) ?>
                <?= $this->Form->button('<i class="fas fa-save fa-fw"></i> Save', ['escape' => false, 'escapeTitle' => false, 'title' => __('Save'), 'class' => 'btn btn-success', 'type' => 'submit']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

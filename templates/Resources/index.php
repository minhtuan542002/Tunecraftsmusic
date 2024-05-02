<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="card shadow mt-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold text-primary">Manage <em>Learning Resources</em></h2>
            <?= $this->Html->link('<i class="fas fa-plus fa-fw"></i> Add Resource', ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-warning']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Heading</th>
                        <th>Description</th>
                        <th>Resource</th>
                        <th>ID</th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resources as $resource): ?>
                        <tr>
                            <td><?= h($resource->heading) ?></td>
                            <td><?= h($resource->description) ?></td>
                            <td><?= h($resource->resource) ?></td>as
                            <td><?= h($resource->resource_id) ?></td>
                            <td class="d-flex gap-2">
                                <?= $this->Html->link('<i class="fas fa-eye fa-fw" aria-hidden="true"></i> View', ['action' => 'view', $resource->id], ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link('<i class="fas fa-edit fa-fw" aria-hidden="true"></i> Edit', ['action' => 'edit', $resource->id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $resource->id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'class' => 'btn btn-danger btn-sm']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "search": '<i class="fas fa-search" aria-hidden="true"></i>',
                "searchPlaceholder": "Search...",
            },
            "columnDefs": [
                { "targets": 4, "sortable": false, "searchable": false }
            ],
            "dom": '<"row align-items-center mb-3"<"col-md-6"l><"col-md-6"f>>' +
                   '<"table-responsive"t>' +
                   '<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>',
        });
    });
</script>

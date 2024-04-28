<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="card shadow mt-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold text-primary">Manage <em>Packages</em></h2>
            <?= $this->Html->link('<i class="fas fa-plus fa-fw"></i> Add Package', ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-warning']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Number of Lessons</th>
                        <th>Lesson Duration (Minutes)</th>
                        <th>Total Cost (AUD)</th>
                        <th>Package ID</th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $package): ?>
                        <tr>
                            <td><?= h($package->package_name) ?></td>
                            <td><?= $package->number_of_lessons === null ? '' : $this->Number->format($package->number_of_lessons) ?></td>
                            <td><?= $package->lesson_duration_minutes === null ? '' : $this->Number->format($package->lesson_duration_minutes) ?></td>
                            <td><?= $package->cost_dollars === null ? '' : '$'. $this->Number->format($package->cost_dollars) ?></td>
                            <td><?= $this->Number->format($package->package_id) ?></td>
                            <td class="d-flex gap-2">
                                <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i> View', ['action' => 'view', $package->package_id], ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i> Edit', ['action' => 'edit', $package->package_id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $package->package_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $package->package_id), 'class' => 'btn btn-danger btn-sm']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthMenu": [10, 25, 50, 100], // Show entries options
            "language": {
                "lengthMenu": "Show _MENU_ entries", // Customize show entries label
                "search": '<i class="fas fa-search"></i>', // Custom search icon
                "searchPlaceholder": "Search...", // Placeholder text for search input
            },
            "columnDefs": [
                { "targets": 5, "sortable": false, "searchable": false } // Disable sorting and searching for the Actions column (0-based index)
            ],
            "dom": '<"row align-items-center mb-3"<"col-md-6"l><"col-md-6"f>>' +
                   '<"table-responsive"t>' +
                   '<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>', // Adjust the DOM layout for search and show entries on the same row
        });
    });
</script>

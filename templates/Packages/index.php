<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<style>
    .content {
        margin: 20px;
    }

    .side-nav {
        padding-left: 10px;
    }

    .side-nav h4.heading {
        margin-top: 0;
        color: #3498db;
    }

    .btn {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .btn i {
        margin-right: 5px;
    }
</style>
<div class="packages index content">
    <div class="d-flex gap-5">
        <h3><?= __('Packages') ?> </h3>
        <?= $this->Html->link('<i class="fas fa-plus fa-fw"></i> Add Package', ['action' => 'add'], 
            ['escape' => false, 'class' => 'btn btn-info']) ?> 
    </div>
    <div class="table-responsive user-table-container">
        <table class="table dataTable" id="dataTable">
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Number of Lessons</th>
                    <th>Lesson Duration (Minutes)</th>
                    <th>Total Cost (AUD)</th>
                    <th>Package ID</th>
                    <th class="actions"><?= __('Actions') ?></th>
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
                        <td class="actions">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "columnDefs": [
                {
                    "targets": [5],
                    "orderable": false
                }
            ],
            "language": {
                "emptyTable": "No data available in table",
                "search": '<i class="fas fa-search"></i>',
                "searchPlaceholder": "Search...",
            },
            "dom": '<"top"lf>rt<"bottom"ip><"clear">'
        });
    });
</script>

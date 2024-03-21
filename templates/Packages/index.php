<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Package> $packages
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="packages index content">
    <h3><?= __('Packages') ?></h3>
    <div class="table-responsive user-table-container">
        <table class="table dataTable" id="dataTable">
            <thead>
                <tr>
                    <th>Package ID</th>
                    <th>Package Name</th>
                    <th>Number of Lessons</th>
                    <th>Lesson Duration (Minutes)</th>
                    <th>Cost (Dollars)</th>
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
                            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i>', ['action' => 'view', $package->package_id], ['escape' => false, 'title' => __('View')]) ?>
                            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $package->package_id], ['escape' => false, 'title' => __('Edit')]) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $package->package_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $package->package_id)]) ?>
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

<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
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

<div class="users index content">
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive user-table-container">
        <table class="table dataTable" id="dataTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role ID</th>
                    <th>User ID</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= h($user->first_name) ?></td>
                        <td><?= h($user->last_name) ?></td>
                        <td><?= h($user->role->role_name) ?></td>
                        <td><?= $this->Number->format($user->user_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fas fa-eye fa-fw" aria-hidden="true"></i> View', ['action' => 'view', $user->user_id], ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-primary btn-sm']) ?>
                            <?= $this->Html->link('<i class="fas fa-edit fa-fw" aria-hidden="true"></i> Edit', ['action' => 'edit', $user->user_id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
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
                    "targets": [3], // User ID as the fourth column (0-based index)
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [4],
                    "orderable": false
                }
            ],
            "language": {
                "emptyTable": "No data available in table",
                "search": '<i class="fas fa-search" aria-hidden="true"></i>',
                "searchPlaceholder": "Search...",
            },
            "dom": '<"top"lf>rt<"bottom"ip><"clear">'
        });
    });
</script>

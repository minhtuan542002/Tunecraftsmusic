<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php
    /**
     * @var \App\View\AppView $this
     * @var iterable<\App\Model\Entity\User> $users
     */
    ?>
    <div class="card shadow mt-4 mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role ID</th>
                            <th>User ID</th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= h($user->first_name) ?></td>
                                <td><?= h($user->last_name) ?></td>
                                <td><?= h($user->role->role_name) ?></td>
                                <td><?= $this->Number->format($user->user_id) ?></td>
                                <td class="d-flex gap-2">
                                    <?= $this->Html->link('<i class="fas fa-eye fa-fw" aria-hidden="true"></i> View', ['action' => 'view', $user->user_id], ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-primary btn-sm']) ?>
                                    <?= $this->Html->link('<i class="fas fa-edit fa-fw" aria-hidden="true"></i> Edit', ['action' => 'edit', $user->user_id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
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
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
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
</body>
</html>

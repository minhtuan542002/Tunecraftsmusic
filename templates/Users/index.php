<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php
    /**
     * @var \App\View\AppView $this
     * @var iterable<\App\Model\Entity\User> $users
     */
    ?>
    <div class="card shadow mt-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Manage <em>Users</em></h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable">
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
                    "search": '<i class="fas fa-search" aria-hidden="true"></i>', // Custom search icon
                    "searchPlaceholder": "Search...", // Placeholder text for search input
                },
                "columnDefs": [
                    { "targets": 4, "sortable": false, "searchable": false } // Disable sorting and searching for the Actions column (0-based index)
                ],
                "dom": '<"row align-items-center mb-3"<"col-md-6"l><"col-md-6"f>>' +
                       '<"table-responsive"t>' +
                       '<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>', // Adjust the DOM layout for search and show entries on the same row
            });
        });
    </script>
</body>
</html>

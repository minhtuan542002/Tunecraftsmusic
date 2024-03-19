<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
<div class="users index content">
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive user-table-container">
        <table class="table dataTable" id="dataTable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role ID</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $this->Number->format($user->user_id) ?></td>
                        <td><?= h($user->first_name) ?></td>
                        <td><?= h($user->last_name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->phone) ?></td>
                        <td><?= h($user->role->role_name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fas fa-eye fa-fw"></i>', ['action' => 'view', $user->user_id], ['escape' => false, 'title' => __('View')]) ?>
                            <?= $this->Html->link('<i class="fas fa-edit fa-fw"></i>', ['action' => 'edit', $user->user_id], ['escape' => false, 'title' => __('Edit')]) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i>', ['action' => 'delete', $user->id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $user->first_name)]) ?>
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
                    "targets": [6],
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

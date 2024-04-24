<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Testimonial> $testimonials
 */
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="card shadow mt-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Manage <em>Testimonials</em></h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Testimonial Title</th>
                        <th>Rating</th>
                        <th>ID</th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $testimonial): ?>
                        <tr>
                            <td><?= h($testimonial->student_name) ?></td>
                            <td><?= h($testimonial->testimonial_title) ?></td>
                            <td>
                                <div class="stars">
                                    <?php for ($i = 0; $i < $testimonial->rating; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                            </td>
                            <td><?= h($testimonial->testimonial_id) ?></td>
                            <td class="d-flex gap-2">
                                <?= $this->Html->link('<i class="fas fa-eye fa-fw" aria-hidden="true"></i> View', ['action' => 'view', $testimonial->testimonial_id], ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link('<i class="fas fa-edit fa-fw" aria-hidden="true"></i> Edit', ['action' => 'edit', $testimonial->testimonial_id], ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Form->postLink('<i class="fas fa-trash fa-fw"></i> Delete', ['action' => 'delete', $testimonial->testimonial_id], ['escape' => false, 'title' => __('Delete'), 'confirm' => __('Are you sure you want to delete # {0}?', $testimonial->testimonial_id), 'class' => 'btn btn-danger btn-sm']) ?>
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

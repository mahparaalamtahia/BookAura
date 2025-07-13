<?php
require_once('functions/function.php');
needtologin();
admin();
get_header();
get_sidebar();

// SQL query including the photo column
$select = "SELECT b.id, b.name, b.author, c.name AS category_name, b.quantity, b.slug, b.photo 
           FROM books b
           LEFT JOIN category c ON b.category = c.id
           ORDER BY b.id DESC";
$Query = mysqli_query($con, $select);

// SweetAlert messages for status
$alerts = [
  '1' => ["Book added successfully!", "success"],
  '2' => ["Book information updated successfully!", "success"],
  '3' => ["Book deleted successfully!", "success"],
  '4' => ["Book blocked successfully!", "success"],
  '5' => ["Book unblocked successfully!", "success"]
];

if (isset($_SESSION['success_alert']) && array_key_exists($_SESSION['success_alert'], $alerts)) {
  [$message, $icon] = $alerts[$_SESSION['success_alert']];
  echo "<script>
          swal({title: 'Done!', text: '$message', icon: '$icon', button: 'OK'});
        </script>";
  $_SESSION['success_alert'] = '0';
}
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="row">
              <div class="col-md-10 card_header_text">
                <b>All Books</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <a href="add-book.php" class="btn btn-sm btn-danger">Add Book</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Image</th>       <!-- New column for image -->
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if ($Query && mysqli_num_rows($Query) > 0) {
                    while ($data = mysqli_fetch_assoc($Query)) {
                      // Build image path, fallback if no image
                      $imagePath = !empty($data['photo']) 
                                   ? "uploads/books/" . htmlspecialchars($data['photo']) 
                                   : "uploads/books/default.png"; // fallback image
                  ?>
                    <tr>
                      <td>
                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($data['name']) ?>" style="width:50px; height:auto; border-radius:4px;">
                      </td>
                      <td><?= htmlspecialchars($data['name']); ?></td>
                      <td><?= htmlspecialchars($data['author']); ?></td>
                      <td><?= htmlspecialchars($data['category_name'] ?? 'Uncategorized'); ?></td>
                      <td><?= htmlspecialchars($data['quantity']); ?></td>
                      <td>
                        <a href="edit-book.php?e=<?= $data['slug']; ?>"><i class="fas fa-edit"></i></a>
                        <a href="delete-book.php?d=<?= $data['slug']; ?>"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php 
                    }
                  } else {
                    echo '<tr><td colspan="6" class="text-center">No books found or query failed.</td></tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-muted"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>

<script>
  $(document).ready(function(){
    $('#dataTable').DataTable();
  });
</script>

<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  $select = 'SELECT * FROM category ORDER BY id DESC';
  $Query = mysqli_query($con, $select);

  if ($_SESSION['success_alert'] == '1') {
?>
  <script>
    swal({title: "Done!", text: "Category added successfully!", icon: "success", button: "OK",});
  </script>
<?php
    $_SESSION['success_alert'] = '0';
  } elseif ($_SESSION['success_alert'] == '2') {
?>
  <script>
    swal({title: "Done!", text: "Category updated successfully!", icon: "success", button: "OK",});
  </script>
<?php
    $_SESSION['success_alert'] = '0';
  } elseif ($_SESSION['success_alert'] == '3') {
?>
  <script>
    swal({title: "Done!", text: "Category deleted successfully!", icon: "success", button: "OK",});
  </script>
<?php
    $_SESSION['success_alert'] = '0';
  }
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="row">
              <div class="col-md-10 card_header_text">
                <b>All Categories</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <!-- Optional: Add a button to add new category -->
                <a href="add-category.php" class="btn btn-sm btn-success float-end">Add Category</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($Query as $data) { ?>
                    <tr>
                      <td><?= $data['name']; ?></td>
                      <td>
                        <a href="edit-category.php?e=<?= $data['slug']; ?>"><i class="fas fa-edit"></i></a>
                        <a href="delete-category.php?d=<?= $data['slug']; ?>"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-muted">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
  get_footer();
?>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>

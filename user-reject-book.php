<?php
require_once('functions/function.php');
needtologin();
get_header();
get_sidebar();
user();

$id = $_SESSION['id'];

// Query to fetch all rejected book requests by this user
$select = "
    SELECT services.*, books.name AS book_name
    FROM services 
    INNER JOIN books ON services.book_id = books.id
    WHERE services.service_request_pending_status = '3' AND services.user_id = '$id'
    ORDER BY services.service_id DESC
";

$Query = mysqli_query($con, $select);

$selectEmp = "SELECT * FROM user WHERE id='$id'";
$Q_emp = mysqli_query($con, $selectEmp);
$data_emp = mysqli_fetch_assoc($Q_emp);

if ($_SESSION['success_alert'] == '6') {  // Adjust alert code as needed
?>
  <script>
    swal({
      title: "Done!",
      text: "Book rejection acknowledged!",
      icon: "success",
      button: "OK",
    });
  </script>
<?php
  $_SESSION['success_alert'] = '0';
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-light">
            <b>My Rejected Book Requests</b>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Book Name</th>
                    <th>Service Details</th>
                    <th>Sending Date</th>
                    
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if ($Query && mysqli_num_rows($Query) > 0) {
                    foreach ($Query as $data) { 
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($data['book_name']); ?></td>
                      <td><?= htmlspecialchars($data['service_details']); ?></td>
                      <td><?= htmlspecialchars($data['service_request_sending_date']); ?></td>
                      <td><span class="badge bg-danger text-white">Rejected</span></td>
                    </tr>
                  <?php 
                    } 
                  } else { 
                  ?>
                    <tr>
                      <td colspan="5" class="text-center">No rejected book requests found.</td>
                    </tr>
                  <?php } ?>
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
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>

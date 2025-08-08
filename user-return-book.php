<?php
require_once('functions/function.php');
needtologin();
get_header();
get_sidebar();
user(); // Changed from admin() to user() to restrict to logged-in user

$id = $_SESSION['id'];

// Query to fetch all returned book requests by this user
$select = "
    SELECT services.*, books.name AS book_name
    FROM services 
    INNER JOIN books ON services.book_id = books.id
    WHERE services.service_request_pending_status = '2' AND services.user_id = '$id'
    ORDER BY services.service_id DESC
";

$Query = mysqli_query($con, $select);

$selectEmp = "SELECT * FROM user WHERE id='$id'";
$Q_emp = mysqli_query($con, $selectEmp);
$data_emp = mysqli_fetch_assoc($Q_emp);

if ($_SESSION['success_alert'] == '5') {
?>
  <script>
    swal({
      title: "Done!",
      text: "Book returned successfully!",
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
            <b>My Returned Book History</b>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Book Name</th>
                    <th>Service Details</th>
                    <th>Sending Date</th>
                    <th>Assigned Return Date</th>
                    <th>Assigned Return Time</th>
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
                      <td><?= !empty($data['return_date']) ? htmlspecialchars($data['return_date']) : '-'; ?></td>
                      <td>
                        <?php 
                          if (!empty($data['return_time'])) {
                            $date = strtotime($data['return_time']);
                            echo date('g:i A', $date);
                          } else {
                            echo '-';
                          }
                        ?>
                      </td>
                      <td><span class="badge bg-warning text-dark">Returned</span></td>
                    </tr>
                  <?php 
                    } 
                  } else { 
                  ?>
                    <tr>
                      <td colspan="6" class="text-center">No returned books found.</td>
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

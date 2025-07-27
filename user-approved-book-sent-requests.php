<?php
require_once('functions/function.php');
needtologin();
get_header();
get_sidebar();
user();

$id = $_SESSION['id'];

$select = "
  SELECT services.*, books.name AS book_name 
  FROM services 
  INNER JOIN books ON services.book_id = books.id
  WHERE service_request_pending_status = '0' AND user_id = '$id' 
  ORDER BY service_id DESC
";
$Query = mysqli_query($con, $select);

$selectUser = "SELECT * FROM user WHERE id = '$id'";
$Q_emp = mysqli_query($con, $selectUser);
$data_emp = mysqli_fetch_assoc($Q_emp);

if ($_SESSION['success_alert'] == '1') {
  ?>
  <script>
    swal({title: "Done!", text: "Book request approved successfully!", icon: "success", button: "OK"});
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
                <b>All Approved Book Requests Sent By You</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <!-- Optional button area -->
              </div>
            </div>
          </div>

          <div class="card-body">

            <table class="table table-striped table-bordered" id="dataTable">
              <thead>
                <tr>
                  <th>Book Name</th>
                  <th>Service Details</th>
                  <th>Sending Date</th>
                  <th>Assigned Return Date</th>
                  <th>Assigned Return Time</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($Query as $data): ?>
                  <tr>
                    <td><?= htmlspecialchars($data['book_name']); ?></td>
                    <td><?= htmlspecialchars($data['service_details']); ?></td>
                    <td><?= htmlspecialchars($data['service_request_sending_date']); ?></td>
                    <td><?php if ($data['return_date'] != '') {
                        $r_date = htmlspecialchars($data['return_date']);
                        echo $r_date;
                      } ?>
                    </td>
                    <td>
                      <?php if ($data['return_time'] != '') {
                        $date = strtotime($data['return_time']);
                        echo date('g:i A', $date);
                      } ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

            </table>

          </div>

          <div class="card-footer text-muted"></div>
        </div>

      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php get_footer(); ?>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>

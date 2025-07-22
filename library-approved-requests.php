<?php
require_once('functions/function.php');
needtologin();
get_header();
get_sidebar();
admin();

$id = $_SESSION['id'];

// Updated query to join books and category properly
$select = "
    SELECT services.*, user.name AS username, user.photo, 
           books.name AS book_name
    FROM services 
    INNER JOIN user ON services.user_id = user.id 
    INNER JOIN books ON services.book_id = books.id
    WHERE services.service_request_pending_status = '0' 
    ORDER BY services.service_id DESC
  ";

$Query = mysqli_query($con, $select);

$selectEmp = "SELECT * FROM user WHERE id='$id'";
$Q_emp = mysqli_query($con, $selectEmp);
$data_emp = mysqli_fetch_assoc($Q_emp);

if ($_SESSION['success_alert'] == '1') {
?>
  <script>
    swal({
      title: "Done!",
      text: "Request accepted successfully!",
      icon: "success",
      button: "OK",
    });
  </script>
<?php
  $_SESSION['success_alert'] = '0';
}
?>
<?php
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
            <div class="row">
              <div class="col-md-10 card_header_text">
                <b>All Approved Book Requests</b>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Book Name</th>
                    <th>Service Details</th>
                    <th>Sender</th>
                    <th>Photo</th>
                    <th>Sending Date</th>
                    <th>Assigned Return Date</th>
                    <th>Assigned Return Time</th>
                    <th>Assign Return Date & Time</th>
                    <th>Return Book</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($Query as $data) { ?>
                    <tr>
                      <td><?= $data['book_name']; ?></td>
                      <td><?= $data['service_details']; ?></td>
                      <td><?= $data['username']; ?></td>
                      <td>
                        <img src="<?= $data['photo'] ? 'uploads/'.$data['photo'] : 'assets/img/avatar.jpg'; ?>" height="40" width="40">
                      </td>
                      <td><?= $data['service_request_sending_date']; ?></td>
                      
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
                      <td>
                        <?php if ($data['service_request_pending_status'] != '2') {
                        ?>
                        <a href="edit-return-date.php?e=<?= $data['service_slug']; ?>" class="btn btn-info">Assign</a>
                        <?php 
                        } 
                        ?>
                      </td>
                      <td>
                        <?php if ($data['service_request_pending_status'] != '2') {
                        ?>
                        <a href="retun-book.php?s=<?= $data['service_slug']; ?>" class="btn btn-danger btn-sm">Return Book</a>
                        <?php 
                        } 
                        ?>
                      </td>
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

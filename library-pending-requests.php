<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  $select = "
    SELECT services.*, user.name AS username, user.photo, 
           books.name AS book_name
    FROM services 
    INNER JOIN user ON services.user_id = user.id 
    INNER JOIN books ON services.book_id = books.id
    WHERE services.service_request_pending_status = '1' 
    ORDER BY services.service_id DESC
  ";
  $Query = mysqli_query($con, $select);

  if ($_SESSION['success_alert'] == '5') {
    ?>
    <script>
      swal({title: "Oops!", text: "Request accept process failed!", icon: "error", button: "OK"});
    </script>
    <?php
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
                <b>All Pending Book Requests</b>
              </div>
              <div class="col-md-2 card_header_for_one_button"></div>
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
                    <th>Status</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($Query as $data): ?>
                    <tr>
                      <td><?= $data['book_name']; ?></td>
                      <td><?= $data['service_details']; ?></td>
                      <td><?= $data['username']; ?></td>
                      <td>
                        <img src="<?= $data['photo'] ? 'uploads/'.$data['photo'] : 'assets/img/avatar.jpg'; ?>" height="40" width="40">
                      </td>
                      <td><?= $data['service_request_sending_date']; ?></td>
                      <td><span class="badge bg-warning text-dark">Pending</span></td>
                      <td>
                        <a href="accept-service-request.php?s=<?= $data['service_slug']; ?>" class="btn btn-success btn-sm">Accept</a>
                        <a href="reject-service-request.php?s=<?= $data['service_slug']; ?>" class="btn btn-danger btn-sm">Reject</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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

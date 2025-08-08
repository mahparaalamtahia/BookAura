<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  $id=$_GET['e'];
  $select="SELECT * FROM services WHERE service_slug='$id'";

  $Query=mysqli_query($con,$select);
  $data=mysqli_fetch_assoc($Query);
    
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
  
              <b>Assign Return Date & Time</b>
  
            </div>
              <div class="col-md-2 card_header_for_one_button">
                
              </div>
            </div>
          </div>

          <form method="post" action="submit-edit-return-date.php" enctype="multipart/form-data">
            
          <input type="hidden" class="form-control" id="" name="slug" value="<?= $id ?>" required>
          <div class="card-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Return Date <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="" name="return_date" value="<?=$data['return_date']?>" required>
                </div>
                <div class="col-sm-1"></div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Return Time <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  
                  <input type="time" class="form-control" id="" name="return_time" value="<?=$data['return_time']?>" required>
                </div>
                <div class="col-sm-1"></div>
              </div>
          </div>
          
          <div class="card-footer text-muted text-center">
            <button type="submit" class="btn btn-danger">Assign Return Date & Time</button>
          </div>
          </form>
        </div>
      </div>        
      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
  
<?php
  get_footer();
?>


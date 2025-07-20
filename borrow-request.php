<?php
  require_once('functions/function.php');
  needtologin();
  user();
  get_header();
  get_sidebar();
  

  $id=$_GET['id'];
  $selEmp='SELECT * FROM user where role_id="2"';
  $employees=mysqli_query($con,$selEmp);
  
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

                <b>Borrow Request</b>

              </div>
              
              <div class="col-md-2 card_header_for_one_button">
                
              
              </div>
            </div>
          
          </div>

          
          <form method="post" action="submit-borrow-request.php">
          
          
          <input type="hidden" class="form-control" id="" name="book_id" value="<?= $id ?>" required>  
          
          <div class="card-body">
              <div class="form-group row">
                
                <label for="" class="col-sm-3 col-form-label">Request Details <span class="text-danger">*</span></label>
                <div class="col-sm-8">

                  <input type="text" class="form-control" id="" name="service_details" required>
              
                </div>
                <div class="col-sm-1"></div>

              </div>
          
            
          </div>
          
          <div class="card-footer text-muted text-center">
            <button type="submit" class="btn btn-danger">Send Request</button>
  
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



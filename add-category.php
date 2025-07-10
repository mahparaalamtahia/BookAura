<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  if($_SESSION['success_alert']=='8'){
  ?>
    <script>
      swal({title: "Oops!", text: "Category addition failed! Please try again.", icon: "error", button: "OK",});
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
                <b>Add Category</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <!-- Optional button placeholder -->
              </div>
            </div>
          </div>
          
          <form method="post" action="submit-add-category.php" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Category Name <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="category_name" required>
                </div>
                <div class="col-sm-1"></div>
              </div>
            </div>
            
            <div class="card-footer text-muted text-center">
              <button type="submit" class="btn btn-danger">Add Category</button>
            </div>
          </form>
        </div>
      </div>        
    </div>
  </div>
</section>
<!-- /.content-wrapper -->

<?php
  get_footer();
?>

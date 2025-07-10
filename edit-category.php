<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  $id = $_GET['e'];
  $select = "SELECT * FROM category WHERE slug='$id'";
  $Query = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($Query);
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
                <b>Update Category</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <!-- optional button space -->
              </div>
            </div>
          </div>

          <form method="post" action="submit-edit-category.php">
            <input type="hidden" name="slug" value="<?= $id ?>" required>
            <div class="card-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Category Name <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="name" value="<?= $data['name'] ?>" required>
                </div>
                <div class="col-sm-1"></div>
              </div>
            </div>

            <div class="card-footer text-muted text-center">
              <button type="submit" class="btn btn-danger">Update</button>
            </div>
          </form>
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

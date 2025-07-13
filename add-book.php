<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  // Fetch categories from category table
  $cat_query = "SELECT * FROM category ORDER BY name ASC";
  $cat_result = mysqli_query($con, $cat_query);

  if($_SESSION['success_alert']=='8'){
?>
    <script>
      swal({
        title: "Oops!",
        text: "Book registration failed! Please check your input.",
        icon: "error",
        button: "OK",
      });
    </script>
<?php
    $_SESSION['success_alert']='0';
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
                <b>Add Book</b>
              </div>
              <div class="col-md-2 card_header_for_one_button">
                <!-- Optional button -->
              </div>
            </div>
          </div>
          
          <form method="post" action="submit-add-book.php" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Book Name <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="name" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Author <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="author" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <select class="form-control" name="category" required>
                    <option value="">Select Category</option>
                    <?php
                      while($cat = mysqli_fetch_assoc($cat_result)){
                        echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Quantity <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="quantity" required>
                </div>
              </div>

              <!-- Book Image Upload -->
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Book Image <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="file" onchange="readURL(this);" class="form-control" name="photo" required>
                  <br>
                  <img id="image_preview" src="#" alt="" style="max-height: 150px;" />
                </div>
              </div>

            </div>

            <div class="card-footer text-muted text-center">
              <button type="submit" class="btn btn-danger">Add Book</button>
            </div>
          </form>
        </div>
      </div>        
    </div>
  </div>
</section>

<!-- Image preview JS -->
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('image_preview').src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php
  get_footer();
?>

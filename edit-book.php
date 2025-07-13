<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();
  admin();

  $slug = $_GET['e'];

  // Fetch the book by slug
  $book_query = "SELECT * FROM books WHERE slug='$slug'";
  $book_result = mysqli_query($con, $book_query);
  $book = mysqli_fetch_assoc($book_result);

  // Fetch categories
  $cat_query = "SELECT id, name FROM category ORDER BY name ASC";
  $categories = mysqli_query($con, $cat_query);
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
                <b>Update Book Information</b>
              </div>
              <div class="col-md-2 card_header_for_one_button"></div>
            </div>
          </div>

          <!-- Note enctype for file upload -->
          <form method="post" action="submit-edit-book.php" enctype="multipart/form-data">
            <input type="hidden" name="slug" value="<?= htmlspecialchars($book['slug']) ?>">

            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Book Name <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($book['name']) ?>" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Author <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <select class="form-control" name="category" required>
                    <option value="">Select Category</option>
                    <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                      <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $book['category']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['name']); ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Quantity <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="quantity" value="<?= htmlspecialchars($book['quantity']) ?>" required>
                </div>
              </div>

              <!-- Image preview -->
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Current Image</label>
                <div class="col-sm-8">
                  <?php
                    $imagePath = !empty($book['photo']) ? "uploads/books/" . htmlspecialchars($book['photo']) : "uploads/books/default.png";
                  ?>
                  <img src="<?= $imagePath ?>" alt="Current Book Image" style="width:80px; height:auto; border-radius:4px;">
                </div>
              </div>

              <!-- Image upload -->
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Change Image</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control-file" name="photo" accept="image/*">
                  <small class="form-text text-muted">Leave empty if you do not want to change the image.</small>
                </div>
              </div>
            </div>

            <div class="card-footer text-center">
              <button type="submit" class="btn btn-danger">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>

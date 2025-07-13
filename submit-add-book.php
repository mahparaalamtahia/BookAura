<?php
require_once('functions/function.php');
needtologin();
admin();

if (!empty($_POST)) {

  // Sanitize inputs
  $name     = mysqli_real_escape_string($con, $_POST['name']);
  $author   = mysqli_real_escape_string($con, $_POST['author']);
  $category = mysqli_real_escape_string($con, $_POST['category']);
  $quantity = (int) $_POST['quantity'];

  // Generate unique slug for the book
  $slug = uniqid('book-', true);

  // Upload directory path
  $upload_dir = 'uploads/books/';

  // Create upload directory if not exists
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
  }

  // Handle image upload
  if (!empty($_FILES['photo']['name'])) {
    $image_name = $_FILES['photo']['name'];
    $image_tmp = $_FILES['photo']['tmp_name'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($image_ext, $allowed_ext)) {
      // Generate unique image filename
      $final_image = 'book-' . time() . '-' . rand(100000, 999999) . '.' . $image_ext;
      $target_path = $upload_dir . $final_image;

      if (move_uploaded_file($image_tmp, $target_path)) {
        // Insert book record including photo filename
        $insert = "INSERT INTO books (name, author, category, quantity, slug, photo)
                   VALUES ('$name', '$author', '$category', '$quantity', '$slug', '$final_image')";

        $Q = mysqli_query($con, $insert);

        if ($Q) {
          $_SESSION['success_alert'] = '1';
          header('Location: all-book.php');
          exit();
        } else {
          $_SESSION['success_alert'] = '8'; // DB insert failed
          header('Location: add-book.php');
          exit();
        }
      } else {
        $_SESSION['success_alert'] = '8'; // Failed to move uploaded file
        header('Location: add-book.php');
        exit();
      }

    } else {
      $_SESSION['success_alert'] = '8'; // Invalid image file type
      header('Location: add-book.php');
      exit();
    }

  } else {
    $_SESSION['success_alert'] = '8'; // No image uploaded
    header('Location: add-book.php');
    exit();
  }

} else {
  $_SESSION['success_alert'] = '8'; // No post data
  header('Location: add-book.php');
  exit();
}
?>

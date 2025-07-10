<?php
  require_once('functions/function.php');
  needtologin();
  admin();

  if (!empty($_POST)) {

    $slug = uniqid('CATEGORY');
    $category_name = $_POST['category_name'];

    $insert = "INSERT INTO category (name, slug) 
               VALUES ('$category_name', '$slug')";

    $Q = mysqli_query($con, $insert);

    if ($Q) {
      $_SESSION['success_alert'] = '1';
      header('Location: all-category.php');
    } else {
      $_SESSION['success_alert'] = '8';
      header('Location: add-category.php');
    }

  } else {
    $_SESSION['success_alert'] = '8';
    header('Location: add-category.php');
  }
?>

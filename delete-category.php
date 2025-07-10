<?php
  require_once('functions/function.php');
  needtologin();
  admin();

  $slug = $_GET['d'];
  $delete = "DELETE FROM category WHERE slug='$slug'";

  if (mysqli_query($con, $delete)) {
    $_SESSION['success_alert'] = '3';
    header('Location: all-category.php');
    exit;
  } else {
    header('Location: all-category.php');
    exit;
  }
?>

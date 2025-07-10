<?php
  require_once('functions/function.php');
  needtologin();
  admin();
  
  if (!empty($_POST)) {
    $slug = $_POST['slug'];
    $name = $_POST['name'];

    $update = "UPDATE category SET name='$name' WHERE slug='$slug'";

    $Q = mysqli_query($con, $update);

    if ($Q) {
      $_SESSION['success_alert'] = '2';
      header('Location: all-category.php');
      exit;
    } else {
      $_SESSION['success_alert'] = '8';  // You can define an error code here if you want
      header('Location: edit-category.php?e=' . $slug);
      exit;
    }
  }
?>

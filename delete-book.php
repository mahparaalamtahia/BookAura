<?php
  require_once('functions/function.php');
  needtologin();
  admin();

  $slug = $_GET['d'];
  $delete = "DELETE FROM books WHERE slug = '$slug'";

  if(mysqli_query($con, $delete)) {
    $_SESSION['success_alert'] = '3'; // Book deleted successfully
    header('Location: all-book.php');
  } else {
    header('Location: all-book.php');
  }
?>

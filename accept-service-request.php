<?php
require_once('functions/function.php');
needtologin();

$slug = $_GET['s'] ?? '';

// Step 1: Retrieve service request info
$serviceQuery = "SELECT book_id FROM services WHERE service_slug = '$slug' LIMIT 1";
$serviceResult = mysqli_query($con, $serviceQuery);

if ($serviceResult && mysqli_num_rows($serviceResult) > 0) {
  $serviceData = mysqli_fetch_assoc($serviceResult);
  $book_id = $serviceData['book_id'];

  // Step 2: Check if the book exists and has quantity > 0
  $bookCheckQuery = "SELECT quantity FROM books WHERE id = '$book_id' LIMIT 1";
  $bookResult = mysqli_query($con, $bookCheckQuery);

  if ($bookResult && mysqli_num_rows($bookResult) > 0) {
    $bookData = mysqli_fetch_assoc($bookResult);
    $currentQty = (int)$bookData['quantity'];

    if ($currentQty > 0) {
      // Step 3: Update service request as approved
      $updateService = "UPDATE services SET service_request_pending_status = '0' WHERE service_slug = '$slug'";
      $Q1 = mysqli_query($con, $updateService);

      // Step 4: Reduce book quantity by 1
      $updateBookQty = "UPDATE books SET quantity = quantity - 1 WHERE id = '$book_id'";
      $Q2 = mysqli_query($con, $updateBookQty);

      if ($Q1 && $Q2) {
        $_SESSION['success_alert'] = '1';
        header('Location: library-approved-requests.php');
        exit;
      } else {
        $_SESSION['success_alert'] = '5';
        header('Location: library-pending-requests.php');
        exit;
      }
    } else {
      // Quantity is 0, cannot approve
      $_SESSION['success_alert'] = '5';
      header('Location: library-pending-requests.php');
      exit;
    }
  } else {
    // Book not found
    $_SESSION['success_alert'] = '5';
    header('Location: library-pending-requests.php');
    exit;
  }
} else {
  // Service not found
  $_SESSION['success_alert'] = '5';
  header('Location: library-pending-requests.php');
  exit;
}
?>

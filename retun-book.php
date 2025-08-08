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

  // Step 2: Update service status to Returned (2)
  $updateService = "UPDATE services SET service_request_pending_status = '2' WHERE service_slug = '$slug'";
  $Q1 = mysqli_query($con, $updateService);

  // Step 3: Increase book quantity by 1
  $updateBookQty = "UPDATE books SET quantity = quantity + 1 WHERE id = '$book_id'";
  $Q2 = mysqli_query($con, $updateBookQty);

  if ($Q1 && $Q2) {
    $_SESSION['success_alert'] = '1'; // Success
    header('Location: library-return-book.php');
    exit;
  } else {
    $_SESSION['success_alert'] = '5'; // Failure
    header('Location: library-approved-requests.php');
    exit;
  }
} else {
  // Service not found
  $_SESSION['success_alert'] = '5';
  header('Location: library-approved-requests.php');
  exit;
}
?>

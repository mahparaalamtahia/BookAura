<?php
require_once('functions/function.php');
needtologin();

$slug = $_GET['s'] ?? '';

// Step 1: Check if the service request exists
$serviceQuery = "SELECT * FROM services WHERE service_slug = '$slug' LIMIT 1";
$serviceResult = mysqli_query($con, $serviceQuery);

if ($serviceResult && mysqli_num_rows($serviceResult) > 0) {
  
  // Step 2: Update service request status to Rejected (3)
  $updateService = "UPDATE services SET service_request_pending_status = '3' WHERE service_slug = '$slug'";
  $Q1 = mysqli_query($con, $updateService);

  if ($Q1) {
    $_SESSION['success_alert'] = '1';  // Success
    header('Location: library-pending-requests.php');
    exit;
  } else {
    $_SESSION['success_alert'] = '5';  // Failure
    header('Location: library-pending-requests.php');
    exit;
  }

} else {
  // Service request not found
  $_SESSION['success_alert'] = '5';
  header('Location: library-pending-requests.php');
  exit;
}
?>

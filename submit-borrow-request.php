<?php
  require_once('functions/function.php');
  needtologin();
  
  if(!empty($_POST))
  {
    
    $id=$_SESSION['id'];
    $service_slug=uniqid('BOR-REQ');
    $service_details=mysqli_real_escape_string($con,$_POST['service_details']);
    $book_id=$_POST['book_id'];
    $service_request_sending_date=date("Y-m-d");

    $insert="insert into services(service_details,book_id,user_id,service_request_sending_date,service_slug) 
    values ('$service_details','$book_id','$id','$service_request_sending_date','$service_slug')";

    $Q=mysqli_query($con,$insert);

    if($Q){
      $_SESSION['success_alert']='1';
      header("Location: dashboard.php");
    }

  }

?>

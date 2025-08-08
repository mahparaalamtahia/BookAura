<?php
  require_once('functions/function.php');
  needtologin();
  admin();
  if(!empty($_POST))
  {

    $slug=$_POST['slug'];
    $return_date=$_POST['return_date'];
    $return_time=$_POST['return_time'];
 
    $update="UPDATE services SET return_date='$return_date',return_time='$return_time' WHERE service_slug='$slug'";
  
    $Q=mysqli_query($con,$update);

    if($Q){
    
      $_SESSION['success_alert']='2';
    
      header('Location: library-approved-requests.php');
    }


  }    

?>

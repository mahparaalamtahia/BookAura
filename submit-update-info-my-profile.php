<?php
  require_once('functions/function.php');
  needtologin();

  if(!empty($_POST))
  {

    $slug=$_POST['slug'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];
    
    $nid=$_POST['nid'];
    
    if(empty($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])){      
    
    $imageName=$_POST['old_photo'];;
    
    $update="UPDATE user SET name='$name',email='$email',mobile='$mobile',address='$address',nid='$nid',photo='$imageName' WHERE slug='$slug'";
  
    $Q=mysqli_query($con,$update);

    
    if($Q){
    $_SESSION['success_alert']='1';

    header('Location: my-profile.php');
    }

    }else{
    
    $image=$_FILES['photo'];

    if($_SESSION['role_id']=='4'){

      $imageName='user_'.time().'_'.rand(100000,1000000).'.'.pathinfo($image['name'],PATHINFO_EXTENSION);
    
    }
  
    $update="UPDATE user SET name='$name',email='$email',mobile='$mobile',address='$address',nid='$nid',photo='$imageName' WHERE slug='$slug'";
  
    $Q_image=mysqli_query($con,$update);

    if($Q_image){
    move_uploaded_file($image['tmp_name'], 'uploads/'.$imageName);
    $_SESSION['success_alert']='1';
    header('Location: my-profile.php');
    }

  }
  }else{
    $_SESSION['success_alert']='5';
    header('Location: update-my-profile.php');
  }
  
?>


<?php
  require_once('functions/function.php');
  needtologin();
  get_header();
  get_sidebar();


  $id=$_SESSION['id'];
  $select="SELECT * FROM user WHERE id='$id'";
  $Query=mysqli_query($con,$select);
  $data=mysqli_fetch_assoc($Query);
  
  
  
  if($_SESSION['success_alert']=='1'){
    ?>
      <script>
        swal({title: "Done!", text: "Borrow request sent successfully!", icon: "success", button: "OK",});
      </script>
  
    
    <?php
      
      $_SESSION['success_alert']='0';
    
    }  


?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <hr>
    
        <div class="row">
          <div class="col-md-4">  
          </div>
          <div class="col-md-4">

          </div>
          <div class="col-md-4">  
          </div>
    
        </div>
        
        <hr>
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          
        </div> 
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        <!-- /.content -->
        </div>
  <!-- /.content-wrapper -->
  
<?php
  get_footer();
?>


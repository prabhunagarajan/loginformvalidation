<?php 
$host_name = "localhost";
$host_user = "root";
$host_pass = "";
$host_db = "loginform";


              $connect = mysqli_connect($host_name,$host_user,$host_pass)or die("Could not connect: ".mysqli_error());
              $db = mysqli_select_db($connect,$host_db);
   if(isset($_GET['id']))
  {

  $id       = $_GET['id'];    
  echo $id;              
  
  $sql      = "DELETE FROM loginvalidation WHERE id =$id";
  $query    = mysqli_query($connect,$sql) or die(mysqli_error());

  // Redirect browser
  header("Location: view.php?delete=success");
  exit;
}
 
?>
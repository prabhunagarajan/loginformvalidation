<?php 
$host_name = "localhost";
$host_user = "root";
$host_pass = "";
$host_db = "loginform";


              $connect = mysqli_connect($host_name,$host_user,$host_pass)or die("Could not connect: ".mysqli_error());
              $db = mysqli_select_db($connect,$host_db);

if(isset($_POST['email']))
{
  $email = $_POST['email'];

  
  $sql      = "select * FROM loginvalidation WHERE email ='$email'";
  $query    = mysqli_query($connect,$sql) or die(mysqli_error());
  $row      = $query->fetch_assoc();
  if(!empty($row)){
    echo 1;
  }else{
    echo 0;
  }  
}
  
?>
<?php

    $host_name = "localhost";
    $host_user = "root";
    $host_pass = "";
    $host_db = "loginform";
    
    
                  $connect = mysqli_connect($host_name,$host_user,$host_pass)or die("Could not connect: ".mysqli_error());
                  $db = mysqli_select_db($connect,$host_db);


   $sql = "SELECT * FROM demo_cities
         WHERE state_id LIKE '%".$_GET['id']."%'"; 


   $query    = mysqli_query($connect,$sql) or die(mysqli_error());


   $json = [];
   while($row      = $query->fetch_assoc()){
        $json[$row['id']] = $row['name'];
   }


   echo json_encode($json);
?>
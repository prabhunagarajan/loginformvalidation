<a href="form.php">add</a>
<?php
$host_name = "localhost";
$host_user = "root";
$host_pass = "";
$host_db = "loginform";


              $connect = mysqli_connect($host_name,$host_user,$host_pass)or die("Could not connect: ".mysqli_error());
              $db = mysqli_select_db($connect,$host_db);

$sql = "select * from loginvalidation";
$query = mysqli_query($connect,$sql);
?>
<?php

  if(isset($_GET['success']))
  {
   echo "User added Successfully";
  }

?>
<?php
if(isset($_GET['emailinsert']))
{
  echo "Email already exist";
}
// }else{
//   echo "Email updated successfully";
// }
?>
<table border=1 style="width:100%;">
    <thead>
      <tr>
        <th style="padding:10px;">Name</th>        
        <th style="padding:5px;">Email</th>
        <th style="padding:5px;">Number</th>
        <th style="padding:5px;">Gender</th>
        <th style="padding:5px;">Hobbies</th>
        <th style="padding:5px;">State</th>
        <th style="padding:5px;">City</th>
        <th style="padding:5px;">Delete</th>
        <th style="padding:5px;">edit</th>
        
        
      </tr>
    </thead>
    <tbody>

<?php
while($row = mysqli_fetch_assoc($query))
{
?>
      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['number']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['hobbies']; ?></td>
        <?php
        $sql      = "select * FROM demo_state WHERE id = ".$row['state']; 
        $query1    = mysqli_query($connect,$sql) or die(mysqli_error());
        $result      = $query1->fetch_assoc();
        print_r($result);

        $sql      = "select * FROM demo_cities WHERE id = ".$row['city'];
        $query2    = mysqli_query($connect,$sql) or die(mysqli_error());
        $result1      = $query2->fetch_assoc();
        print_r($result1);
        ?>
        <td><?php echo $result['name']; ?></td>
        <td><?php echo $result1['name']; ?></td>
        <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
        <td><a href="update.php?id=<?php echo $row['id']; ?>">edit</a></td>


      </tr>
<?php
}
?>
</tbody>
</table>
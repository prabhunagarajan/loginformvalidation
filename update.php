<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jquery Form Validation</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $host_name = "localhost";
    $host_user = "root";
    $host_pass = "";
    $host_db = "loginform";
    
    
                  $connect = mysqli_connect($host_name,$host_user,$host_pass)or die("Could not connect: ".mysqli_error());
                  $db = mysqli_select_db($connect,$host_db);

                  $id  = $_GET['id'];
                  
                  $flag = "";

                  $sql = "select * from loginvalidation where id=$id";
                  $query = mysqli_query($connect,$sql); 
                  $row = $query->fetch_assoc();
                  if(empty($row))
                  {
                  header("Location: view.php");
                  }
 

                    if(isset($_POST['submit'])){

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $number = $_POST['number'];
                    $gender = $_POST['gender'];
                    $hobbies = $_POST['hobbies'];
                    $state = $_POST['state'];
                    $city = $_POST['city'];


                    
                    $sql      = "select * FROM loginvalidation WHERE email ='$email' && id != '$id'";
                    $query    = mysqli_query($connect,$sql) or die(mysqli_error());
                    $row      = $query->fetch_assoc();



                    
                    if(!empty($row)){

                    $flag = 1;
                    //header("Location: update.php?erroremail=1");
                    }else{

                    $flag = 0;
                    
                    $sql="update loginvalidation set `name`='$name',`email`='$email',`number`='$number',`gender`='$gender',`hobbies`='$hobbies',`state`='$state',`city`='$city' WHERE id=$id";
                    $query = mysqli_query($connect,$sql) or die(mysqli_error());

                    header("Location: view.php?upadte=success");
                    }  
                    }
    ?>
    <div class="container">
      <?php
      if($flag == 1)
      {
      echo "User already exist";
      }
      ?>
    <form style="background-color:gray" id="form" name="form" method="POST" action="">
        <div class="form-check mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
        <span id="name_error" class="error"></span>
        </div>
        <div class="form-check mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" onkeyup="checkEmail(<?php echo $row['id']; ?>);" value="<?php echo $row['email']; ?>">
        <span id="email_error" class="error"></span>
        </div>
        <div class="form-check mb-3">
        <label for="number" class="form-label">Phone Number:</label>
        <input type="text" name="number" id="number" value="<?php echo $row['number']; ?>">
        <span id="number_error" class="error"></span>
        </div>
        <div class="form-check mb-3">
            <label>Gender:</label>
            <input type="radio" name="gender" id="gender" value="male"<?php echo ($row['gender']=='male')?'checked':'' ?>> <label for="male" class="form-label"> Male</label>
            <input type="radio" name="gender" id="gender1" value="female"<?php echo ($row['gender']=='female')?'checked':'' ?>> <label for="female" class="form-label"> Female</label>
            <span id="gender_error"></span>
        </div>
        <div class="form-check mb-3">
            <label>Hobbies:</label>
            <input type="checkbox" name="hobbies" id="cricket" value="cricket"<?php echo ($row['hobbies']=='cricket')?'checked':'' ?>> <label for="cricket" class="form-label">cricket</label>
            <input type="checkbox" name="hobbies" id="volleyball" value="volleyball"<?php echo ($row['hobbies']=='volleyball')?'checked':'' ?>> <label for="volleyball" class="form-label">volleyball</label>
            <span id="hobbies_error"></span>
        </div>
    

        <div class="panel-body">
            <div class="form-group">
                <label for="title">Select State:</label>
                <select name="state" class="form-control">
                    <option value="">--- Select State ---</option>
                   


                    <?php
                        
                        $sql = "SELECT * FROM demo_state";
                        $query    = mysqli_query($connect,$sql) or die(mysqli_error());
                        while($rowone      = $query->fetch_assoc()){

                            if($row['state']==$rowone['id'])
                            echo "<option value='".$rowone['id']."' selected>".$rowone['name']."</option>";
                            ?>
                            <?php
                            
                        }
                    ?>


                </select>
            </div>


            <div class="form-group">
                <label for="title">Select City:</label>
                <select name="city" class="form-control">
                <?php
                        
                        $sql = "SELECT * FROM demo_cities where state_id='".$row['state']."'";
                        $query    = mysqli_query($connect,$sql) or die(mysqli_error());
                        while($rowone      = $query->fetch_assoc()){
                            
                            if($row['city']==$rowone['id'])
                            echo "<option value='".$rowone['id']."' selected>".$rowone['name']."</option>";
                            else{
                                echo "<option value='".$rowone['id']."'>".$rowone['name']."</option>";
                            }
                            ?>
                            
                            <?php
                            
                        }
                    ?>
                </select>
            </div>


      </div>

            <div>
            <input type="submit" name="submit" id="submit" placeholder="submit">
            </div>
       </form>
    </div>
</body>
</html>


<script type="text/javascript">

      function checkEmail(id){ 

      var txtemail       = $('#email').val();
        
      
          
        $.ajax({
          
            type: "POST",
            url: 'emailupdate.php',
            data: {email: txtemail , id: id},
            success: function(result){
              $('#name').val(result);
                if(result == 1){
                  $('#email_error').text('Email ID Already Exists');
                }else{
                  $('#email_error').text('');
                }
                
            }
        });
      }
    
  </script>


<script>
$( "select[name='state']" ).change(function () {
    var stateID = $(this).val();
    if(stateID) {


        $.ajax({
            url: "ajax.php",
            dataType: 'Json',
            data: {'id':stateID},
            success: function(data) {
                $('select[name="city"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        $('select[name="city"]').empty();
    }
});
</script>
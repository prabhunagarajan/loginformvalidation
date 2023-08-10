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
  <style>
    form {
      background-color: rgb(29, 138, 211);
      text-align: center;
      padding: 30px;
      width: 50%;
      margin: auto;
      border-radius: 10px;
    }

    label {
      color: rgb(47, 0, 255);
    }

    input[type="text"],
    input[type="email"],
    input[type="radio"],
    input[type="checkbox"] {
      margin-left: 15px;
      border-radius: 5px;
      border-color: rgb(223, 65, 17);
    }

    input[type="text"]:focus {
      outline-color: rgb(20, 164, 230);
    }

    input[type="email"]:focus {
      outline-color: rgb(20, 164, 230);
    }

    input[type="submit"] {
      padding: 10px;
      color: rgb(255, 255, 255);
      background-color: rgb(53, 64, 211);
      border-color: none;
      border-style: none;
      border-radius: 5px;
    }

    .col-md-4{
      background-color: rgb(255, 0, 234);
      padding:30px;
      margin-bottom: 100px;
      border-radius: 5px;
      margin:10px auto 10px auto;
    }
    #checkcurrency,#inputvalue,#check{
      margin-top:10px;
      margin-bottom:10px;
    }
    .error {
      color: red;
    }
  </style>
</head>

<body>
  <script>
    $(document).ready(function () {
      $('#form').submit(function () {

        var name = $('#name').val();
        var email = $('#email').val();
        var number = $('#number').val();
        var gender = $('#gender').val();

        // $(".error").remove();

        //name validate

        var flag = 1;
        if (name.length < 1) {
          $('#name_error').text('please enter first name');
          flag = 0;
        }

        //email validate

        if (email.length < 1) {
          $('#email_error').text('please enter Your email Id');
          flag = 0;
        }
        else {
          var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
          var validEmail = regEx.test(email);
          if (validEmail) {
            $('#email').after('<span class="error">Enter a valid email</span>');
            flag = 0;
          }
        }

        //number validate

        if (number.length < 1) {
          $('#number_error').text('please enter valid number');
          flag = 0;
        }

        //checkbox validate 

        if ($('input[type=checkbox]:checked').length == 0) {
          $('#hobbies_error').text('ERROR! Please select at least one checkbox');
          flag = 0;
        }

        if (flag == 1) {
          return true;
        } else {
          return false;
        }

      });

    });

  </script>
  <?php
  $host_name = "localhost";
  $host_user = "root";
  $host_pass = "";
  $host_db = "loginform";


  $connect = mysqli_connect($host_name, $host_user, $host_pass) or die("Could not connect: " . mysqli_error());
  $db = mysqli_select_db($connect, $host_db);



  if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $hobbies = $_POST['hobbies'];
    $state = $_POST['state'];
    $city = $_POST['city'];



    $sql = "select * FROM loginvalidation WHERE email ='$email'";
    $query = mysqli_query($connect, $sql) or die(mysqli_error());
    $row = $query->fetch_assoc();



    if (!empty($row)) {

      $flag = 1;
      header("Location: form.php?insert=Email-already-exist");

    } else {

      $sql = "insert into loginvalidation (`name`,`email`,`number`,`gender`,`hobbies`,`state`,`city`) values ('$name','$email','$number','$gender','$hobbies','$state','$city')";
      $query = mysqli_query($connect, $sql) or die(mysqli_error());

      $flag = 0;
      header("Location: view.php?success=add");
    }

    exit;
  }
  ?>
  <div class="container">
    <?php
    if (isset($_GET['insert'])) {
      echo "User already exist";
    }
    ?>
    <a href="view.php">view</a>
    <form id="form" name="form" method="POST" action="">
      <div class="form-check mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name">
        <span id="name_error" class="error"></span>
      </div>
      <div class="form-check mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" onkeyup="checkEmail();">
        <span id="email_error"></span>
      </div>
      <div class="form-check mb-3">
        <label for="number" class="form-label">Phone Number:</label>
        <input type="text" name="number" id="number">
        <span id="number_error" class="error"></span>
      </div>
      <div class="form-check mb-3">
        <label>Gender:</label>
        <input type="radio" name="gender" id="gender" value="male"> <label for="male" class="form-label"> Male</label>
        <input type="radio" name="gender" id="gender1" value="female"> <label for="female" class="form-label">
          Female</label>
        <span id="gender_error"></span>
      </div>
      <div class="form-check mb-3">
        <label>Hobbies:</label>
        <input type="checkbox" name="hobbies" id="cricket" value="cricket"> <label for="cricket"
          class="form-label">cricket</label>
        <input type="checkbox" name="hobbies" id="volleyball" value="volleyball"> <label for="volleyball"
          class="form-label">volleyball</label>
        <span id="hobbies_error"></span>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <label for="title">Select State:</label>
            <select name="state" class="form-control">
              <option value="">--- Select State ---</option>



              <?php

              $sql = "SELECT * FROM demo_state";
              $query = mysqli_query($connect, $sql) or die(mysqli_error());
              while ($row = $query->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
              }
              ?>


            </select>
          </div>


          <div class="form-group">
            <label for="title">Select City:</label>
            <select name="city" class="form-control">
            </select>
          </div>


        </div>
      </div>
      <div>
        <input type="submit" name="submit" id="submit" placeholder="submit">
      </div>
    </form>
  </div>
  <div class="col-md-4">
  <h5>Pass Api Value</h5>
    <div class="panel-body">
      <div class="form-group">
        <label for="title">First Name:</label>
        <select name="firstname" class="form-control">
          <option value="">first_name</option>
        </select>
      </div>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="title">Last Name:</label>
        <select name="lastname" class="form-control">
          <option value="">last_name</option>
        </select>
      </div>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="title">Email:</label>
        <select name="email" class="form-control">
          <option value="">email</option>
        </select>
      </div>
    </div>
    <h5>Check Currency Value</h5>
    <div class="panel-body">
      <div class="form-group">
        <label for="title">From currency:</label>
        <select name="fromcurrency" id="fromcurrency" class="form-control" onchange="checkCurrency();">
          <option value="EUR">EUR</option>
          <option value="XAU">XAU</option>
          <option value="XAG">XAG</option>
          <option value="INR">INR</option>
          <option value="USD">USD</option>
        </select>
      </div>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="title">To currency:</label>
        <select name="tocurrency" id="tocurrency" class="form-control">
          <option value="EUR">EUR</option>
          <option value="XAU">XAU</option>
          <option value="XAG">XAG</option>
          <option value="INR">INR</option>
          <option value="USD">USD</option>
        </select>
      </div>
      <label>currency value:</label>
        <input id="checkcurrency">
    </div>
    <h5>Check BTC Value</h5>
    <div class="form-group">
      <label for="title">From currency:</label>
      <select name="currency" id="currency" class="form-control" onchange="checkCurrency();">
        <option value="EUR">EUR</option>
        <option value="XAU">XAU</option>
        <option value="XAG">XAG</option>
        <option value="INR">INR</option>
        <option value="USD">USD</option>
      </select>
    </div>
    <label>Input Value:</label>
    <input id="inputvalue" value="" onkeyup="inputValue();"><br>
    <label>BTC value:</label>
    <input id="checkbtc">
  </div>
</body>

</html>
<script type="text/javascript">

  function checkEmail() {
    var txtemail = $('#email').val();

    $.ajax({

      type: "POST",
      url: 'email.php',
      data: { email: txtemail, },
      success: function (result) {

        if (result == 1) {
          $('#email_error').text('Email ID Already Exists');
        } else {
          $('#email_error').text('');
        }
      }
    });
  }

</script>
<script type="text/javascript">
  $('input[name="name"]').on('keydown', function (e) {
    var blockedValue = ["vicky", "hari", "prabhu"];
    var currentValue = $(this).val();
    if (currentValue == blockedValue[0] || currentValue == blockedValue[1] || currentValue == blockedValue[2]) {
      $('#name').val("");
      return false;
    }
  });
</script>
<script>
  $("select[name='state']").change(function () {
    var stateID = $(this).val();
    if (stateID) {


      $.ajax({
        url: "https://reqres.in/api/users",
        dataType: 'Json',
        data: { 'id': stateID },
        success: function (data) {
          console.log(data);
          $('select[name="city"]').empty();
          $.each(data, function (key, value) {

            $('select[name="city"]').append('<option value="' + key + '">' + value + '</option>');
            // console.log(value.first_name+"this is api value:"+ value.email);
          });
        }
      });


    } else {
      $('select[name="city"]').empty();
    }

  });



  $.ajax({
    url: "https://reqres.in/api/users",
    dataType: 'Json',
    success: function (data) {
      console.log(data.data);
      //     $('select[name="city"]').empty();
      $.each(data.data, function (key, value) {

        $('select[name="firstname"]').append('<option value="' + value.first_name + '">' + value.first_name + '</option>');
      });
    }
  });


  $.ajax({
    url: "https://reqres.in/api/users",
    dataType: 'Json',
    success: function (data) {
      console.log(data.data);
      //     $('select[name="city"]').empty();
      $.each(data.data, function (key, value) {

        $('select[name="lastname"]').append('<option value="' + value.last_name + '">' + value.last_name + '</option>');
      });
    }
  });


  $.ajax({
    url: "https://reqres.in/api/users",
    dataType: 'Json',
    success: function (data) {
      console.log(data.data);
      //     $('select[name="city"]').empty();
      $.each(data.data, function (key, value) {

        $('select[name="email"]').append('<option value="' + value.email + '">' + value.email + '</option>');
      });
    }
  });


</script>
<script type="text/javascript">
  function checkCurrency() {
    var fromcurrency = $('#fromcurrency').val();
    var tocurrency = $('#tocurrency').val();
    $.ajax({
      url: 'https://api.metalpriceapi.com/v1/latest?api_key=32e848a259a560849e981ec38af04563&base=' + fromcurrency + '&currencies=' + tocurrency,
      dataType: 'Json',
      success: function (data) {
        console.log(data);
        $.each(data.rates, function (key, value) {
          document.getElementById("checkcurrency").value = value;
        });
      }
    });
  }

</script>
<script>
  function inputValue() {
    var fromcurrency = $('#currency').val();
    var inputvalue = $('#inputvalue').val();
    $.ajax({
      url: 'https://blockchain.info/tobtc?currency=' + fromcurrency + '&value=' + inputvalue,
      dataType: 'Json',
      success: function (data) {
        console.log(data);

        document.getElementById("checkbtc").value = data;

      }
    });
  }
</script>
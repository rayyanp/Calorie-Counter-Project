<?php
echo <<<HEADER1
<!DOCTYPE html>
<html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c3521ff66d.js" crossorigin="anonymous"></script>  
<link rel="stylesheet" href=css/style.css>

<title>The Calorie Counter</title>
</head>

<div class="heading">
    <img src="img/tempLogo.png" id="logo" alt="Logo" width="105">
My Fitness Friend
</div>

<br>
HEADER1;
  include 'verify.php';
  include 'header.php';
  
  $show_signup_form = true;

  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");

  if(isset($_POST['post'])){
    $show_signup_form = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $start_weight = $_POST['start_weight'];
    $current_weight = $_POST['current_weight'];
    $goal_weight = $_POST['goal_weight'];
    $height = $_POST['height'];
    $unit1 = $_POST['unit1'];
    $unit2 = $_POST['unit1'];
    //$calorie_intake = $_POST['calorie_intake'];
  
    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $firstname = sanitise($firstname,$connection);
    $lastname = sanitise($lastname,$connection);
    $email = sanitise($email,$connection);
    $age = sanitise($age,$connection);
    $gender = sanitise($gender,$connection);
    $start_weight = sanitise($start_weight,$connection);
    $current_weight = sanitise($current_weight,$connection);
    $goal_weight = sanitise($goal_weight,$connection);
    $height = sanitise($height,$connection);
    $unit1 = sanitise($unit1,$connection);
    $unit2 = sanitise($unit2,$connection);
    //$calorie_intake = sanitise($calorie_intake,$connection);
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($gender, 1, 6);
    $error8 = validateString($start_weight, 1, 3);
    $error9 = validateString($current_weight, 1, 3);
    $error10 = validateString($goal_weight, 1, 3);
    $error11 = validateString($height, 1, 3);
    $error12 = validateString($unit1, 1, 3);
    $error13 = validateString($unit2, 1, 3);
    //$error14 = validateString($calorie_intake, 1, 5);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10.$error11.$error12.$error13;

    if (!$errors) {
      
    $query = "INSERT INTO users VALUES(null,'$username','$password','$firstname','$lastname','$email','$age','$gender','$start_weight','$current_weight','$goal_weight','$height','$unit1','$unit2',null,null,null,null)";
    
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('You have signed up!...You can now login.');
      window.location.href = 'home.php';
      </script>";
    }
    else{
      echo "<script>alert('Your registration has failed. {$errors} Please try again.');
      window.location.href = 'sign_up.php';
      </script>";
    }
     mysqli_close($connection);
  }
}
  if ($show_signup_form) {
    echo <<<SIGNUP
    
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <center><h4>Sign Up:</h4></center>
          <form action="#" method="post">
              
            <div class="form-group">
              <label for="username" class="col-sm-2 col-sm-offset-2 control-label">Username:</label>
              <input class="form-control" type="text" minlength="1" maxlength="32" name="username" placeholder="Enter your username" required>
            </div>
            
            <div class="form-group">
              <label for="password" class="col-sm-2 col-sm-offset-2 control-label">Password:</label>
              <input class="form-control" type="password" minlength="1" maxlength="64" name="password" placeholder="Enter your Password" required>
            </div>

            <div class="form-group">
              <label for="firstname" class="col-sm-2 col-sm-offset-2 control-label">First Name:</label>
              <input class="form-control" type="text" minlength="1" maxlength="64" name="firstname" placeholder="Enter your First Name" required>
            </div>

            <div class="form-group">
              <label for="lastname" class="col-sm-2 col-sm-offset-2 control-label">Last Name:</label>
              <input class="form-control" type="text" minlength="1" maxlength="64" name="lastname" placeholder="Enter your Last Name" required>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 col-sm-offset-2 control-label">Email:</label>
              <input class="form-control" type="email" minlength="1" maxlength="128" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
              <label for="age" class="col-sm-2 col-sm-offset-2 control-label">Age:</label>
              <input class="form-control" type="number" minlength="1" maxlength="3" name="age" placeholder="Enter your age" required>
            </div>

            <div class="form-group">
            <label for="gender" class="col-sm-2 col-sm-offset-2 control-label">Gender:</label><br>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
             </div>

            <div class="form-group">
              <label for="start_weight" class="col-sm-2 col-sm-offset-2 control-label">Start Weight:</label>
              <input class="form-control" type="number" minlength="1" maxlength="3" name="start_weight" placeholder="Enter your starting weight" required>
            </div>

            <div class="form-group">
            <label for="current_weight" class="col-sm-2 col-sm-offset-2 control-label">Current Weight:</label>
            <input class="form-control" type="number" minlength="1" maxlength="3" name="current_weight" placeholder="Enter your current weight" required>
          </div>

          <div class="form-group">
          <label for="goal_weight" class="col-sm-2 col-sm-offset-2 control-label">Goal Weight:</label>
          <input class="form-control" type="number" minlength="1" maxlength="3" name="goal_weight" placeholder="Enter your goal weight" required>
        </div>

        <div class="form-group">
        <select name="unit1" id="unit1">
            <option value="kg">kg</option>
            <option value="lb">lb</option>
        </select>
         </div>
              
            <div class="form-group">
              <label for="height" class="col-sm-2 col-sm-offset-2 control-label">Height:</label>
              <input class="form-control" type="number" minlength="1" maxlength="3" name="height" placeholder="Enter your height" required>
            </div>


             <div class="form-group">
             <select name="unit2" id="unit2">
                 <option value="ft">ft</option>
                 <option value="cm">cm</option>
             </select>
              </div>

            <p>By clicking Sign Up, you agree to our Terms and that have read our Data Policy, including your Cookie use.<p>
           

            <input type="checkbox" id="TickBox" name="TickBox" value="checkbox">
  <label for="vehicle1">I have read and Accept  the <a href="https://www.legislation.gov.uk/ukpga/2018/12/pdfs/ukpga_20180012_en.pdf"> Privacy Policy</a></label><br>

            <button class="btn btn-primary" type="submit" name="post">Sign Up</button>

          </form><br>

          <span>Already registered? <a href="home.php">Click here to sign in</a></span>

        </div>
      </div>
    </div>
SIGNUP;
}
  
include 'footer.php';
?>
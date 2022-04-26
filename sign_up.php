<?php
  include 'verify.php';
  
  $show_signup_form = true;

  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");

  if(isset($_POST['sign_up'])){
    $show_signup_form = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $feet = $_POST['feet'];
    $inches = $_POST['inches'];
    $calorie_goal = $_POST['calorie_goal'];
  
    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $firstname = sanitise($firstname,$connection);
    $lastname = sanitise($lastname,$connection);
    $email = sanitise($email,$connection);
    $age = sanitise($age,$connection);
    $weight = sanitise($weight,$connection);
    $feet = sanitise($feet,$connection);
    $inches = sanitise($inches,$connection);
    $calorie_goal = sanitise($calorie_goal,$connection);
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($weight, 1, 3);
    $error8 = validateString($feet, 1, 2);
    $error9 = validateString($inches, 1, 2);
    $error10 = validateString($calorie_goal, 1, 5);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10;

    if (!$errors) {
      
    $query = "INSERT INTO users VALUES(null,'$username','$password','$firstname','$lastname','$email','$age','$weight','$feet','$inches','$calorie_goal')";
    
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
  else
  {
    echo "<script>alert('Your registration has failed. {$errors} Please try again.');
    window.location.href = 'sign_up.php';
    </script>";
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
              <label for="weight" class="col-sm-2 col-sm-offset-2 control-label">Weight (KG):</label>
              <input class="form-control" type="number" minlength="1" maxlength="3" name="weight" placeholder="Enter your weight in kg" required>
            </div>
              
            <div class="form-group">
              <label for="feet" class="col-sm-2 col-sm-offset-2 control-label">Feet (ft):</label>
              <input class="form-control" type="number" minlength="1" maxlength="2" name="feet" placeholder="Enter your height in feet" required>
            </div>

            <div class="form-group">
              <label for="inches" class="col-sm-2 col-sm-offset-2 control-label">Inches:</label>
              <input class="form-control" type="number" minlength="1" maxlength="2" name="inches" placeholder="Enter your height in inches" required>
            </div>

            <div class="form-group">
              <label for="calorie_goal" class="col-sm-2 col-sm-offset-2 control-label">Calorie Goal:</label>
              <input class="form-control" type="number" minlength="1" maxlength="5" name="calorie_goal" placeholder="Enter your calorie goal" required>
            </div><br>

            <p>By clicking Sign Up, you agree to our Terms and that have read our Data Policy, including your Cookie use.<p>
           

            <input type="checkbox" id="TickBox" name="TickBox" value="checkbox">
  <label for="vehicle1">I have read and Accept  the <a href="https://www.legislation.gov.uk/ukpga/2018/12/pdfs/ukpga_20180012_en.pdf"> Privacy Policy</a></label><br>

            <button class="btn btn-primary" type="submit" name="sign_up">Sign Up</button>

          </form><br>

          <span>Already registered? <a href="home.php">Click here to sign in</a></span>

        </div>
      </div>
    </div>
  SIGNUP;
  }
  
include 'footer.php';
?>

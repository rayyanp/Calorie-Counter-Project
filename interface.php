<?php
$path = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
// Interface for signed-in users
if (isset($_SESSION['username'])) {
  $show_signin_form = false;
  
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  
  if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
  }

  
  $calorieQuery = "SELECT SUM(calorie_intake) FROM calories WHERE uid = '$_SESSION[uid]' AND date(datetime) = curdate();";
  $calorieResult = mysqli_query($connection, $calorieQuery);
  $crTemp = mysqli_fetch_array($calorieResult);
  if(empty($crTemp[0])) {
    $cr = 0;
  }
  else {
    $cr = $crTemp[0];
  }


  $query = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
  $result = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $sw = $row['start_weight'];
    $cw = $row['current_weight'];
    $gw = $row['goal_weight'];
    $g = $row['gender'];

  }

  // calculation for calorie goal
  $result1 = $cw * 2.205;
  $result2 = $result1 * 15;

  $x = $sw - $gw;
  $y = $sw - $cw;
  $z = $y / $x;
  $offset = 1 - $z;

  $reduction = $offset / 2;

  $reduction2 = $result2 * $reduction;

  // intake figures

  if($g == "Male") {
    $ci = MAX(round($result2 - $reduction2),1800);
  }
  else {
    $ci = MAX(round($result2 - $reduction2),1500);
  }
  $ri = round($ci - $cr);


  echo <<<INTERFACE
  <div class="container-fluid" id="calorie">
    <legend class="title">Calories Remaining</legend> 
    <div class="row">
      <div class="col">
        <label>{$ci}<br>Goal</label>
      </div>
      <div class="col">
        <label>-</label>
      </div>
      <div class="col">
        <label>{$cr}<br>
        Food</label>
      </div>
      <div class="col">
        <label>=</label>
      </div>
      <div class="col">
        <label>{$ri}<br>
        Remaining</label>
      </div>
    </div>
  </div>
  INTERFACE;

  echo <<<NAV
  <nav class="navbar navbar-default" id="UserNav">
    <span class="container-fluid">
    <ul class="nav nav-pills navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <img src="img/home.png" width="80" alt="Home nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="diary.php">
              <img src="img/diary.png" width="80" alt="Diary nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="recipes.php">
              <img src="img/recipes.png" width="80" alt="Recipes nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="me.php">
              <img src="img/me.png" width="80" alt="Me nav button"> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="support.php">
              <img src="img/support.png" width="80" alt="Support nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sign_out.php">
              <img src="img/signOut.png" width="80" alt="Sign Out nav button">  
            </a>
          </li>
        </ul>
    </span>
  </nav>
  NAV;
}

// Sign-in interface
elseif ($_SERVER['REQUEST_URI'] != $path .'sign_up.php' && 
$_SERVER['REQUEST_URI'] != $path .'tos.php') {
  include 'verify.php';
  $show_signin_form = false;
  
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  
  if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
  }
  
  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $error1 = validateString($username, 1, 16);
    $error2 = validateString($password, 1, 16);
    $errors = $error1.$error2;
      
    if ($errors == "") {
      $username = sanitise($username,$connection);
      $password = sanitise($password,$connection);
      $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $query_run = mysqli_query($connection,$query);

      if(mysqli_num_rows($query_run)) {
        $_SESSION['username'] = $_POST['username'];
        while($row = mysqli_fetch_assoc($query_run)) {
          $_SESSION['uid'] = $row['uid'];
          echo "<script> window.location.href = 'home.php';</script>";
        }
      }
    } 
    
    else {
      echo "<script>alert('Please Enter correct Username and Password');
      </script>";
    } 
    mysqli_close($connection);
  } 

  
  if (isset($_SESSION['uid'])) {
    echo 'You are already logged in, please log out first.<br>
    <a href="sign_out.php" type="button" class="btn btn-success btn-block testButton">Logout</a><br>';
  } 
  
  else {
      $show_signin_form = true;
  }

  if ($show_signin_form) {
    echo <<<LOGIN
      <div class="container-fluid" id="loginHeader">
        <legend class="title"><b>Welcome to The Calorie Counter</b></legend> 
        <i>Get started with your health journey!</i>
      </div>

      <fieldset>
        <div class="container-fluid" id="login">
          <div class="col-md-4 m-auto block"><br>
            <center><h4>Login</h4></center>
            
            <hr>
            
            <form action="home.php" method="post">
              <div class="row">
                <div class="col">
                  <label>Username:</label><br>
                  <label>Password:</label><Br>
                </div>

                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="text" minlength="1" maxlength="16" name="username" 
                      placeholder="Enter your Username" required>
                      <input class="form-control" type="password" minlength="1" maxlength="16" name="password" 
                      placeholder="Enter your Password" required>
                      <br>
                    </div>    
                  </div>
                </div><br><br>

              </div>

              <div class="row">
                <button class="btn btn-primary" type="submit" name="login" width=100%>Login</button>
              </div>
            </form><br>
                  
            <span>Not registered? <a href="sign_up.php">Click here to sign up</a></span>
          </div><br>
        </div>
      </fieldset>
    LOGIN;
  }
}
elseif ($_SERVER['REQUEST_URI'] != $path .'tos.php') {
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
    $gender = $_POST['gender'];
    $start_weight = $_POST['start_weight'];
    $current_weight = $_POST['start_weight'];
    $goal_weight = $_POST['goal_weight'];
    $height = $_POST['height'];
    $unit1 = $_POST['unit1'];
    $unit2 = $_POST['unit2'];


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
    
    <div class="container-fluid" id="loginHeader">
      <legend class="title"><b>Welcome to The Calorie Counter</b></legend> 
      <i>Get started with your health journey!</i>
    </div>

    <fieldset>
    <div class="container-fluid" id="login">
      <div class="col-md-4 m-auto block"><br>
        <center><h4>Sign Up</h4></center>

            <hr>

            <form action="home" method="post">
              <div class="row">
                <div class="col">
                  <label>Username:</label><br>
                  <label>Password:</label><br>
                  <label>First Name:</label><br>
                  <label>Last Name:</label><br>
                  <label>Email:</label><br>
                  <label>Age:</label><br>
                  <label>Gender:</label><br>
                </div>
              
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="text" minlength="1" maxlength="32" name="username" 
                      placeholder="Enter your username" required>
                      <input class="form-control" type="password" minlength="1" maxlength="64" name="password" 
                      placeholder="Enter your Password" required>
                      <input class="form-control" type="text" minlength="1" maxlength="64" name="firstname" 
                      placeholder="Enter your First Name" required>
                      <input class="form-control" type="text" minlength="1" maxlength="64" name="lastname" 
                      placeholder="Enter your Last Name" required>
                      <input class="form-control" type="email" minlength="1" maxlength="128" name="email" 
                      placeholder="Enter your email" required>
                      <input class="form-control" type="number" minlength="1" maxlength="3" name="age" 
                      placeholder="Enter your age" required>
                      <select name="gender" id="gender">
                          <option value="" selected disabled hidden>Select your Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option><br>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col">
                  <label for="weight">Weight:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="3" name="start_weight" 
                      placeholder="Enter your weight in kg" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <select name="unit1" id="weight">
                      <option value="kg">kg</option>
                      <option value="lb">lb</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="feet">Goal Weight:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="2" name="goal_weight" 
                      placeholder="Enter your height in feet" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="inches">Height:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="2" name="height" 
                      placeholder="Enter your height in inches" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <select name="unit2" id="height">
                      <option value="cm">cm</option>
                      <option value="ft">Feet/Inches</option>
                  </select>
                </div>
              </div>

              <hr>

              <div class="row">

                <p>By clicking Sign Up, you agree to our Terms and that have read our Data Policy, including your Cookie use.<p>
                

                <input type="checkbox" id="TickBox" name="TickBox" value="checkbox">
                <label for="vehicle1">I have read and Accept  the <a href="tos.php"> Terms of Service</a></label><br>
              </div>

              <div class="row">
                <button class="btn btn-primary" type="submit" name="sign_up">Sign Up</button>
              </div>          
            </form><br>

            <span>Already registered? <a href="home.php">Click here to sign in</a></span>

          </div>
        </div>
      </div>
    </fieldset>
  SIGNUP;
  }
}

else {
  include 'docs/ToS.php';
}

?>
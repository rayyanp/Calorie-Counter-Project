<?php
  // Interface for signed-in users
  if (isset($_SESSION['username'])) {
    echo <<<INTERFACE
    <div class="container-fluid" id="calorie">
      <legend class="title">Calories Remaining</legend> 
      <div class="row">

        <div class="col">
          <label>2500<br>
          Goal</label>
        </div>

        <div class="col">
          <label>-</label>
        </div>

        <div class="col">
          <label>900<br>
          Food</label>
        </div>

        <div class="col">
          <label>=</label>
        </div>

        <div class="col">
          <label>1600<br>
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
  else {
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
    
    else {
      echo "<b>Sign-in Failed</b><br><br>";
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

      <div class="container-fluid" id="login">
        <div class="col-md-4 m-auto block"><br>
          <center><h4>Login:</h4></center>
          
          <hr>
          
          <form action="home.php" method="post">
            <div class="form-group"><br>
              <label>Username:</label>
              <input class="form-control" type="text" minlength="1" maxlength="16" name="username" 
              placeholder="Enter your Username" required>
            </div><br>

            <div class="form-group">
              <label>Password:</label>
              <input class="form-control" type="password" minlength="1" maxlength="16" name="password" 
              placeholder="Enter your Password" required>
            </div><br>

            <button class="btn btn-primary" type="submit" name="login">Login</button>
          </form><br>
                
          <span>Not registered? <a href="sign_up.php">Click here to sign up</a></span>

        </div><br>
      </div>
    LOGIN;
  }
  }

?>
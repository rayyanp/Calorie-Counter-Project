<?php
include 'header.php';
include 'verify.php';
$show_edit_form = true;

if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  $username = "";
  $firstname = "";
  $lastname = "";
  $email = "";
  $password = "";
  $age = "";
  $weight = "";
  $feet = "";
  $inches = "";
  $calorie_goal = "";
  $query = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
  $query_run = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($query_run)){
    $username = $row['username'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $age = $row['age'];
    $weight = $row['weight'];
    $feet = $row['feet'];
    $inches = $row['inches'];
    $calorie_goal = $row['calorie_goal'];
  }

  $userid =$_SESSION['uid'];
  if(isset($_POST['post'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
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
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($weight, 1, 32);
    $error8 = validateString($feet, 1, 40);
    $error9 = validateString($inches, 1, 2);
    $error10 = validateString($calorie_goal, 1, 5);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10;

    if (!$errors) {

    $updatequery = "UPDATE users SET username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', age = '$age', weight = '$weight', feet = '$feet', inches = '$inches', calorie_goal = '$calorie_goal'  WHERE uid = $userid";
    $updatequery_run = mysqli_query($connection,$updatequery);
     if($updatequery_run){
       echo "<script>alert('Updated successfully...');
       window.location.href = 'profile.php';
       </script>";
     }
     else{
       echo "<script>alert('Update failed...{$errors} try again');
       window.location.href = 'edit_profile.php';
       </script>";
     }
     mysqli_close($connection);
  }
}

  if ($show_edit_form) {
?>


      <div class="col-md-8 m-auto block" id="main_content">
      <h2>Edit Profile</h2>
      <form action="" method="post">
      <div class="form-group form-group-position">
        <label>Username:</label>
        <input type="text" class="form-control" name="username" minlength="1" maxlength="32" value="<?php echo $username;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>First Name:</label>
        <input type="text" class="form-control" name="firstname" minlength="1" maxlength="64" value="<?php echo $firstname;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Last Name:</label>
        <input type="text" class="form-control" name="lastname" minlength="1" maxlength="64" value="<?php echo $lastname;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Email:</label>
        <input type="email" class="form-control" name="email" minlength="1" maxlength="128" value="<?php echo $email;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Password:</label>
        <input type="password" class="form-control" name="password" minlength="1" maxlength="64" value="<?php echo $password;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Age:</label>
        <input type="number" class="form-control" name="age" minlength="1" maxlength="3" value="<?php echo $age;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Weight (kg):</label>
        <input type="text" class="form-control" name="weight" minlength="1" maxlength="32" value="<?php echo $weight;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Feet (ft):</label>
        <input type="text" class="form-control" name="feet" minlength="1" maxlength="40" value="<?php echo $feet;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Inches:</label>
        <input type="text" class="form-control" name="inches" minlength="1" maxlength="2" value="<?php echo $inches;?>" required>
      </div>
      <div class="form-group form-group-position">
        <label>Calorie Goal:</label>
        <input type="text" class="form-control" name="calorie_goal" minlength="1" maxlength="5" value="<?php echo $calorie_goal;?>" required>
      </div><br>
      <button type="submit" name="post" class="btn btn-success">Update</button>
      </form>
      </div>
    </div>
    </section>
<?php
  }
include 'footer.php';
?>

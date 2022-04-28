<?php
include 'header.php';
include 'verify.php';
if(!isset($_SESSION['uid']))
{
  echo 'You are being redirected to the home page!';
  header("Location:index.php");
}
else
{
  $uid=$_SESSION['uid'];
}

if(isset($_POST['post'])){
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  $date=date("Y-m-d H:i:s");
  $food = $_POST['food'];
  $calories = $_POST['calorie_intake'];
  $exercise = $_POST['exercise'];
  $calories_burnt = $_POST['calories_burnt'];

  $food = sanitise($food,$connection);
  $calories = sanitise($calories,$connection);
  $exercise = sanitise($exercise,$connection);
  $calories_burnt = sanitise($calories_burnt,$connection);
  $error1 = validateString($food, 1, 120);
  $error2 = validateString($calories, 1, 800);
  $error3 = validateString($exercise, 1, 120);
  $error4 = validateString($calories_burnt, 1, 800);
  $errors = $error1.$error2.$error3.$error4;
  
  if (!$errors) {
    $query = "INSERT INTO calories (uid, food, calorie_intake, exercise, calories_burnt, datetime) VALUES('$uid','$food','$calories','$exercise','$calories_burnt','$date')";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('Posted successfully...');
      window.location.href = 'profile.php';
      </script>";
    }
    else{
      echo "<script>alert('Post failed...{$errors} try again');
      window.location.href = 'calorieupdate.php';
      </script>";
    }
    mysqli_close($connection);
  }
}
include 'footer.php';
?>
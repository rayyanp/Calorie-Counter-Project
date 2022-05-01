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
  $meal = $_POST['meal'];
  $food = $_POST['food'];
  $calories = $_POST['calorie_intake'];

  $meal = sanitise($meal,$connection);
  $food = sanitise($food,$connection);
  $calories = sanitise($calories,$connection);
  $error1 = validateString($meal, 1, 120);
  $error2 = validateString($food, 1, 120);
  $error3 = validateString($calories, 1, 800);
  $errors = $error1.$error2;
  
  if (!$errors) {
    $query = "INSERT INTO calories (uid, food, meal, calorie_intake, datetime) VALUES('$uid','$food','$meal','$calories','$date')";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('You have added your calories successfully!');
      window.location.href = 'diary.php';
      </script>";
    }
    else{
      echo "<script>alert('Post failed...{$errors} try again');
      window.location.href = 'diary.php';
      </script>";
    }
    mysqli_close($connection);
  }
}
include 'footer.php';
?>
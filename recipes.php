<?php
  include 'header.php';
  include 'verify.php';
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
    if(!isset($_SESSION['uid']))
    {
    echo 'You are being redirected to the home page!';
    header("Location:index.php");
    }
    else
    {
    $uid=$_SESSION['uid'];
    }

echo <<<RECIPES
    <h3>Recipe Categories</h3><br>
    <p>API link to be added here<p>
    
    <div class="divider">
    </div>

RECIPES;

include 'footer.php';
?>
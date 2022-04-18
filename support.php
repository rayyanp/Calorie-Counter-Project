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

echo <<<SUPPORT
  <div class="container" id="support">
    <label>Add Support for your Fitness Journey</label>
    <h6><i>Adding Support for your Fitness Journey will allow that supportive person to view your 
    information. Ensure you know, and trust, the person you are sharing this information with</i></h6>
    
        
    <div class="expand" id="supportToggle">
      <div class="test">
          <a href='#!' class='enterData'><i class="fa-solid fa-circle-plus"></i></a><br>  
      </div>
  </div>

  </div>
    
  <div class="divider">
  </div>
SUPPORT;

include 'footer.php';
?>
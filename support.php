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

    if(isset($_POST['post'])){
      $n= $_POST['n'];
      $support= $_POST['support'];
      $query = "SELECT * FROM users WHERE '$n' = '$support'  ";
      $query_run = mysqli_query($connection,$query);
      $r = mysqli_num_rows($query_run);
      if($query_run){
        if ($r>0){
          $data = $query_run['username'];
        }
      }
      mysqli_close($connection);
  }

echo <<<SUPPORT
  <div class="container" id="support">
    <label>Add Support for your Fitness Journey</label>
    <h6><i>Adding Support for your Fitness Journey will allow that supportive person to view your 
    information. Ensure you know, and trust, the person you are sharing this information with</i></h6>
    
        
    <div class="expand" id="supportToggle">
      <div class="test">
          <button onclick="chooseInput()" class='enterData'><i class="fa-solid fa-circle-plus"></i></button><br>  
      </div>
  </div>


  <div id="chooseInput" style="display:none";>
    <button type="button" class="btn btn-outline-primary" onclick="inputSupport()" id="addSupport">Add Support</button>
  </div>

  <div id="inputSupport" style="display:none";>
                <hr>
                <div class="row">
                        <label>Support:</label>
                    <form action="" method="post">
                        <input type="text" name="support" placeholder="Find Support">

                        <select name="n" id="weight">
                            <option value="" selected disabled hidden>Select type</option>
                            <option value="email">Email</option>
                            <option value="username">Username</option>
                        </select>
                </div>

                <hr>
                
                <span><button type="submit" name="post" onclick="resultsSupport()" class="btn btn-primary" style="width: 100%;">Submit</button></span>
            </form>
            </div>
  </div>

  <div id="resultsSupport" style="display:none";>
  <hr>
  <div class="row">
SUPPORT;
  if (isset($data)){
          "<label>$data</label>";
  }
echo <<<SUPPORT
      <form action="" method="post">
  </div>

  <hr>
  
  <span><button type="submit" name="post" onclick="resultsSupport()" class="btn btn-primary" style="width: 100%;">Submit</button></span>
</form>
</div>
</div>
  <div class="divider">
  </div>
SUPPORT;

include 'footer.php';
?>
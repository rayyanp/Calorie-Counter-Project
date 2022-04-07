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

if(isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM calories ORDER BY datetime ASC";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM calories ORDER BY datetime DESC";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM calories";
        $result = executeQuery($default_query);
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="mentor_profile.php">Mentor Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="mentor_view_data.php">View Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mentor_share_experience.php">Experience</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sign_out.php">Sign Out</a>
      </li>
    </ul>
  </div>
</nav>
    
    <div class="col-md-8 m-auto block" id="main_content">
    <h3>View Data</h3><br>
      <form action="history.php" method="post">
        <input type="submit" class = "btn btn-info" name="ASC" value="Ascending">
        <input type="submit" class = "btn btn-info" name="DESC" value="Descending"><br><br>
    <table class="table-main">
    <tr>
      <th>Food</th>
      <th>Calorie Intake</th>
      <th>Exercise</th>
      <th>Calories Burnt</th>
      <th>Date</th>
    </tr>
<?php
function executeQuery($query)
{
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"caloriecounter");
    $result = mysqli_query($connection, $query);
    return $result;
}
while($row = mysqli_fetch_assoc($result)){
  ?> 
<tr>
    <td><?php echo $row['food'];?></td>
    <td><?php echo $row['calorie_intake'];?></td>
    <td><?php echo $row['exercise'];?></td>
    <td><?php echo $row['calories_burnt'];?></td>
    <td>Date:<?php echo $row['datetime'];?></td>
</tr>
  <?php
}
?>
      </table>
      </form>
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>


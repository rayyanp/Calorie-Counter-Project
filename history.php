<?php
include 'header.php';
include 'verify.php';
include 'profilenavbar.php';
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
    $asc_query = "SELECT * FROM calories WHERE uid = $uid ORDER BY cid ASC AND date(datetime) = curdate()";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM calories WHERE uid = $uid ORDER BY cid DESC AND date(datetime) = curdate()";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM calories WHERE uid = $uid AND date(datetime) = curdate()";
        $result = executeQuery($default_query);
}
?>
      <h3>Today</h3><br>
        <div class="col-md-8 m-auto block" id="main_content">
      <h3>Add your calories</h3><br>
        <form action="calorieupdate.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-sm-12">
              <label for="inputFood" class="col-sm-12">What did you eat?</label>
              </div>
          </div>
              <div class="form-group">
              <div class="col-sm-4 col-sm-offset-4">
                  <input type="text" class="form-control" id="inputFood" placeholder="Title" name="food">
              </div>
          </div>
          
          <div class="form-group">
          <div class="col-sm-12">
              <label for="inputCal" class="col-sm-12">How many calories?</label>
              </div>
          </div>
          <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5">
            <input type="text" class="form-control" id="inputCal" placeholder="Total" name="calorie_intake">
            </div>
          </div>

          <div class="form-group">
          <div class="col-sm-12">
              <label for="inputFood" class="col-sm-12">What exercise did you do?</label>
              </div>
          </div>
              <div class="form-group">
              <div class="col-sm-4 col-sm-offset-4">
                  <input type="text" class="form-control" id="inputFood" placeholder="Title" name="exercise">
              </div>
          </div>
          
          <div class="form-group">
          <div class="col-sm-12">
              <label for="inputCal" class="col-sm-12">How many calories were burnt?</label>
              </div>
          </div>
          <div class="form-group">
          <div class="col-sm-2 col-sm-offset-5">
            <input type="text" class="form-control" id="inputCal" placeholder="Total" name="calories_burnt">
            </div>
          </div><br>
            <button class="btn btn-success" type="submit" name="post">Submit</button>
        </form>
      </div> 
    </div><br>
    
    <div class="col-md-8 m-auto block" id="main_content">
    <h3>Todays calories</h3><br>
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



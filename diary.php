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
//insert loop for days

//Current day
if(isset($_POST['plus']))
{
  $plus_query = "SELECT meal,food,calorie_intake, CAST(datetime as time) AS 'Time' FROM calories WHERE uid = $uid AND date(datetime) = curdate();";
  $result = executeQuery($plus_query);
}

// Previous day
elseif (isset ($_POST['minus'])) 
{
  $minus_query = "SELECT meal,food,calorie_intake, CAST(datetime as time) AS 'Time' FROM calories WHERE uid = $uid AND date(datetime) = curdate()-1;";
  $result = executeQuery($minus_query);
}

//Current day
else 
{
  $default_query = "SELECT meal,food,calorie_intake, CAST(datetime as time) AS 'Time' FROM calories WHERE uid = $uid AND date(datetime) = curdate();";
  $result = executeQuery($default_query);
}
?>
      <h3><center>Diary<center></h3><br>
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
          </div><br>
            <button class="btn btn-outline-primary" type="submit" name="post">Add</button>
        </form>
      </div> 
    </div><br>
    <div class="col-md-8 m-auto block" id="main_content">
      <form action="diary.php" method="post">
      <input type="submit" class = "btn btn-outline-primary" name="minus" value="Previous Day">
      <input type="submit" class = "btn btn-outline-primary" name="plus" value="Current Day">
    <table class="table-main">
    <tr>
      <th>Meal</th>
      <th>Food</th>
      <th>Calories</th>
      <th>Time</th>
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
    <td><?php echo $row['meal'];?></td>
    <td><?php echo $row['food'];?></td>
    <td><?php echo $row['calorie_intake'];?></td>
    <td><?php echo $row['Time'];?></td>
</tr>
  <?php
}
?>
      </table>
      </form>
    </div>
  </div>
</section>
    
    <div class="divider">
    </div>
<?php
include 'footer.php';
?>



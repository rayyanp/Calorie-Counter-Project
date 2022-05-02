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
echo <<<DIARY
  <div class="container" id="main_content">

    <h3>Manage your Calories</h3>

    <label>Add today's calories</label><br><br>

    <form action="calorieupdate.php" method="post" enctype="multipart/form-data">
      
      <div class="row">

        <div class="col-3">
          <select name="meal" id="meal" required>
            <option value="" selected disabled hidden>Select Meal</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
            <option value="Snack">Snack</option>
          </select>
        </div>

        <div class="col-4">
          <input type="text"id="inputFood" placeholder="Food" name="food" required>
        </div>

        <div class="col-2">
          <input type="text"id="inputCal" placeholder="Calories" name="calorie_intake" required>
        </div>

      </div><br>

      <span><button type="submit" name="post" class="btn btn-primary" style="width: 100%;">Add</button></span>

    </form>

    <hr>

    <label>Review calorie intake</label><br><br>

    <form action="diary.php" method="post">
      <div class="row">
        <div class="col">
          <button type="submit" name="minus" class="btn btn-outline-primary">Previous Day</button>
        </div>
        <div class="col">
          <button type="submit" name="plus" class="btn btn-outline-primary">Current Day</button>
        </div>
        <div class="col">
          <button type="submit" name="plus" class="btn btn-outline-primary">Next Day</button>
        </div>
      </div>

      <hr>

      <table class="table-main">
        <tr>
          <th>Meal</th>
          <th>Food</th>
          <th>Calories</th>
          <th>Time</th>
        </tr>
DIARY;
function executeQuery($query) {
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"caloriecounter");
    $result = mysqli_query($connection, $query);
    return $result;
}
while($row = mysqli_fetch_assoc($result)) {

  echo <<<DIARY
        <tr>
          <td>{$row['meal']}</td>
          <td>{$row['food']}</td>
          <td>{$row['calorie_intake']}</td>
          <td>{$row['Time']}</td>
        </tr>
  DIARY;
}
echo <<<DIARY
      </table>
    </form>
  </div>
    
  <div class="divider">
  </div>
  
DIARY;

include 'footer.php';
?>



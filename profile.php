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

    include 'profilenavbar.php';
?>
<?php

    $sql2 = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
    $sql2_result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));


    while ($row = mysqli_fetch_assoc($sql2_result)) {
        $username = $row['username'];
        $feet     = $row['feet'];
        $inches   = $row['inches'];
        $weight   = $row['weight'];
    }
    ;
    $bmi1 = $weight / 2.2;
    $bmi2 = (($feet * 12) + $inches) / 39.37;
    $bmi2 = $bmi2 * $bmi2;
    $bmi1 = $bmi1 / $bmi2;


    $sql3 = "SELECT SUM(calorie_intake) as 'TotalCal' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()";
    $sql3_result = mysqli_query($connection, $sql3) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql3_result)) {
        $totalCal = $row['TotalCal'];
    }
    ;

    $sql4 = "SELECT SUM(calories_burnt) as 'TotalCalBurnt' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()";
    $sql4_result = mysqli_query($connection, $sql4) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql4_result)) {
        $totalCalBurnt = $row['TotalCalBurnt'];
    }
    ;

    $sql5 = "SELECT (SUM(calorie_intake) + SUM(calories_burnt)) as 'Total' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()";
    $sql5_result = mysqli_query($connection, $sql5) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql5_result)) {
        $total = $row['Total'];
    }
    ;

    $sql6 = "SELECT calorie_goal as 'calorie_goal' FROM users WHERE uid = '$uid'";
    $sql6_result = mysqli_query($connection, $sql6) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql6_result)) {
        $calorie_goal= $row['calorie_goal'];
    }
    ;

    $remaining = $calorie_goal - $total;
?> 

        <div id="info" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Welcome <?php echo $username?></h1>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-4">
                <div id="stats-info">
                <div class="col-sm-6 inner-info">
                    <h2>Height</h2>
                    <h3><?php echo $feet."'".$inches."\""?>
                    </h3>
                </div>
                <div class="col-sm-6 inner-info">
                    <h2>Weight</h2>
                    <h3><?php echo $weight." kg"?>
                    </h3>
                </div>
                </div>
                </div>
                <div class="col-xs-4">
                <div id="bmi-info">
                <div class="col-sm-6 inner-info">
                    <h2>BMI</h2>
                    <h3><?php echo number_format($bmi1,2)?>
                    </h3>
                </div>
                <div id="testt" class="col-sm-6 inner-info">
                <p>Underweight: 0 to 19</p>
                    <p>Healthy: 19 to 24.9</p>
                    <p>Overweight: 25 to 29.9</p>
                    <p>Obese: 30 and above</p>
                </div>
                </div>
                </div>
                <div class="col-xs-4">
                <div id="calories-info">
                <div class="col-sm-12 inner-info">
        <h4>Your Calorie Goal:</h4>
                    <h4><?php echo $calorie_goal?>
                    </h4>
                </div>
                <div class="col-sm-12 inner-info">
        <h4>Today's Calorie Intake:</h4>
                    <h4><?php echo $totalCal?>
                    </h4>
                </div>
                <div class="col-sm-12 inner-info">
        <h4>Today's Calories burnt:</h4>
                    <h4><?php echo $totalCalBurnt?>
                    </h4>
                </div>
                <div class="col-sm-12 inner-info">
        <h4>Today's Calories:</h4>
                    <h4><?php echo $total?>
                    </h4>
                </div>
                <div class="col-sm-12 inner-info">
        <h4>Remaining Calories to reach your goal:</h4>
                    <h4><?php echo $remaining?>
                    </h4>
                </div>
                </div>
                </div>
            </div>
            
        </div>
        

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
          </div>
            <button class="btn btn-success" type="submit" name="post">Post</button>
        </form>
      </div> 
    </div>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <div class="content"> -->
                    <form action="historyOut.php" method="post" id="histForm" class="form-horizontal hide" onsubmit="return HistoryValidationEvent()">

                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($uid); ?>">

                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="dateStart" class="col-sm-12">Enter the date you want to view history through or select today.</label>
                        </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">

                                <select name="hmonth" id="dateStart">
                                    <option selected value="0">-----</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sept</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>

                                <select name="hday" id="day">
                                    <option selected value="0">----</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>

                                <select id="year" name="hyear">
                                    <option value=0 selected>----</option>
                                    <option value="2022">2022</option>
                                    </option>
                                </select>
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
            <input type="checkbox" value="1" name="today">Today
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                    <!-- </div> -->
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
</body>

</html>

<?php
include 'header.php';

if(isset($_SESSION['username'])) {
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
?>
<?php

    $sql2 = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
    $sql2_result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));


    while ($row = mysqli_fetch_assoc($sql2_result)) {
        $fname    = $row['firstname'];
        $lname    = $row['lastname'];
        $username = $row['username'];
        $email    = $row['email'];
        $password = $row['password'];
        $age      = $row['age'];
        $feet     = $row['feet'];
        $inches   = $row['inches'];
        $weight   = $row['weight'];
    }
    ;


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

    $sql5 = "SELECT (SUM(calorie_intake) - SUM(calories_burnt)) as 'Total' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()";
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
<?php   

echo <<<ME

<div class="container" id="Me">
    <div class="container" id="MeHeader">

        <span class="progressDonut"
            style="--percentage : 48;">
            <label>Progress: 48%</label>
        </span>

        <div class="row">
            <div class="col"><br>
                <label>Current Weight: {$weight}</label>
            </div>
            <div class="col"><br>
                <label>Goal Weight:    ___ </label>
            </div>
        </div>

    </div>

    <hr>
    <fieldset>
        <div class="container" id="MeEdit">
            <div class="row">

                <div class="col">
                    <label>First Name:</label><br>
                    <label>Last Name:</label><br>
                    <label>Username:</label><br>
                    <label>Email:</label><br>
                    <label>Password:</label><br>
                    <label>Age:</label><br>
                </div> 

                <div class="col">
                    <div class="edit">
                        <div class="myInfo">
                            <input type="text" name="name" value={$fname}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                            <input type="text" name="name" value={$lname}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                            <input type="text" name="username" value={$username}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                            <input type="email" name="email" value={$email}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                            <input type="password" name="password" value={$password}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                            <input type="number" name="age" value={$age}>
                            <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                        </div>
                    </div>
                </div>

            </div>

            <hr>
            
            <div class="row">

                <div class="col">
                    <label>Weight:</label><br>
                </div> 

                <div class="col">
                    <input type="number" name="weight" value={$weight}><br>
                </div>

                <div class="col">
                    <select name="unit" id="weight">
                        <option value="kg">kg</option>
                        <option value="lb">lb</option>
                    </select>
                </div>

            </div>
            
            <div class="row">

                <div class="col">
                    <label>Goal Weight:</label><br>
                </div> 

                <div class="col">
                    <input type="number" name="weight" value={$weight}><br>
                </div>

                <div class="col">
                </div>

            </div>
            
            <div class="row">

                <div class="col">
                    <label>Height:</label><br>
                </div> 

                <div class="col">
                    <input type="number" name="height" value="183"><br>
                </div>

                <div class="col">
                    <select name="unit" id="height">
                        <option value="cm">cm</option>
                        <option value="ft">Feet/Inches</option>
                    </select>
                </div>

            </div>

        <hr>
        
    </fieldset>
</div>

ME;

?>
        <div id="info" class="container">
            
            <div class="row">
                <div class="col-xs-4">
                <div id="stats-info">
                <div class="col-sm-6 inner-info">
                    <h2>Height</h2>
                    <?php echo $feet."'".$inches."\""?>
                    
                </div>
                </div>
                </div>
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
    <div class="divider">
    </div>
<?php       
} 
include 'footer.php';
?>
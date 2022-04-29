<?php

require_once "header.php";

if(isset($_SESSION['username'])) {
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

    if(isset($_POST['POST'])){
        $current_weight = $_POST['current_weight'];
        $unit1 = $_POST['unit1'];
        
        $updatequery = "UPDATE users SET current_weight = '$current_weight', unit1 = '$unit1' WHERE uid = $uid";
        $updatequery_run = mysqli_query($connection,$updatequery);
         if($updatequery_run){
           echo "<script>alert('Updated successfully...');
           window.location.href = 'home.php';
           </script>";
         }
         else{
           echo "<script>alert('Update failed...{$errors} try again');
           window.location.href = 'home.php';
           </script>";
         }
         mysqli_close($connection);
    }
    $sql = "SELECT * FROM calories WHERE uid = '$_SESSION[uid]'";
    $sql_result = mysqli_query($connection, $sql) or die(mysqli_error($connection));


    while ($row = mysqli_fetch_assoc($sql_result)) {
        $datetime = $row['datetime'];
    }
    ;

    $sql1 = "SELECT SUM(calorie_intake) as 'TotalCalMon' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate() -4";
    $sql1_result = mysqli_query($connection, $sql1) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql1_result)) {
        $totalCalMon = $row['TotalCalMon'];
    }
    ;

    $sql2 = "SELECT SUM(calorie_intake) as 'TotalCalTues' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate() -3";
    $sql2_result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql2_result)) {
        $totalCalTues = $row['TotalCalTues'];
    }
    ;

    $sql3 = "SELECT SUM(calorie_intake) as 'TotalCalWed' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()-2";
    $sql3_result = mysqli_query($connection, $sql3) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql3_result)) {
        $totalCalWed = $row['TotalCalWed'];
    }
    ;
    $sql4 = "SELECT SUM(calorie_intake) as 'TotalCalThurs' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate() -1";
    $sql4_result = mysqli_query($connection, $sql4) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql4_result)) {
        $totalCalThurs = $row['TotalCalThurs'];
    }
    ;
    $sql5 = "SELECT SUM(calorie_intake) as 'TotalCalFri' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate()";
    $sql5_result = mysqli_query($connection, $sql5) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql5_result)) {
        $totalCalFri = $row['TotalCalFri'];
    }
    ;
    $sql6 = "SELECT SUM(calorie_intake) as 'TotalCalSat' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate() -6";
    $sql6_result = mysqli_query($connection, $sql6) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql6_result)) {
        $totalCalSat = $row['TotalCalSat'];
    }
    ;
    $sql7 = "SELECT SUM(calorie_intake) as 'TotalCalSun' FROM calories WHERE uid = '$uid' AND date(datetime) = curdate() -5";
    $sql7_result = mysqli_query($connection, $sql7) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql7_result)) {
        $totalCalSun = $row['TotalCalSun'];
    }
    ;

    if(isset($_POST['post'])){
        $date=date("Y-m-d H:i:s");
        $food = $_POST['food'];
        $meal = $_POST['meal'];
        $calories = $_POST['calorie_intake'];

        $query = "INSERT INTO calories (uid, food, meal, calorie_intake, datetime) VALUES('$uid','$food','$meal','$calories','$date')";
        $query_run = mysqli_query($connection,$query);
        if($query_run){
        echo "<script>alert('Posted successfully...');
        window.location.href = 'home.php';
        </script>";
        }
        else{
        echo "<script>alert('Post failed...{$errors} try again');
        window.location.href = 'home.php';
        </script>";
        }
        mysqli_close($connection);
    }
    echo <<<HOME
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>



        <div class="container" id="home">

            <label>Weekly Calorie Table</label>

            <canvas id="myChart" style="width:100%;max-width:505px"></canvas>
            
            <script>
            var xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            var yValues = [$totalCalMon, $totalCalTues, $totalCalWed, $totalCalThurs, $totalCalFri, $totalCalSat, $totalCalSun];
            var barColors = ["#14BCFF", "#14BCFF","#14BCFF","#14BCFF","#14BCFF","#14BCFF","#14BCFF"];
            
            new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {display: false},
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0
                        }
                    }]
                }
            }
            });
            </script>
            
            <div class="expand" id="homeToggle">
                <div class="test">
                    <a class="enterData" onclick="chooseInput()" href="#"><i class="fa-solid fa-circle-plus"></i></a><br>  
                </div>
            </div>

            <div id="chooseInput" style="display:none";>
                <button type="button" class="btn btn-outline-primary" onclick="inputWeight()" id="addWeight">Add Today's Weight</button>
                <button type="button" class="btn btn-outline-primary" onclick="inputMeal()" id="addMeal">Add Meal</button>
            </div>

            <div id="inputWeight" style="display:none";>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <label>Today's Weight:</label>
                    </div>
                    <form action="" method="POST">
                    <div class="col-5"> 
                        <input type="number" name="current_weight" placeholder="Today's Weight"><br>
                    </div>

                    <div class="col-3">
                        <select name="unit1" id="weight">
                            <option value="kg">kg</option>
                            <option value="lb">lb</option>
                        </select>
                    </div>
                </div>

                <hr>
                
                <span><button type="submit" name="POST" class="btn btn-primary" style="width: 100%;">Submit</button></span>
            </form>
            </div>


            <div id="inputMeal" style="display:none";>
                <hr>
                <div class="row">
                <form action="" method="post">
                    <div class="col-3">
                        <select name="meal" id="meal">
                            <option value="" selected disabled hidden>Select Meal</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <input type="text" name="food" placeholder="Food 1"><br>
                        <input type="text" name="food" placeholder="Food 2"><br>
                        <input type="text" name="food" placeholder="Food 3"><br>
                        <input type="text" name="food" placeholder="Food 4"><br>
                    </div>

                    <div class="col-4">
                        <input type="text" name="calorie_intake" placeholder="Calorie 1"><br>
                        <input type="text" name="calorie_intake" placeholder="Calorie 2"><br>
                        <input type="text" name="calorie_intake" placeholder="Calorie 3"><br>
                        <input type="text" name="calorie_intake" placeholder="Calorie 4"><br>
                    </div>
                </div>

                <hr>
                
                <span><button type="submit" name="post" class="btn btn-primary" style="width: 100%;">Submit</button></span>
                </form>
            </div>
        </div>
        
        <div class="divider">
        </div>

        
    HOME;
}
require_once "footer.php";
?>
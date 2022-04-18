<?php

require_once "header.php";

if(isset($_SESSION['username'])) {
    echo <<<HOME
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>



        <div class="container" id="home">

            <label>Weekly Calorie Table</label>

            <canvas id="myChart" style="width:100%;max-width:505px"></canvas>
            
            <script>
            var xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
            var yValues = [2200, 2100, 2300, 2300, 2500, 2600, 900];
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

                    <div class="col-5"> 
                        <input type="number" name="weight" placeholder="Today's Weight"><br>
                    </div>

                    <div class="col-3">
                        <select name="unit" id="weight">
                            <option value="kg">kg</option>
                            <option value="lb">lb</option>
                        </select>
                    </div>
                </div>

                <hr>
                
                <span><button type="button" class="btn btn-primary" style="width: 100%;">Submit</button></span>
            </div>

            <div id="inputMeal" style="display:none";>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <select name="meal" id="meal">
                            <option value="" selected disabled hidden>Select Meal</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="breakfast">Lunch</option>
                            <option value="breakfast">Dinner</option>
                            <option value="breakfast">Snack</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <input type="text" name="name" placeholder="Food 1"><br>
                        <input type="text" name="name" placeholder="Food 2"><br>
                        <input type="text" name="name" placeholder="Food 3"><br>
                        <input type="text" name="name" placeholder="Food 4"><br>
                    </div>

                    <div class="col-4">
                        <input type="text" name="name" placeholder="Calorie 1"><br>
                        <input type="text" name="name" placeholder="Calorie 2"><br>
                        <input type="text" name="name" placeholder="Calorie 3"><br>
                        <input type="text" name="name" placeholder="Calorie 4"><br>
                    </div>
                </div>

                <hr>
                
                <span><button type="button" class="btn btn-primary" style="width: 100%;">Submit</button></span>
            </div>
        </div>
        
        <div class="divider">
        </div>

        
    HOME;
}
require_once "footer.php";
?>
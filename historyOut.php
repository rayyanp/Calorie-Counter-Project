<?php 

include "header.php";

?>

        <?php
            $connection = mysqli_connect("localhost","root","");
            $db = mysqli_select_db($connection,"caloriecounter");
		// define variables and set to empty values
		$hName = $hmonth = $hday = $hyear = "";
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    $hName = test_input($_POST["username"]);
		    $hmonth = test_input($_POST["hmonth"]);
		    $hday = test_input($_POST["hday"]);
		    $hyear = test_input($_POST["hyear"]);
		    $today = test_input($_POST["today"]);
		    
		    $date = $hyear . "-" . $hmonth . "-" . $hday . " " . "00:00:00";
		    
		     echo '<div id="info" class="container">
					      <div class="row">
					        <div class="col-lg-12">';
					        
		    if((($hmonth == 0 || $hday == 0 || $hyear == 0) && $today == 0) || (($hmonth != 0 || $hday != 0 || $hyear != 0)) && $today == 1){
		    
		 	echo "<h3>You either didn't select any date, didn't complete it or tried selecting a date and today.</h3><br><br>";
		 	echo "<a class='btn btn-info' href='profile.php'>Go Back</a>";

		    }
		    else {
		   
		    $sql1 = "SELECT datetime, food, calorie_intake FROM calories WHERE uid = '$hName' AND date(datetime) BETWEEN '$date' AND NOW()";
		    $result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
		    
		    $sql2 = "SELECT datetime, food, calorie_intake FROM calories WHERE uid = '$hName' AND date(datetime) = curdate()";
		    $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
		    
		    echo "<table class='table table-bordered'>
		      		<tr class='tableHead'>
		      			<th class='tableHead'>Date</th>
		      			<th class='tableHead'>Food</th>
		      			<th class='tableHead'>Calories</th>
		      		</tr>";
			
		 
		    if($today == 1) {
		    
		    while ($row = mysqli_fetch_assoc($result2)) {
		        echo "<tr class='info'>";
		        $date = date_create($row['datetime']);
		        echo "<td class='tableRow'>" . date_format($date, "l, F jS") . "</td>";
		        echo "<td class='tableRow'>" . $row['food'] . "</td>";
		        echo "<td class='tableRow'>" . $row['calorie_intake'] . "</td>";
		        echo "</tr>";
		        }
		   
	    
		    } else {
		    
		    
		    while ($row = mysqli_fetch_assoc($result1)) {
		        echo "<tr class='info'>";
		        $date = date_create($row['datetime']);
		        echo "<td>" . date_format($date, "l, F jS") . "</td>";;
		        echo "<td>" . $row['food'] . "</td>";
		        echo "<td>" . $row['calorie_intake'] . "</td>";
		        echo "</tr>";
		    }
		  
		}
		
		 echo "</table>";
			echo "<a class='btn btn-info' href='profile.php'>Return Home</a>";
		}
		
		echo '</div>
					      </div>
					    </div>';
					    
		}
		
		
		function test_input($data) {
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    return $data;
		}
	?>  
	

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>

    </html>
    
    
    
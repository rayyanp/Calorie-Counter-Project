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

    $sql2 = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
    $sql2_result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));


    while ($row = mysqli_fetch_assoc($sql2_result)) {
        $firstname    = $row['firstname'];
        $lastname    = $row['lastname'];
        $username = $row['username'];
        $email    = $row['email'];
        $password = $row['password'];
        $age      = $row['age'];
        $gender      = $row['gender'];
        $height    = $row['height'];
        $start_weight   = $row['start_weight'];
        $current_weight   = $row['current_weight'];
        $goal_weight   = $row['goal_weight'];
        $unit1 = $row['unit1'];
        $unit2 = $row['unit2'];
    }
    ;
    $userid =$_SESSION['uid'];
    if(isset($_POST['post'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

 

        $updatequery = "UPDATE users SET username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', password = '$password', age = '$age', gender = '$gender'  WHERE uid = $userid";
        $updatequery_run = mysqli_query($connection,$updatequery);
         if($updatequery_run){
           echo "<script>alert('Updated successfully...');
           window.location.href = 'me.php';
           </script>";
         }
         else{
           echo "<script>alert('Update failed...{$errors} try again');
           window.location.href = 'me.php';
           </script>";
         }
         mysqli_close($connection);
    }

    if(isset($_POST['postw'])){
        $current_weight = $_POST['current_weight'];
        $goal_weight = $_POST['goal_weight'];
        $unit1 = $_POST['unit1'];
        $unit2 = $_POST['unit2'];

        $updatequery = "UPDATE users SET current_weight = '$current_weight', goal_weight = '$goal_weight', unit1 = '$unit1', unit2 = '$unit2'   WHERE uid = $userid";
        $updatequery_run = mysqli_query($connection,$updatequery);
         if($updatequery_run){
           echo "<script>alert('Updated successfully...');
           window.location.href = 'me.php';
           </script>";
         }
         else{
           echo "<script>alert('Update failed...{$errors} try again');
           window.location.href = 'me.php';
           </script>";
         }
         mysqli_close($connection);
    }

    $x = $start_weight-$goal_weight;
    $y = $start_weight-$current_weight;
    $z = $y / $x;
    $progress = round($z * 100,0);

    $kg = 'kg';
    $lb = 'lb';

    

?>  

<?php   

echo <<<ME

<div class="container" id="Me">
    <div class="container" id="MeHeader">

        <span class="progressDonut"
            style="--percentage : $progress;">
            <label>Progress: $progress%</label>
        </span>

        <div class="row">
            <div class="col"><br>
                <label>Current Weight: {$current_weight} {$unit1}</label>
            </div>
            <div class="col"><br>
                <label>Goal Weight: {$goal_weight} {$unit1}</label>
            </div>
        </div>

    </div>

    <hr>
    <fieldset>
        <div class="container" id="MeEdit">
            <form action="" method="post">
                <div class="row">

                    <div class="col">
                        <label>First Name:</label><br>
                        <label>Last Name:</label><br>
                        <label>Username:</label><br>
                        <label>Email:</label><br>
                        <label>Password:</label><br>
                        <label>Age:</label><br>
                        <label>Gender:</label><br>
                    </div> 

                    <div class="col">
                        <div class="edit">
                            <div class="myInfo">
                                    <input type="text" name="firstname" value={$firstname}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <input type="text" name="lastname" value={$lastname}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <input type="text" name="username" value={$username}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <input type="email" name="email" value={$email}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <input type="password" name="password" value={$password}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <input type="number" name="age" value={$age}>
                                    <a href='#!' class='password-visibility'><i class='fa fa-pencil'></i></a><br>
                                    <select name="gender" id="gender">
                                        <option value="" selected disabled hidden>{$gender}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <br><br>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <button type="submit" name="post" class="btn btn-primary" width=100%>Update</button>
                    </div>
                </form>
            </div>

            <br><hr><br>

            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <label>Weight:</label><br>
                    </div> 

                    <div class="col">
                        <input type="number" name="current_weight" value={$current_weight}><br>
                    </div>

                    <div class="col">
                        <select name="unit1" id="weight">
                            <option value="$kg">kg</option>
                            <option value="$lb">lb</option>
                        </select>
                    </div>

                </div>
                
                <div class="row">

                    <div class="col">
                        <label>Goal Weight:</label><br>
                    </div> 

                    <div class="col">
                        <input type="number" name="goal_weight" value={$goal_weight}><br>
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
                        <select name="unit2" id="height">
                            <option value="cm">cm</option>
                            <option value="ft">Feet/Inches</option>
                        </select>
                    </div><br><br>

                </div>
                <div class="row">
                    <br><button type="submit" name="postw" class="btn btn-primary" width=100%>Update</button>
                </div>
            </form>
        
    </fieldset>
</div>
<div class="divider">
</div>

ME; 
} 
include 'footer.php';
?>

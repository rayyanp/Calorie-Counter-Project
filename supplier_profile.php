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
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="supplier_profile.php">Supplier Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="supplier_view_data.php">View Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sign_out.php">Sign Out</a>
      </li>
    </ul>
  </div>
</nav>

<?php

    $sql2 = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
    $sql2_result = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($sql2_result)) {
        $username = $row['username'];
    }
    ;
?> 
<div id="info" class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Welcome <?php echo $username?></h1>
            <p>Insert charts and graphs below.</p>
        </div>
    </div>
</div>
            
<?php
include 'footer.php';
?>
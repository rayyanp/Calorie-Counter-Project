<?php
  include 'header.php';
  include 'verify.php';
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");

  if(!isset($_SESSION['uid'])) {
    echo 'You are being redirected to the home page!';
    header("Location:index.php");
  }
  else {
    $uid=$_SESSION['uid'];
  }

echo <<<RECIPES
    <h3>Recipe Categories</h3><br>
    <p>API link to be added here<p>
    
    <div class="divider">
    </div>

RECIPES;

echo "<div id='board'>";

  while ($row = $result->fetch_assoc()) {
    $author = "anonymous";

    if ($row['uid']) {
      $query2 = "SELECT firstname, lastname FROM users WHERE uid =" . $row['uid'] . ";";
      $author = mysqli_query($connection, $query2)->fetch_assoc()['firstname'];
      $author .= " " . mysqli_query($connection, $query2)->fetch_assoc()['lastname'];
    }

    $postID = $row['postid'];

    $image = "";
    if ($row['image']) {
      $image = $row['image'];
    }

    $title = $row['title'];
    $date = $row['created'];
    $content = $row['content'];

    $options = "<div class='options'></div>";
    if (isset($_SESSION["loggedIn"])) {
      if ($_SESSION["name"] == $author || $_SESSION["username"] == "admin") {
        $options = "<div class='options'>
          <form action='index.php' method='post'>
            <button class='fbutton' name='delete' value='$postID'><i class='delete fas fa-trash'></i></button>
            <button class='fbutton' name='edit' value='$postID'><i class='edit fas fa-pen id-1'></i></button>
          <form>
        </div>";
      }
    }

    if ((isset($_GET["show"]) and $_SESSION["name"] == $author) or !isset($_GET["show"])) {
      echo <<<CARD
      <div class="card">
        <div class="card-image" style="background-image:url($image)"></div>
        <div>
          <p class="card-date">$date</p>
          <h1 class="card-title scrollable">$title</h1>
        </div>

        <p class="card-text scrollable">$content</p>

        <div class="card-footer">
          <h1 class="label">- $author</h1>
          $options
        </div>
      </div>
      CARD;
    }
  }

echo "</div>";

include 'footer.php';
?>
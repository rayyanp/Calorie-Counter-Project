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

if(isset($_POST['ASC']))
{
    $asc_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid ORDER BY created ASC";
    $result = executeQuery($asc_query);
}

// Descending Order
elseif (isset ($_POST['DESC'])) 
    {
          $desc_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid ORDER BY created DESC";
          $result = executeQuery($desc_query);
    }
    
    // Default Order
 else {
        $default_query = "SELECT * FROM posts INNER JOIN users WHERE posts.uid = users.uid";
        $result = executeQuery($default_query);
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="mentor_profile.php">Mentor Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="mentor_view_data.php">View Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mentor_share_experience.php">Experience</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sign_out.php">Sign Out</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="col-md-8 m-auto block" id="main_content">
    <h3>Share your experience</h3><br>
      <form action="share_experience.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Title:</label>
          <input class="form-control" type="text" name="title" minlength="1" maxlength="120" placeholder="Enter your title" required>
        </div>
        <div class="form-group">
          <label>Content:</label>
          <textarea name="content" rows="8" cols="80" class="form-control" minlength="1" maxlength="800" placeholder="Type your message..." required></textarea>
        </div>
        <div class="form-group">
          <label>Upload Image:</label>
          <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
          <button class="btn btn-success" type="submit" name="post">Post</button>
      </form>
    </div> 
  </div>
    
    <div class="col-md-8 m-auto block" id="main_content">
    <h3>View content</h3><br>
      <form action="experience.php" method="post">
        <input type="submit" class = "btn btn-info" name="ASC" value="Ascending">
        <input type="submit" class = "btn btn-info" name="DESC" value="Descending"><br><br>
    <table class="table-main">
    <tr>
      <th>Title</th>
      <th>Content</th>
      <th>Images</th>
      <th>Created</th>
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
    <td><?php echo $row['title'];?></td>
    <td><?php echo $row['content'];?></td>
    <td><img src="<?php echo $row['image'];?>" class="img" width="100px" height="100px"></td>
    <td>Created:<?php echo $row['created'];?><br>By:<?php echo $row['firstname'];?><br><?php echo $row['username'];?></td>
</tr>
  <?php
}
?>
      </table>
      </form>
    </div>
  </div>
</section>
<?php
include 'footer.php';
?>
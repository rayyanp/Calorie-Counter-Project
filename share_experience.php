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

if(isset($_POST['post'])){
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  $date=date("Y-m-d H:i:s");
  $uid = $_SESSION['uid'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  $error3 = "";
  $target_file = "";

  $title = sanitise($title,$connection);
  $content = sanitise($content,$connection);
  $error1 = validateString($title, 1, 120);
  $error2 = validateString($content, 1, 800);

  if (isset($_FILES["fileToUpload"])&& $_FILES["fileToUpload"]["size"] > 1){
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
  
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
  
      // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

    $error3 = validateImage($imageFileType);
  }
  $errors = $error1.$error2.$error3;
  
  if (!$errors) {
    $query = "INSERT INTO posts (uid, title, created, content, image) VALUES($uid,'$title','$date','$content','$target_file')";
    $query_run = mysqli_query($connection,$query);
    if($query_run){
      echo "<script>alert('Posted successfully...');
      window.location.href = 'experience.php';
      </script>";
    }
    else{
      echo "<script>alert('Post failed...try again');
      window.location.href = 'experience.php';
      </script>";
    }
    mysqli_close($connection);
  }
  else
  {
    echo "<script>alert('Post failed... {$errors} Please fill at least the title and content and try again.');
    window.location.href = 'experience.php';
    </script>";
  }
}

include 'footer.php';
?>

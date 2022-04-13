<?php
echo <<<HEADER
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="edit_profile.php">Edit Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="diary.php">Diary</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="history.php">History</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="experience.php">Support</a>
    </li>
    <li class="nav-item active">
    <a class="nav-link" href="recipes.php">Recipes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="sign_out.php">Sign Out</a>
    </li>
    </ul>
  </div>
</nav>
HEADER;
?>
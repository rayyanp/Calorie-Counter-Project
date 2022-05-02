<?php
  require_once "header.php";
  $_SESSION = array();
  session_unset();
  session_destroy();
  header("Location: home.php");
 ?>

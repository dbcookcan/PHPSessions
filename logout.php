<?php
// logout.php
// David Cook
// Remove session variables and force new login.
  require('db.php');

  session_start();
  
  // Update the database logout time
  $result = mysqli_query($con,"UPDATE users SET logout=now() WHERE id=" . $_SESSION['id'] );
  
  // Cleanup and return to login page
  unset($_SESSION["id"]);
  unset($_SESSION["name"]);
  unset($_SESSION["email"]);
  unset($_SESSION["LAST_ACTIVITY"]);
  header("Location:login.php");

?>

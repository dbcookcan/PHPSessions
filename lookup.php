<!DOCTYPE html>
<?php
// lookup.php
// David Cook
// Main page, forces login if no session variable when called.
// Test for maintaining session variables and some CSS.

session_start();
include("config.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Lookup</title>
  </head>

    <body>
    <nav>
      <div class="heading">
        <h4><?php echo $appl; ?></h4> <i>User: <?php echo $_SESSION["name"]; ?></i><p>
      </div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="lookup.php">Lookup</a></li>
        <li><a href="update.php">Update</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="maint.php">Maintenance</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

    <?php include("debug_values.php"); ?>
    <?php include("updt_act_timer.php"); ?>  
    <div class="body-text"><h1>This is Lookup Page!</h1></div>
      This is some content on the page.

  </body>

</html>

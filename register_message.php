<?php

// register_message.php
// David Cook, 2022

// Message to user after registration

require('db.php');
include('config.php');
session_start();

?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="refresh" content="8;url=index.php" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Successful Registration</title>
</head>

<body>
    <nav>
      <div class="heading">
        <h4><?php echo $appl; ?></h4>
      </div>
      
      <!-- NO NAVIGATION MENU ON LOGIN PAGE. 
      <ul class="nav-links"> 
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="pages/about.html">About</a></li>
        <li><a href="pages/services.html">Services</a></li>
        <li><a href="pages/contact.html">Contact</a></li>
      </ul> -->
    </nav>

<br><br>
<div class="pop-message">
  <b>Thank you for registering!</b> <br>
  <i>Your account request will be reviewed by our administrators. You will be notified when it has been approved.</i>
</div>

</body>
</html>

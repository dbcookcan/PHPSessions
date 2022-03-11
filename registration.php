<?php

// registration.php
// David Cook, 2022
// Learning session management in php code.
//

  require('db.php');
  include('config.php');
  session_start();
  $message="";

  // Check if we are loading the 1st time, or we have POST data from a Submit
  if(strlen($_POST['user_name'])>0) {

        
      // Check if password & email are provided and double entries match.
      if((strlen($_POST['password'])>0) &&
         (strlen($_POST['email'])>0 ) &&
         ($_POST['password'] == $_POST['password2']) &&
         ($_POST['email'] == $_POST['email2'])) {

         // Define SQL cmd
         $sql="INSERT INTO users (username, password, email, last_ip) values ( '" .
                    $_POST['user_name'] . "', '" .
                    md5($_POST['password']) . "', '" .
                    $_POST['email'] . "', '" .
                    $_SERVER['REMOTE_ADDR'] . "')" ;


          // Execute SQL insert
          $result = mysqli_query($con,$sql);
          
          // Was insert successful?
          if(strlen($result)>0) {
             $message = "UPDATING";
             header("Location:register_message.php");

          } else {
             $message = "Could not add account. Posssibly exists already.";
          } // End: insert
          
      } // End: dbl entry matches
      else { 
      
      $message = "Invalid data provided!";

      if(isset($_SESSION["id"])) {
        header("Location:index.php");
      } // End: Session Id
      } 

  } // End: If username exists
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
    <title>Login</title>
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

  <form name="regUser" method="post" action="" align="center">
      <div class="message"><?php if($message!="") { echo $message; } ?></div>

      <h2 align="center">Site Registration</h2>
      
      Select unique username:<br>
      <input type="text" name="user_name"><br>
      Choose password:<br>
      <input type="password" name="password"><br>
      Re-Enter Password:<br>
      <input type="password" name="password2"><br>
      Email address:<br>
      <input type="text" name="email"><br>
      Re-Enter email address:<br>
      <input type="text" name="email2"><br>
      <input type="submit" name="submit" value="Submit">
      <input type="reset"><br><br>
      <a href="login.php" >Return to Login</a>  

  </form>

</body>
</html>

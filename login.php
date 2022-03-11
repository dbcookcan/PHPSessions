<?php

// login.php
// David Cook, 2022
// Learning session management in php code.
//
// This code logs in a user from a MySQL table and sets session information
// and expiry timer.
//
// The session timer is retrieved from the database so each user can have
// different values. Default is 5 minutes.
//
// User must also be flagged "active" in the DB.
//
// User information is stored in a users table like the following:
//    --
//    -- Table structure for table `users`
//    --
//    
//    DROP TABLE IF EXISTS `users`;
//   /*!40101 SET @saved_cs_client     = @@character_set_client */;
//   /*!40101 SET character_set_client = utf8 */;
//   CREATE TABLE `users` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `username` varchar(50) NOT NULL,
//     `email` varchar(50) NOT NULL,
//     `password` varchar(50) NOT NULL,
//     `created` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `last_login` timestamp(6) NULL DEFAULT NULL,
//     `logout` timestamp(6) NULL DEFAULT NULL,
//     `last_ip` varchar(45) DEFAULT NULL,
//     `timeout` int(11) NOT NULL DEFAULT '5',
//     `active` int(11) NOT NULL DEFAULT '0',
//     `debug` int(11) NOT NULL DEFAULT '0',
//     `descrip` varchar(64) DEFAULT NULL,
//     PRIMARY KEY (`id`),
//     UNIQUE KEY `username_UNIQUE` (`username`)
//   )   ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
//   /*!40101 SET character_set_client = @saved_cs_client */;
//
//    --
//
//    id = unique user identifier, auto-increment
//    username = user's login username
//    email    = user's email address
//    password = user;s md5 hash of password
//    created  = date record was created
//    last_login = timestamp of login
//    logout   = timestamp of logout
//    last_ip  = IP address user last loged in from
//    timeout  = logout timer
//    active   = is the account active 0=no/1=yes
//    debug    = should the code issue debug values to the screen?
//
//    --
//
//  #################################################################
//  #  IMPORTANT  #
//  #  Rename db.php.sample to db.php.
//  #################################################################
//
//       // Database connection for testing
//       $con = mysqli_connect("host","user","pw","dbname") 
//              or die('Unable To connect');
//

    require('db.php');
    include('config.php');
    session_start();
    $message="";

    if(count($_POST)>0) {
        $result = mysqli_query($con,"SELECT * FROM users WHERE username='" . $_POST["user_name"] . "' and password = '" . md5($_POST["password"]). "' and active=1 " );
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {

          // Set session variables
          $_SESSION["id"] = $row['id'];
          $_SESSION["name"] = $row['username'];
          $_SESSION["email"] = $row['username'];
          $_SESSION['timeout'] = ($row['timeout'] * 60);
          $_SESSION["debug"] = $row['debug'];

          // Set activity/logout timer
          $_SESSION['LAST_ACTIVITY'] = time(); // update activity time stamp

          // Update last login in database
          //$result = mysqli_query($con,"UPDATE users SET last_login=now() WHERE id=" . $_SESSION['id'] );
          $result = mysqli_query($con,"UPDATE users SET last_login=now(), last_ip='" . $_SERVER['REMOTE_ADDR']. "' WHERE id=" . $_SESSION['id'] );

        } else {
          $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
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

  <form name="frmUser" method="post" action="" align="center">
      <div class="message"><?php if($message!="") { echo $message; } ?></div>

      <h2 align="center">Enter Login Details</h2>
      
      Username:<br>
      <input type="text" name="user_name"><br>
      Password:<br>
      <input type="password" name="password"><br><br>
      <input type="submit" name="submit" value="Login">
      <input type="reset"><br><br>
      Haven't registered? <a href="registration.php" >Click Here</a>

  </form>

</body>
</html>

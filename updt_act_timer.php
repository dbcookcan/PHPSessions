<?php
// updt_act_timer.php
// David Cook
// This implements the idle logout timer.
// It should be called on every page.
// 1. Check if the timer has expired and force re-login.
// 2. If not, reset timer to current time.
  
  // Check if the session variable exists.
  if (isset($_SESSION['LAST_ACTIVITY'])) {

     // Has the session timer expired? 
     if (time() - $_SESSION['LAST_ACTIVITY'] > $_SESSION['timeout']) {

       // last request was more than timeout val from DB
       header("Location:logout.php");

     } // end: session expired

     // Now update timer to current time
     $_SESSION['LAST_ACTIVITY'] = time(); // update activity time stamp
  }
  else{

     // No Session variable - so we force a fresh login.
     header("Location:logout.php");

  } // end: session exist

 ?>

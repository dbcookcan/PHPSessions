<?php
// Show Debug values
// This will print the debug values to the screen.
if ($_SESSION['debug']>0) {  ?>
  <?php echo "Last timestamp: " . $_SESSION['LAST_ACTIVITY']; ?><br>
  <?php echo "Timeout secs  : " . $_SESSION['timeout']; ?><br>
  <?php echo "Debug         : " . $_SESSION['debug']; ?><br>
  <p>
<?php } ?>

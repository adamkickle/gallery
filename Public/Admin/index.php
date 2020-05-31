<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');
?>
    <div id='main'>
    <h2>Menu</h2>
      <ul>
        <li><a href="logfile.php">log file</a></li>
      </ul>


    </div>
     


<?php 
include_once('../layouts/admin_footer.php');
?>
  
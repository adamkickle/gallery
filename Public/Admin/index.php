<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');
echo "<div style='background:red'>". $message."</div>";

?>
    <div id='main'>
    <h2>Menu</h2>
      <ul>
        <li><a href="logfile.php">log file</a></li>
        <li><a href="list_of_comments.php">all comments</a></li>
        <li><a href="list_of_photos.php">all photos</a></li>
      </ul>


    </div>
     


<?php 
include_once('../layouts/admin_footer.php');
?>
  
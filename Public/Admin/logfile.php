<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');
?>
    

<a href="index.php"> &laquo; Back</a><br/>

<h2>log file</h2>
<p><a href="logfile.php?clear=true"> Clear log file </a></p>

<?php
  
if(isset($_GET['clear']) && $_GET['clear'] == true){
    unlink('C:\\xampp\htdocs\\gallery\\Logs\\log.txt');
     header('location:index.php');
}

if ($file = fopen("C:\\xampp\htdocs\\gallery\\Logs\\log.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
        echo '<ul>';
        echo '<li>'.$line.'</li>'.'<br/>';
        echo '</ul>';
    }
    fclose($file);
}
?>



<?php 
include_once('../layouts/admin_footer.php');
?>
  
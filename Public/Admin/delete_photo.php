
<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');
echo $message;
$photograph = new photograph();



include("../layouts/admin_header.php"); 


 if(isset($_GET['id'])){
    $id =$_GET['id'];
  $show= $photograph->destroy($id);
  $session->message ( "file deleted successfully");
 
  header("location:index.php");
 }else{
    $session->message ( "error");
    
    header("location:index.php"); 
 }

 


include_once('../layouts/admin_footer.php');
?>
  


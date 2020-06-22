<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');

$user = new User();
$insert_arr = array();
// if(isset($_POST['username'])){
//         $arr['username'] = $_POST['username'];
//         $arr['password'] = $_POST['password'];
//         $arr['first_name'] = $_POST['first_name'];
//         $arr['last_name'] = $_POST['last_name'];

// $user->insert_user($arr);
//  }

$user_old_info = User::find_by_id($_SESSION['user_id']); 

/* update
 $user_new_info = array();
if(isset($_POST['username'])){
  $user_new_info['username'] = $_POST['username'];
  $user->update_user($user_new_info,$_SESSION['user_id']);
 }
 //======*/


 // Delete
 if(isset($_POST['id'])){
  $us =filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

  $user->delete($us);
  //$user_new_info['username'] = $_POST['username'];
  //$user->delete($id);
 }

 //======
 
 ?>

 <!DOCTYPE html>
<html>
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>test</title>
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="">
   </head>
   <body>
 <!-- form to insert new user 
  <form action="test.php" method="POST">
    <input name="username" type="text">
    <input name="password" type="text">
    <input name="first_name" type="text">
    <input name="last_name" type="text">
  <input type="submit">
  </form>---> 

   <!-- form to update user 
   <form role="form" method="POST" action="test.php">
   <div class="form-group">
        <label class="control-label">username</label>
        <input type="text" value="" name="username" id="email" class="form-control"/>
    </div>
   <input type="submit">
  </form>---> 

  <form method="POST" action="test.php">
     <label ><?php echo $user_old_info->username; ?></label>
     <input type="hidden" name="id" value="<?php echo $user_old_info->id; ?>">
    <input type="submit" name="submit" value="delete">
  </form>
     
     <script src="" async defer></script>
   </body>
 </html>

<?php 
include_once('../layouts/admin_footer.php');
?>
  
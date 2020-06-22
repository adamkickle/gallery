
<?php
require_once('../../includes/init.php');


if(!$session->is_logged_in()){ header('location: login.php');};
?>


<?php 
include_once('../layouts/admin_header.php');

$user = new User();

$max_file_size = 1048576;
  if(isset($_POST['submit'])){
      $photo_obj = new photograph();

      $photo_obj->caption = $_POST['caption'];

      $photo_obj->attach_file($_FILES['file_upload']);
            if($photo_obj->save()){
                $session->message ( "file uploaded successfully");
                  header("location:list_of_photos.php");
            } else{
                  $message = 'error';
            }

}
 

 //======
 
 ?>
<?php include("../layouts/admin_header.php"); ?>

<?php if (!empty($message)) {echo $message;} ?>
     
        <form action="photo_upload.php" enctype="multipart/form-data" method="post">
              
              <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size;?>" >
              <p><input type="file" name="file_upload" /> </p>
              <p>Caption: <input type="text" name="caption" value="" /> </p>
              <input type="submit" name="submit" value="upload">
       
        </form>

<?php 
include_once('../layouts/admin_footer.php');
?>
  


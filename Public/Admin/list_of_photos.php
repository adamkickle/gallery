<?php

include_once('../../Includes/init.php');
require_once('../../Includes/functions.php');

if(!$session->is_logged_in()){ header('location: login.php');};
echo "<a href='index.php'>Back</a>";

echo $message;
$photo = new photograph();
$photos= $photo->find_all();
echo '<div>';

echo "<a href='photo_upload.php'> upload new  photo</a>";
echo '<div/>'; 
foreach($photos as $photo ){  
     
    echo '<a  href="photo.php?id='.$photo['id'].'">';
    echo '<img style="width:200px;height:200px" src="http://localhost/gallery/public/admin/images/'.$photo['filename'].'" />';
     echo '<a  href="delete_photo.php?id='.$photo['id'].'">delete</a> ';
     echo '</a>';
    }

?>
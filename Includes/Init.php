<?php

// SEARCH about how to use __DIR__
//define('ROOTPATH', __DIR_);

require_once('config.php');
require_once('functions.php');
require_once('session.php');
require_once('database.php');
require_once('pagination.php');
require_once('comment.php');
require_once('user.php');
require_once('photograph.php');
require_once('database_object.php');   



/**
 * next we try to connect to database using pdo 
 * 
 */
function connect(){
try {
    
    $db = new PDO('mysql:host=localhost;dbname=photo_gallery;charset=utf8','root' , ''); 

  
}
catch(Exception $error){
    //echo 'can\'t connect to database';
echo $error->getMessage();
}

return $db;
}

$db = connect();
/**
 * 
 * we will learn how to retrieve data using query method
 */
?>
<?php

include_once('../Includes/init.php');
require_once('../Includes/functions.php');


$user = User::find_by_id(2);

echo $user->first_name;
echo '<hr/>';





echo '<hr/>';


$users= User::find_all();
 foreach($users as $user){  
     echo $user->username.'<hr/>';
    
    ;}


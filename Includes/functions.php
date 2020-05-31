<?php

function strip_zeros_from_date($mystr = '') {
  // the following function will strip zeros and other marks from date #endregion
 //first strip zeros
    $nonZeros = str_replace('0','',$mystr);
 // second strip other marks
 
 $cleaned_string = str_replace('*','',$nonZeros);

return $cleaned_string;
}

//================= we need a function that handles the redirect behave ================

function redirect($location = NULL){

if($location != Null){
   header("location:{$location}");
   exit;
}
}
//================= we need a function that shows a speciefic message ================
//=============
function output_message($message = NULL){
   if($message !=NULL){
      echo "<p class='message'>{$message}</p>";
   }else{
      echo '';
   }
}
//============
//======================================================================================

function __autoload($class_name){
$class_name = strtolower($class_name);
$path = "../includes/{$class_name}.php";

if(file_exists($path)){
   require_once($path);
}else{
   die("the class {$class_name} did not found");
}
}

//============
//======================================================================================

function log_action($action, $message=''){
   $logfile = "C:\\xampp\htdocs\\gallery\\Logs\\log.txt";
   $new = file_exists($logfile) ? false : true;
  
   if($handle = fopen($logfile, 'a')){ // append

      $timestamp = date('m/d/Y H:i:s', 1541843467);;
      $content = "{$timestamp} | {$action} : {$message} \r\n";
      fwrite($handle, $content);
      fclose($handle);

    

   }
}
?>
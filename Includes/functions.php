<?php

include('mailer/php_mailer/PHPMailerAutoload.php');
include('mailer/php_mailer/credential.php');

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


//============= show time in a bit awesome format

function datetime_to_text($datetime){
$unixdatetime = strtotime($datetime);

return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

// send mail notification

function notify($name, $action, $id){

   $mail = new PHPMailer;

   //  $mail->SMTPDebug = 4; // Enable verbose debug output

   $mail->isSMTP(); // Set mailer to use SMTP
   $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
   $mail->SMTPAuth = true; // Enable SMTP authentication
   $mail->Username = EMAIL; // SMTP username
   $mail->Password = PASS; // SMTP password
   $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
   $mail->Port = 587; // TCP port to connect to

   $mail->setFrom(EMAIL, 'amin');
   $mail->addAddress('amin.mahmoud.ek21@gmail.com', $name); // Add a recipient
   $mail->addReplyTo(EMAIL);

   // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
   $mail->isHTML(true); // Set email format to HTML
   $mail->Subject ="new comment form ".$name;
   $mail->Body = $action."  <a href='http://localhost/gallery/Public/photo.php?id={$id}'>photo</a>";
   //$mail->AltBody = $_POST['message'];

   if (!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
       echo 'Message has been sent';
   }
}
?>


<?php

if (isset($_POST['sendmail'])) {
    require 'PHPMailerAutoload.php';
    require 'credential.php';

    $mail = new PHPMailer;

    // $mail->SMTPDebug = 4; // Enable verbose debug output

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = EMAIL; // SMTP username
    $mail->Password = PASS; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    $mail->setFrom(EMAIL, 'amin');
    $mail->addAddress($_POST['email'], $_POST['name']); // Add a recipient
    $mail->addReplyTo(EMAIL);
 
    // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
    $mail->isHTML(true); // Set email format to HTML

    $mail->Subject =$_POST['subject'];
    $mail->Body = '<div style="border:2px solid black">This is the HTML message body <b>in bold!</b></div>';
    $mail->AltBody = $_POST['message'];

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
?>

<form action="sendmail.php" method="POST">


<input type="email" name="email" placeholder="your email"/>
<input type="text" name="subject" placeholder="subject"/>
<input type="text" name="name" placeholder="your name"/>

<input type="text" name="message" placeholder="message"/>
<input type="submit" name="sendmail" value="sendmail"/>
</form>
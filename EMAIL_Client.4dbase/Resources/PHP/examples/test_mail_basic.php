<?php

require_once('../class.phpmailer.php');

$mail = new PHPMailer(true); 		// the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();                    // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup server
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->Username = 'tenthmatrix';    // SMTP username
$mail->Password = 'AugMem8201';     // SMTP password
$mail->SMTPSecure = 'tls';

$bodyHTML             = file_get_contents('emailc_content.html');

$mail->SetFrom("bwalia@tenthmatrix.co.uk","Balinder WALIA");

$mail->AddReplyTo("bwalia@tenthmatrix.co.uk","Balinder WALIA");
$mail->AddReplyTo("balinder.walia@gmail.com","Balinder WALIA");

$address = "balinderwalia@mac.com";
$mail->AddAddress($address, "Balinder WALIA Mac");

$mail->Subject    = "4D PHPMailer Test Subject via mail(), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($bodyHTML);

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "ERR: " . $mail->ErrorInfo;
} else {
  echo "OK";
}

$mail->ClearAddresses();
$mail->ClearAttachments();


?>
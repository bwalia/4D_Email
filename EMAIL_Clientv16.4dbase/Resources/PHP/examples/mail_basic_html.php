<?php

require_once('../class.phpmailer.php');

$mail = new PHPMailer(true); 		// the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();                    // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup server
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->Username = 'tenthmatrix';    // SMTP username
$mail->Password = 'zEM-6o2-6Qt-DZL';     // SMTP password
$mail->SMTPSecure = 'tls';


$bodyHTML             = file_get_contents('emailc_content.html');


$mail->SetFrom("developer@tenthmatrix.co.uk","");


$mail->AddReplyTo("developer@tenthmatrix.co.uk","");



$mail->AddAddress("balinder.walia@gmail.com", "");


//$mail->AddBCC("balinder.walia@gmail.com", "balinder.walia@gmail.com");

$mail->Subject    = "Subject (Test Please delete it): Account Statement Attached";

$mail->AltBody    = "BODY (Test Please delete it)Account Statement AttachedBilling TeamThanksby: Designermachine: Balinder Walia"; // optional, comment out and test

$mail->MsgHTML($bodyHTML);




//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment




if(!$mail->Send()) {
  echo "ERR: " . $mail->ErrorInfo;
} else {
  echo "OK";
}

$mail->ClearAddresses();
$mail->ClearAttachments();



?>
<?php

require_once('../class.phpmailer.php');

$mail = new PHPMailer(true); 		// the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();                    // Set mailer to use SMTP
$mail->Host = '127.0.0.1';  // Specify main and backup server
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->Username = '';    // SMTP username
$mail->Password = '';     // SMTP password
$mail->SMTPSecure = 'tls';


$bodyHTML             = file_get_contents('emailc_content.html');


$mail->SetFrom("noreply@tenthmatrix.co.uk","");


$mail->AddReplyTo("noreply@tenthmatrix.co.uk","");



$mail->AddAddress("billing@tenthmatrix.co.uk", "");


$mail->Subject    = "Tenthmatrix Billing CRM: 9 Recurring Invoice(s) created";

$mail->AltBody    = "Tenthmatrix Billing CRM: 9 Recurring Invoice(s) createdby: Designermachine: Balinder Walia"; // optional, comment out and test

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
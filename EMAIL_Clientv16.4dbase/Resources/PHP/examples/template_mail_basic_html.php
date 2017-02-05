<?php

require_once('../class.phpmailer.php');

$mail = new PHPMailer(true); 		// the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();                    // Set mailer to use SMTP
$mail->Host = '<!--#4DVAR <>SMTPD_HostIPAddrStr-->';  // Specify main and backup server
$mail->SMTPAuth = true;             // Enable SMTP authentication
$mail->Username = '<!--#4DHTMLVAR <>EMAILC_SMTPAuthUser-->';    // SMTP username
$mail->Password = '<!--#4DHTMLVAR <>EMAILC_SMTPAuthPasswd-->';     // SMTP password
$mail->SMTPSecure = 'tls';

<!--#4DIF (mEMAILC_HTMLFileOK)-->
$bodyHTML             = file_get_contents('emailc_content.html');
<!--#4DELSE-->
$bodyHTML="";
<!--#4DENDIF-->

$mail->SetFrom("<!--#4DHTMLVAR mEMAILC_fromAddrStr-->","<!--#4DVAR mEMAILC_fromNameStr-->");

<!--#4DIF (Size of Array(mEMAILC_replyToAddrStrArr)>0)-->
<!--#4DLOOP mEMAILC_replyToAddrStrArr-->
$mail->AddReplyTo("<!--#4DHTMLVAR mEMAILC_replyToAddrStrArr{mEMAILC_replyToAddrStrArr}-->","<!--#4DVAR mEMAILC_replyToNameStrArr{mEMAILC_replyToAddrStrArr}-->");
<!--#4DENDLOOP-->

<!--#4DELSE-->
$mail->AddReplyTo("<!--#4DHTMLVAR mEMAILC_replyToAddrStr-->","<!--#4DVAR mEMAILC_replyToNameStr-->");
<!--#4DENDIF-->

<!--#4DIF (Size of Array(mEMAILC_ToAddrStrArr)>0)-->
<!--#4DLOOP mEMAILC_ToAddrStrArr-->
$mail->AddAddress("<!--#4DHTMLVAR mEMAILC_ToAddrStrArr{mEMAILC_ToAddrStrArr}-->","<!--#4DVAR mEMAILC_ToNameStrArr{mEMAILC_ToAddrStrArr}-->");
<!--#4DENDLOOP-->

<!--#4DELSE-->
$mail->AddAddress("<!--#4DHTMLVAR mEMAILC_ToAddrStr-->", "<!--#4DVAR mEMAILC_ToNameStr-->");
<!--#4DENDIF-->

//$mail->AddBCC("balinder.walia@gmail.com", "balinder.walia@gmail.com");

$mail->Subject    = "<!--#4DHTMLVAR mEMAILC_ToSubjectStr-->";

$mail->AltBody    = "<!--#4DHTMLVAR mEMAILC_ToBodyStr-->"; // optional, comment out and test

$mail->MsgHTML($bodyHTML);

<!--#4DIF (Size of Array(mEMAILC_AttachmentsPosixStrArr)>0)-->
<!--#4DLOOP mEMAILC_AttachmentsPosixStrArr-->
$mail->AddAttachment("<!--#4DHTMLVAR mEMAILC_AttachmentsPosixStrArr{mEMAILC_AttachmentsPosixStrArr}-->"); // attachment
<!--#4DENDLOOP-->
<!--#4DELSE-->
<!--#4DENDIF-->

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

<!--#4DIF (Size of Array(mEMAILC_EmbedPosixStrArr)>0)-->
<!--#4DLOOP mEMAILC_EmbedPosixStrArr-->
$mail->AddEmbeddedImage("<!--#4DHTMLVAR mEMAILC_EmbedPosixStrArr{mEMAILC_EmbedPosixStrArr}-->", "<!--#4DHTMLVAR mEMAILC_EmbedPosixCIDStrArr{mEMAILC_EmbedPosixStrArr}-->", "<!--#4DHTMLVAR mEMAILC_EmbedPosixNameStrArr{mEMAILC_EmbedPosixStrArr}-->");// embed image
<!--#4DENDLOOP-->
<!--#4DELSE-->
<!--#4DENDIF-->

if(!$mail->Send()) {
  echo "ERR: " . $mail->ErrorInfo;
} else {
  echo "OK";
}

$mail->ClearAddresses();
$mail->ClearAttachments();



?>
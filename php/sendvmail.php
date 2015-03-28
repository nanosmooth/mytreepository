<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from       = "welcometeam@hamarlok.com";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "tls://smtp.gmail.com"; // SMTP host
$mail->Port       =  465;                    // set the SMTP port
$mail->Username   = "tejus.111@gmail.com";  // SMTP  username
$mail->Password   = "remember111";  // SMTP password
$mail->SetFrom($from, 'Hamarlok Team');
$mail->AddReplyTo($from,'Hamarlok Team');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send(); 
}
?>
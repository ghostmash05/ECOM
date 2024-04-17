
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$smtp_server = "mail.hostwithbros.com";
$smtp_username = "test@hostwithbros.com";   
$smtp_password = "dSAW6UEAeAfmRZFGTFsx";
$smtp_port = 587;

$mail->isSMTP();
$mail->Host       = $smtp_server;                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = $smtp_username;                     //SMTP username
$mail->Password   = $smtp_password;                               //SMTP password
$mail->SMTPSecure = 'tls';           //Enable implicit TLS encryption
$mail->Port       = $smtp_port;  



$from = "test@hostwithbros.com";
$site_url = "http://localhost";
$site_name= "shoes ";

$mail->setFrom('test@hostwithbros.com', $from);



function password_reset_mail($email_address,$token){
global $mail;
global $site_name;
global $site_url;
$mail->addAddress($email_address);
$mail->isHTML(true); 
$mail->Subject = "Password Reset - $site_name";
$reset_link = "$site_url/password_reset.php?email=$email_address&token=$token";
$mail->Body = "Your password has been reset, Please follow <a href='$reset_link'> this link </a> to reset your password";

$mail->send();

}



?>




<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$smtp_server = "";
$smtp_username = "";   
$smtp_password = "";
$smtp_port = 42;

$mail->Host       = $smtp_server;                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = smtp_username;                     //SMTP username
$mail->Password   = smtp_password;                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = $smtp_port;  



$from = "admin@whoistheboss.com";
$site_url = "http://localhost";
$site_name= "shoes ";

$mail->setFrom('shaongit@gmail.com', $from);



function password_reset_mail($email){

$mail->addAddress($email);
$mail->isHTML(true); 
$mail->Subject = "Password Reset - $sitename";
$reset_link = "$site_url/password_reset.php";
$mail->Body = "Your password has been reset, Please follow <a href='$reset_link'> this link </a> to reset your password";

$mail->send();

}

?>



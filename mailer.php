$smtp_server = "";
$smtp_username = "";   
$smtp_password = "";
$smtp_port = ;

$from = "admin@whoistheboss.com"
$site_url = "http://localhost"



function password_reset_mail($email){

$subject = "Password Reset";
$reset_link = "$site_url/password_reset.php";
$msg = "Your password has been reset, Please follow <a href='$reset_link'> this link </a> to reset your password";




}
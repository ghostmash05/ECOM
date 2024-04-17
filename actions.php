<?php

require_once "components/db.php";




function login_checker($conn){
    

    if(!isset($_REQUEST["email"])){
     
        $json = json_encode(array(
            "status" => "error",
            "msg" => "Sorry, Please provide an email address.",
        ));
        return $json;
     
    }
    if(!isset($_REQUEST["password"])){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter a password. ",
        ));

        return $json;
        

    }

    $email =  mysqli_real_escape_string( $conn,$_POST["email"]);
    $password  =  mysqli_real_escape_string( $conn,$_REQUEST["password"]);
    $password = md5($password);



    $sql = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? and `password` = ?");
    $sql->bind_param('ss',$email, $password);
    $sql->execute();
    $res = $sql->get_result();
    

    if ($res->num_rows > 0){

        $json =  json_encode(array(
            "status"=>"success",
            "msg"=>"Logged in successfully",
        ));
        return $json;
        

    }
    else{
        $json = json_encode(array(
        "status"=>"error",
        "msg"=>"Sorry email and password combination does not match"
        ));
        return $json;
        
    }


}

function register($conn){
    if(!isset($_REQUEST["full_name"]) || $_REQUEST["full_name"]===""){
     
        $json = json_encode(array(
            "status" => "error",
            "msg" => "Sorry, Please provide your full name.",
        ));
        return $json;
     
    }

    if(!isset($_POST["email"]) || $_POST["email"] ==="" ){
     
        $json = json_encode(array(
            "status" => "error",
            "msg" => "Sorry, Please provide an email address.",
        ));
        return $json;
     
    }
    if(!isset($_POST["username"]) || $_POST["username"]==="")  {
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter a username. ",
        ));

        return $json;
        

    }

    if(!isset($_REQUEST["password"])  ||  $_REQUEST["password"]===""  ){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter a password. ",
        ));

        return $json;
        

    }

    

    if(!isset($_REQUEST["cnf_password"]) || $_REQUEST["cnf_password"]==="" ){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter password in confirm password field to confirm . ",
        ));

        return $json;
        

    }

    if(!isset($_REQUEST["phone"])  || $_REQUEST["phone"]===""){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please provide a phone number. ",
        ));

        return $json;
        

    }

    if($_REQUEST["password"]!=$_REQUEST["cnf_password"]){

        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, cofirm password don't match with the given password. ",
        ));

        return $json;
    }
    $full_name =  mysqli_real_escape_string($conn, $_REQUEST["full_name"]) ;
    $email =  mysqli_real_escape_string($conn, $_POST["email"]) ;
    $username =  mysqli_real_escape_string($conn, $_POST["username"]); 
    $password =  mysqli_real_escape_string($conn, $_REQUEST["password"]); 
    $password = md5($password);
    $phone = mysqli_real_escape_string($conn, $_REQUEST["phone"]);



    $sql_email_check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql_email_check->bind_param("s", $email);
    $sql_email_check->execute();
    $email_check_res = $sql_email_check->get_result();

    if($email_check_res->num_rows>0){
      
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry an acccount with the email already exits",
        ));

        return $json;

    }

    $sql_username_check = $conn->prepare("SELECT * from users WHERE username = ?");
    $sql_username_check->bind_param("s", $phone);
    $sql_username_check->execute();
    $username_check_res = $sql_username_check->get_result();

    if($username_check_res->num_rows>0){

        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry an acccount with the username already exits",
        ));

        return $json;

    }

    $sql_phone_check = $conn->prepare("SELECT * from users WHERE phone = ?");
    $sql_phone_check->bind_param("s", $phone);
    $sql_phone_check->execute();
    $phone_check_res = $sql_phone_check->get_result();

    if($phone_check_res->num_rows>0){
      
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry an acccount with the phone number already exits",
        ));

        return $json;

    }


    $sql_account_create = $conn->prepare("INSERT INTO `users` (`full_name`, `username`, `email`, `password`, `phone`) VALUES (?, ?, ?, ?, ?); ");
    $sql_account_create->bind_param("sssss",$full_name, $username, $email, $password, $phone);
    $sql_account_create->execute();

    

    if ($sql_account_create){


        $json = json_encode(array(
            "status"=>"success",
            "msg"=>"Thank you your account has been successfully created. ",
        ));

        return $json;

    }
    else{
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry something went wrong. Please try again later. ",
        ));

        return $json;

    }


    




}



function req_password_reset(){

    if($_POST["email"] || $_POST["email"]===""){
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, Please provide an email address to reset password."
        ));
    }

    $email = mysqli_escape_string($conn, $_REQUEST["email"]);

    $find_user_sql = $conn->prepare("SELECT * from users WHERE email = ?");
    $find_user_sql->bind_param("s", $email);
    $find_user_sql->execute();
    $user_sql_res = $find_user_sql->get_result();

    if($user_sql_res->num_rows>0){
     
        $random_bytes = random_bytes(20);
        $token = bin2hex($random_bytes);
        $sql_token = "UPDATE users SET token=$token WHERE email=$email and token_expire = DATE_ADD(NOW(),INTERVAL 15 MINUTE)";
        mysqli_query($conn, $sql_token);

        password_reset_mail($email);
        
        $json = json_encode(array(
            "status"=>"success",
            "msg"=>"An mail with password reset instruction has been sent to your email. "
        ));
        return json;


          

    }
    else{
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, No user with that email address has been found."
        ));
        return json;

    }
}





  
if ( isset($_GET["action"]) && isset($_POST)){
  

    if($_GET["action"]=="login"){
        
        $json_out = login_checker($conn);
        echo $json_out;
    }

    elseif($_GET["action"]=="register"){
        
        $json_out = register($conn);
        echo $json_out;
    }

 


    

}

?>
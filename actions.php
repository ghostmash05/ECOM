<?php

require_once "db.php";



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

    $email =  mysqli_real_escape_string( $conn,$_REQUEST["email"]);
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



  
if ( isset($_GET["action"]) && isset($_POST)){
  

    if($_GET["action"]=="login"){
        
        $json_out = login_checker($conn);
        echo $json_out;
    }


    

}

?>
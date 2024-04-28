<?php

require_once "components/header.php";

require_once "mailer.php";


function login_checker($conn){
    

    if(!isset($_POST["email"])){
     
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

        $prev_user_id = $_SESSION["user_id"];

        $_SESSION["email"] = $email;
        

        $json =  json_encode(array(
            "status"=>"success",
            "msg"=>"Logged in successfully",
        ));

        $sql_for_cart = "UPDATE cart SET user_id = '$email' WHERE user_id = '$prev_user_id'";
        
        mysqli_query($conn, $sql_for_cart);
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
    if(!isset($_POST["full_name"]) || $_POST["full_name"]===""){
     
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

    if(!isset($_POST["password"])  ||  $_POST["password"]===""  ){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter a password. ",
        ));

        return $json;
        

    }

    

    if(!isset($_POST["cnf_password"]) || $_POST["cnf_password"]==="" ){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please enter password in confirm password field to confirm . ",
        ));

        return $json;
        

    }

    if(!isset($_POST["phone"])  || $_POST["phone"]===""){
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, please provide a phone number. ",
        ));

        return $json;
        

    }

    if($_POST["password"]!=$_POST["cnf_password"]){

        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, cofirm password don't match with the given password. ",
        ));

        return $json;
    }
    $full_name =  mysqli_real_escape_string($conn, $_POST["full_name"]) ;
    $email =  mysqli_real_escape_string($conn, $_POST["email"]) ;
    $username =  mysqli_real_escape_string($conn, $_POST["username"]); 
    $password =  mysqli_real_escape_string($conn, $_POST["password"]); 
    $password = md5($password);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);



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



function req_password_reset($conn){

    if(!isset($_POST["email"]) || $_POST["email"]==""){
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, Please provide an email address to reset password."
        ));
        return $json;
    }

    $email = mysqli_escape_string($conn, $_POST["email"]);

    $find_user_sql = $conn->prepare("SELECT * from users WHERE email = ?");
    $find_user_sql->bind_param("s", $email);
    $find_user_sql->execute();
    $user_sql_res = $find_user_sql->get_result();

    if($user_sql_res->num_rows>0){
     
        $random_bytes = random_bytes(20);
        $token = bin2hex($random_bytes);
        $sql_token = $conn->prepare("UPDATE users SET token=?, token_expire = DATE_ADD(NOW(),INTERVAL 15 MINUTE)  WHERE email=?") ;
        $sql_token->bind_param("ss", $token, $email);
        $sql_token->execute();
       

        password_reset_mail($email,$token);
        
        $json = json_encode(array(
            "status"=>"success",
            "msg"=>"An mail with password reset instruction has been sent to your email. "
        ));
        return $json;


          

    }
    else{
        $json = json_encode(array(
            "status"=>"error",
            "msg"=>"Sorry, No user with that email address has been found."
        ));
        return $json;

    }
}


function cart_total($conn){

    if(isset($_SESSION["email"])){

        $_SESSION["user_id"]= $_SESSION["email"];
    }


    if(!isset($_SESSION["user_id"])){


        $_SESSION["user_id"]= uniqid();
    }

    $sql_total_items = $conn->prepare("SELECT * from cart WHERE user_id = ? ");
    $sql_total_items->bind_param("s",$_SESSION["user_id"]);
    $sql_total_items->execute();
    $res_sql_total_items = $sql_total_items->get_result();

    $json = json_encode(array(
        "status"=>"success",
        "msg"=>$res_sql_total_items->num_rows,
    ));
    return $json;


    }



function add_to_cart($conn){

    $user_id = $_SESSION["user_id"];
    $product_id = mysqli_real_escape_string($conn,$_REQUEST["product_id"]);
    $product_id = (int)$product_id;
    $quantity = mysqli_real_escape_string($conn, $_REQUEST["quantity"]);
    $quantity = (int)$quantity;
    $sql_for_product_info = $conn->prepare("SELECT * from products where product_id = ?");
    $sql_for_product_info->bind_param("s",$product_id);
    $sql_for_product_info->execute();

    $res_sql_product_info  = $sql_for_product_info->get_result();
    
    if($res_sql_product_info->num_rows<1){

        $json= json_encode(array(
            "status"=>"erorr",
            "msg"=>"Sorry The product youre trying to order does not exits."
        ));
        return $json;

    }



    $sql_for_exiting_cart_check = $conn->prepare("SELECT * from cart where user_id = ? AND  product_id = ?");

    $sql_for_exiting_cart_check->bind_param("ss",$user_id, $product_id);
    $sql_for_exiting_cart_check->execute();

    $res_sql_for_exiting_cart = $sql_for_exiting_cart_check->get_result();

    $res_sql_for_exiting_cart_assoc = $res_sql_for_exiting_cart->fetch_array(MYSQLI_ASSOC);

    

   


    if($res_sql_for_exiting_cart->num_rows>0){

      
        $current_quanity = (int)$res_sql_for_exiting_cart_assoc["quantity"] + (int)$quantity;
        $sql_for_increment_cart_quantity = $conn->prepare("UPDATE cart set quantity = ? where product_id = ? and user_id = ?");
        $sql_for_increment_cart_quantity->bind_param("sss",$current_quanity, $product_id,$user_id);
        if($sql_for_increment_cart_quantity->execute()){

            $json= json_encode(array(
                "status"=>"success",
                "msg"=>"Cart updated."
            ));
            return $json;
        }

        


    }

    else{



        $sql_for_add_cart = $conn->prepare("INSERT INTO `cart` ( `user_id`, `product_id`, `quantity`) VALUES (?, ?, ?)");
        $sql_for_add_cart->bind_param("sdd",$user_id, $product_id, $quantity);
        if($sql_for_add_cart->execute()){

            $json= json_encode(array(
                "status"=>"success",
                "msg"=>"Item added to cart"
            ));
            return $json;
        }


    }



    



}



function update_cart_item($conn){


    $user_id = $_SESSION["user_id"];
    $product_id = mysqli_real_escape_string($conn,$_REQUEST["product_id"]);
    $product_id = (int)$product_id;
    $quantity = mysqli_real_escape_string($conn, $_REQUEST["quantity"]);
    $quantity = (int)$quantity;
    $sql_for_product_info = $conn->prepare("SELECT * from products where product_id = ?");
    $sql_for_product_info->bind_param("s",$product_id);
    $sql_for_product_info->execute();

    $res_sql_product_info  = $sql_for_product_info->get_result();
    
    if($res_sql_product_info->num_rows<1){

        $json= json_encode(array(
            "status"=>"erorr",
            "msg"=>"Sorry The product youre trying to order does not exits."
        ));
        return $json;

    }



    $sql_for_exiting_cart_check = $conn->prepare("SELECT * from cart where user_id = ? AND  product_id = ?");

    $sql_for_exiting_cart_check->bind_param("ss",$user_id, $product_id);
    $sql_for_exiting_cart_check->execute();

    $res_sql_for_exiting_cart = $sql_for_exiting_cart_check->get_result();

    $res_sql_for_exiting_cart_assoc = $res_sql_for_exiting_cart->fetch_array(MYSQLI_ASSOC);

    

   


    if($res_sql_for_exiting_cart->num_rows>0){

      
        $current_quanity =  (int)$quantity;
        $sql_for_increment_cart_quantity = $conn->prepare("UPDATE cart set quantity = ? where product_id = ? and user_id = ?");
        $sql_for_increment_cart_quantity->bind_param("sss",$current_quanity, $product_id,$user_id);
        if($sql_for_increment_cart_quantity->execute()){

            $json= json_encode(array(
                "status"=>"success",
                "msg"=>"Cart updated."
            ));
            return $json;
        }

        


    }

    else{
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"You don't have this item in your cart."
        ));
        return $json;

    }





}


function delete_cart_item($conn){

    $user_id = $_SESSION["user_id"];
    $product_id = mysqli_real_escape_string($conn,$_REQUEST["product_id"]);
    $product_id = (int)$product_id;
   
    $sql_for_product_info = $conn->prepare("SELECT * from products where product_id = ?");
    $sql_for_product_info->bind_param("s",$product_id);
    $sql_for_product_info->execute();

    $res_sql_product_info  = $sql_for_product_info->get_result();
    
    if($res_sql_product_info->num_rows<1){

        $json= json_encode(array(
            "status"=>"erorr",
            "msg"=>"Sorry The product youre trying to order does not exits."
        ));
        return $json;

    }



    $sql_for_exiting_cart_check = $conn->prepare("SELECT * from cart where user_id = ? AND  product_id = ?");

    $sql_for_exiting_cart_check->bind_param("ss",$user_id, $product_id);
    $sql_for_exiting_cart_check->execute();

    $res_sql_for_exiting_cart = $sql_for_exiting_cart_check->get_result();

    $res_sql_for_exiting_cart_assoc = $res_sql_for_exiting_cart->fetch_array(MYSQLI_ASSOC);

    

   


    if($res_sql_for_exiting_cart->num_rows>0){

      
        
        $sql_for_delete_cart_item = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $sql_for_delete_cart_item->bind_param("ss",$user_id, $product_id);
        if($sql_for_delete_cart_item->execute()){

            $json= json_encode(array(
                "status"=>"success",
                "msg"=>"Item deleted from cart. "
            ));
            return $json;
        }

        


    }
    else{
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"You don't have this item in your cart."
        ));
        return $json;

    }


}


function clear_cart($conn){



    $user_id = $_SESSION["user_id"];


    $sql_for_exiting_cart_check = $conn->prepare("SELECT * from cart where user_id = ? ");

    $sql_for_exiting_cart_check->bind_param("s",$user_id);
    $sql_for_exiting_cart_check->execute();

    $res_sql_for_exiting_cart = $sql_for_exiting_cart_check->get_result();

    if($res_sql_for_exiting_cart->num_rows>0){

        $sql_for_delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $sql_for_delete_cart->bind_param("s",$user_id);
        if($sql_for_delete_cart->execute()){

            $json= json_encode(array(
                "status"=>"success",
                "msg"=>"All Cart Items Removed."
            ));
            return $json;
        }



    }

    else{
        $json= json_encode(array(
            "status"=>"error",
            "msg"=>"You dont have item in your cart"
        ));
        return $json;

    }




}



function get_cart_items($conn){

    $user_id = $_SESSION["user_id"];


    $sql_for_exiting_cart_check = $conn->prepare("SELECT * FROM cart  LEFT JOIN products ON cart.product_id = products.product_id  WHERE user_id=?");

    $sql_for_exiting_cart_check->bind_param("s",$user_id);
    $sql_for_exiting_cart_check->execute();

    $res_sql_for_exiting_cart = $sql_for_exiting_cart_check->get_result();

    $res_row  =  $res_sql_for_exiting_cart->fetch_all(MYSQLI_ASSOC);

   
    if($res_sql_for_exiting_cart->num_rows>0){

        $json = json_encode($res_row);
        return $json;
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

    elseif($_GET["action"]=="forgot_password"){

        $json_out = req_password_reset($conn);
        echo $json_out;
    }

    elseif($_GET["action"]=="cart_total"){
        $json_out = cart_total($conn);
        echo $json_out;
    }

    elseif($_GET["action"]=="add_to_cart"){
        $json_out = add_to_cart($conn);
        echo $json_out;
    }
    elseif($_GET["action"]=="update_cart_item"){
        $json_out = update_cart_item($conn);
        echo $json_out;
    }


    elseif($_GET["action"]=="delete_cart_item"){
        $json_out = delete_cart_item($conn);
        echo $json_out;
    }

    elseif($_GET["action"]=="clear_cart"){
        $json_out = clear_cart($conn);
        echo $json_out;
    }

    elseif($_GET["action"]=="get_cart_items"){
        $json_out = get_cart_items($conn);
        echo $json_out;
    }
    elseif($_GET["action"]=="clear_cart"){
        $json_out = cler_cart($conn);
        echo $json_out;
    }

 


    

}

?>
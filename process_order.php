<?php
include_once "components/header.php";

$address = mysqli_real_escape_string($conn, $_POST["address"]);
$city = mysqli_real_escape_string($conn, $_POST["city"]);
$zip_code = mysqli_real_escape_string($conn, $_POST["zip_code"]);
$country = mysqli_real_escape_string($conn, $_POST["country"]);
$payment_method = mysqli_real_escape_string($conn, $_POST["payment_method"]);
$order_status = "pending";
$user_id = $_SESSION["user_id"];

$sql_for_creating_product = "INSERT INTO `orders` (`order_id`, `user_email`, `order_date`, `address`, `city`, `country`, `payment_method`, `order_status`)  VALUES ('', '$user_id', current_timestamp(), '$address',' $city', '$country', '$payment_method', '$order_status');";

mysqli_query($conn,$sql_for_creating_product);
$order_id = mysqli_insert_id($conn);



$sql = "INSERT INTO ordered_items (product_id, order_id, quantity, price) 
SELECT c.product_id, $order_id, c.quantity, p.price*c.quantity 
FROM cart c 
LEFT JOIN products p ON c.product_id = p.product_id
WHERE user_id = '$user_id' ";


$res_copy = mysqli_query($conn, $sql);


if($res_copy){



    $sql_for_cart_delete = "DELETE FROM cart WHERE user_id ='$user_id'";
    mysqli_query($conn,$sql_for_cart_delete);
    
    echo "order is created order  id $order_id";
}
else{
    echo  "Sorry the order is not created";
}


?>
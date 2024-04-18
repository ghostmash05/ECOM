
<link rel="stylesheet" href="./../home.css">

<?php include_once "components/header.php";




$sql = "SELECT * FROM `products`";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($query);



if(mysqli_num_rows($query)>0){


    $product_id = (int)$res["product_id"];
    $product_title = $res["product_title"];
    $product_description = $res["product_description"];
    $product_image = 'images/'.$res['product_image'];
    $price = (int)$res["price"];
    $prev_price = (int)$res["prev_price"];

}

else{

    $product_id = 1;
    $product_title = "Example product title";
    $product_description = "Example product desc";
    $price = "10Tk";
    $prev_price= "100Tk";

}


?>



<body>
<div class="color">
                <div class="nav-left">
                    <a href="#">Home</a>
                    <a href="/about.php">About</a>
                    <a href="/contact.php">Contact</a>
                    
                </div>
                <div class="content">
                    <div class="social-media">
                        <a href="#" class="social-link"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="#" class="social-link"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="#" class="social-link"><ion-icon name="logo-instagram"></ion-icon></a>
                    </div>
                    <h1>The Latest & The Greatest</h1>
                    <h3><?=$product_title;?></h3>
                    <p><?=$product_description;?>.</p>

                       <div class="size">
                        <button>38</button>
                        <button>40</button>
                        <button>41</button>
                        <button>42</button>
                        <button>43</button>
                        <button>44</button>
                      </div>

                    <div class="photos">
                        <img src="<?=$product_image;?>" alt="Nike Air Max 1 Premium" height="100px" width="75px">
                       
                    <div class="quantity">
                        <button id="decrease_btn">-</button>
                        <input id="cart_quantity" type="number" value="1">
                        <button id ="increase_btn" >+</button>
                    </div>
                    </div>

                </div>
    </div>
    <div class="nav-right">
        <a href="cart.php" ><ion-icon name="cart-outline"></ion-icon><p id="cart_total"> </p></a>
        <a href="auth.php"><ion-icon name="person-outline"></ion-icon></a>
    </div>
    <div class="item">
        <h1><?=$product_title;?></h1>
    </div>
    <div class="image">
        <img src="<?=$product_image;?>" alt="<?=$product_title;?>" height="600px" width="450px">
    </div>
    <div class="price">
        <h3>$<?=$prev_price;?></h3>
        <h2>$<?=$price;?></h2>
    </div>
    <div class="cart">

        <button  id="add_to_cart_btn"  product_id ="<?=$product_id;?>" ><ion-icon name="cart-outline"></ion-icon>&nbsp Add to Cart</button>
    </div>
</body>
</body>


<?php include_once "components/footer.php"  ?>



<script>
    $(document).ready(function(){
       
        $.ajax({
            url:"actions.php?action=cart_total",
            method:"GET",
            dataType:"json",
            success:function(data){

                var data_json = JSON.parse(JSON.stringify(data));
                
                console.log(data_json["msg"]);
                $("#cart_total").html(data["msg"]);

            }
        })

        $("#increase_btn").click(function(){

            var quantity = parseInt($("#cart_quantity").val())+1;

            $("#cart_quantity").val(quantity);
        })



        $("#decrease_btn").click(function(){

            var quantity = parseInt($("#cart_quantity").val());

            if( quantity>1){

                 var quantity = $("#cart_quantity").val() -1;
            }
            else{
                var quantity = 1;
            }


            $("#cart_quantity").val(quantity);



})

$("#add_to_cart_btn").click(function(){


    var quantity = parseInt($("#cart_quantity").val());

    var product_id = parseInt($(this).data('product_id'));

    
    
    $.ajax({
  url:"actions.php?action=add_to_cart",
  method:"POST",
  data:{product_id:product_id, quantity:quantity},
  dataType:'json',
  success:function(data){

    
    
    var data = JSON.parse(JSON.stringify(data));

    
    console.log(data);
    

    if (data["status"]==="error"){
  
      
      


    }

    else{
     console.log(data["msg"]);

      
    }


  }
})

  

})

    

    


    })
</script>


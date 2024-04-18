
<link rel="stylesheet" href="./../home.css">

<?php include_once "components/header.php";



echo $_SESSION["user_id"];
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
<div id="cart_msg">
<div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
  <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
  
    <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
      <div class="p-4">
        <div class="flex items-start">
          <div class="flex-shrink-0">
            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="ml-3 w-0 flex-1 pt-0.5">
            <p id ="success_tick" class="text-sm font-medium text-gray-900"></p>
            <p id ="success_msg" class="mt-1 text-sm text-gray-500"></p>
          </div>
          <div class="ml-4 flex flex-shrink-0">
            <button type="button" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Close</span>
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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

        <button  id="add_to_cart_btn"  data-product_id ="<?=$product_id;?>" ><ion-icon name="cart-outline"></ion-icon>&nbsp Add to Cart</button>
    </div>
</body>
</body>


<?php include_once "components/footer.php"  ?>



<script>
    $(document).ready(function(){
        $("#cart_msg").hide();
       
       
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


    console.log("coming here");

    
    

    
    console.log(data);
    

    if (data["status"]==="error"){
  
      
      


    }

    else{
     console.log(data["msg"]);
     $("#cart_msg").show();
     $("#success_tick").html("Added to Cart");
        $("#success_msg").html("Your item has been added to cart");
        
    }


  }
})

  

})

    

    


    })
</script>


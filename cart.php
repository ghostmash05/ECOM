
<?php include_once "components/header.php";?>

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 ">
    <h1 class="text-center text-3xl font-bold  text-gray-900 "> Cart</h1>

    <form class="mt-12">
      <section aria-labelledby="cart-heading">
        <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

        <ul id ="product_list" role="list" class="divide-y divide-gray-200 border-b border-t border-gray-200">
         

          
       
       
        </ul>
      </section>

     
      <section aria-labelledby="summary-heading" class="mt-10">
        <h2 id="summary-heading" class="sr-only">Order summary</h2>

        <div>
          <dl class="space-y-4">
            <div class="flex items-center justify-between">
              <dt class="text-base font-medium text-gray-900">Total </dt>
              <dd id="total_price_fld" class="ml-4 text-base font-medium text-gray-900"></dd>
            </div>
          </dl>

        </div>

        <div class="mt-10">
          
        <button id="checkoutBtn" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
        <a href="checkout.php">Checkout</a>
        </button>

        </div>

        <div class="mt-4">
          <button id="clear_cart_btn" class="w-full rounded-md border border-transparent bg-red-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Delete cart</button>
        </div>

        <div class="mt-6 text-center text-sm">
          <p>
            or
            <a href="index.php" class="font-medium text-indigo-600 hover:text-indigo-500">
              Continue Shopping
              <span aria-hidden="true"> &rarr;</span>
            </a>
          </p>
        </div>
      </section>
    </form>
  </div>
</div>


<?php include_once "components/footer.php"  ?>

<script>
    $(document).ready(function(){

       function add_product_html(product_title , product_quantity, product_img, product_id,product_price){
        $("#product_list").html("");
        var temp_html= `

  <li class="flex py-6">
    <div class="flex-shrink-0">
      <img src="images/`+product_img+`" alt="Front side of mint cotton t-shirt with wavey lines pattern." class="h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32">
    </div>

    <div class="ml-4 flex flex-1 flex-col sm:ml-6">
      <div>
        <div class="flex justify-between">
          <h4 class="text-sm">
            <a href="#" class="font-medium text-gray-700 hover:text-gray-800">`+product_title+`</a>
          </h4>
          <p class="ml-4 text-sm font-medium text-gray-900"> ৳`+product_price+`</p>
        </div>

        <p class="mt-1 border py-2 text-sm text-gray-500"> <input id="cart_quantity" data-product_id = `+product_id+` type="number" value="`+product_quantity+ `"></p>
      </div>

      <div class="mt-4 flex flex-1 items-end justify-between">
        <p class="flex items-center space-x-2 text-sm text-gray-700">
          <svg class="h-5 w-5 flex-shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
          </svg>
          <span>In stock</span>
        </p>
        <div class="ml-4">
         
            <button id="remove_item_btn" data-product_id = `+product_id+` >Remove</button>
          
        </div>
      </div>
    </div>
  </li>
       
       
`;

$("#product_list").append(temp_html);




}

function load_data(){
    $.ajax({
  url:"actions.php?action=get_cart_items",
  method:"GET",
  dataType:'json',
  success:function(data){


    
    

   
        var total_price = 0;
        var data_json = JSON.parse(JSON.stringify(data));
        

        data_json.forEach(function(row){
       console.log("coming here");


            add_product_html(row["product_title"],row["quantity"],row["product_image"], row["product_id"],row["price"]);
            total_price = total_price + parseInt(row["price"]) * parseInt(row["quantity"]);

        })

        console.log(total_price);
        $("#total_price_fld").html(total_price);


    



  },
  error:function(){

    console.log("somethign wegnt wroing");
  }


})

}

load_data();

$(document).on('click',"#remove_item_btn",function(e){


    

var product_id = parseInt($(this).data('product_id'));
console.log("I am giving clicks");
 $.ajax({
url:"actions.php?action=delete_cart_item",
method:"POST",
data:{product_id:product_id},
dataType:'json',
success:function(data){
        load_data();
    
}



})
})



$("#clear_cart_btn").click(function(e){
    

    $.ajax({
  url:"actions.php?action=clear_cart",
  method:"GET",
  dataType:'json',
  success:function(data){




    load_data();


  }

})

});
$(document).on('change',"#cart_quantity",function(){

    var quantity = parseInt($("#cart_quantity").val());

    if(quantity<=1){
        quantity = 1
    }
    else{

        console.log("I am working");

        var quantity = parseInt($("#cart_quantity").val());

       var product_id = parseInt($(this).data('product_id'));
        $.ajax({
  url:"actions.php?action=update_cart_item",
  method:"POST",


  data:{product_id:product_id, quantity:quantity},
  dataType:'json',
  success:function(data){


    load_data();

   


  },

  error:function(e){
    console.log(e);
  }
})

    }
    
})






  


})



    
</script>

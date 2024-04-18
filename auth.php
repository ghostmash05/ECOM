
<?php include_once "components/header.php";

$redirect = "dashboard.php";

if(isset($GET["from"])){

  $redirect  = htmlspecialchars($GET["from"]);




}

if(isset($_SESSION["email"])){

  header('Location: dashboard.php');
exit();

}




?>





<div class="flex min-h-full items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
  <div class="w-full max-w-sm space-y-10">
    <div id="loginp">
        <div>
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Shoes">
      <h2 class="mt-10 mb-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
</div>
    <form id="login_form" class="space-y-6" action="#" method="POST">
        <div class="mb-4">
         
          
            <p class="mb-4  border-l-4   p-3 font-md" style="display:none" id="login_alert_msg"> </p>
            
          


            <div class="relative mt-2 rounded-md shadow-sm">
              
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                  <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                  <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                </svg>

               
                
                
              </div>
              <input type="email" name="email" id="email" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Your Email" required>
         </div>

         <div class="mb-4">
         
          <div class="relative mt-2 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
              </svg>
              
              
              
            </div>
            <input type="password" name="password" id="password" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Password" required>
       </div>
      </div>

      <div class="mt-8 mb-4 flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-indigo-600">
          <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
        </div>

        <div class="text-sm leading-6">
          <a id="forgot_password_lnk" class="font-semibold text-yellow-600 hover:text-indigo-500">Forgot password?</a>
        </div>
      </div>

      <div>
        <button type="submit" id="singin_btn" class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-3 text-md font-semibold leading-6 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      </div>

      
    </form>

    <p class="mt-4 text-center text-sm leading-6 text-gray-500">
      Not a member?
      <a href="#" id ="singup_now" class="font-semibold text-yellow-600 hover:text-indigo-500">Signup Now </a>
    </p>
</div>
</div>
<div id="reset_password">
  <div>
<img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Shoes">
<h2 class="mt-10 mb-10 text-center text-2xl font-bold leading-9 text-gray-900">Reset your password</h2>
</div>
<form  id ="form_reset_password" class="space-y-6" action="actions.php?action=forgot_password" method="POST">
  
   <div class="mb-4">
   <p class="mb-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-3 font-md" style="display:none" id="forgot_alert_msg"> </p>

   
    <div class="relative mt-2 rounded-md shadow-sm">
      <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
          <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
        </svg>
        
        
        
      </div>
      <input type="email" name="email" id="email" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Email" required>
      
 
    </div>
    
</div>



 
  <button id="forgot_password_btn" type="submit"  class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-3 text-md font-semibold leading-6 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Retrive Password</button>
  
</form><p class="mt-4 text-center text-sm leading-6 text-gray-500">
    Want to login?
     <a id ="login_now_two"  class="font-semibold text-yellow-600 hover:text-indigo-500">Login  Now </a>
   </p></div>
<div id="singup">

  <div>
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 mb-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create an account</h2>
</div>

<form id="singup_form" class="space-y-6" action="actions.php?action=register" method="POST">
      <div class="relative -space-y-px rounded-md shadow-sm">
        <div class="mb-4">

          <p class="mb-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-3 font-md" style="display:none" id="register_alert_msg"> </p>

         
          <div class="relative mt-4 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
              </svg>
              
              
            </div>
            <input type="full_name" name="full_name" id="full_name" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Full Name" required>
       </div>

       <div class="mb-4">
         
        <div class="relative mt-4 rounded-md shadow-sm">
          <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
              <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
            </svg>
            
            
            
          </div>
          <input type="username" name="username" id="username" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Username" required>
     </div>
        <div class="mb-4">
         
          <div class="relative mt-4 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
              </svg>
              
              
              
              
            </div>
            <input type="email" name="email" id="email" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Your Email" required>
       </div>

       
       <div class="mb-4">
         
        <div class="relative mt-4 rounded-md shadow-sm">
          <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
              <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
            </svg>
            
            
            
          </div>
          <input type="password" name="password" id="password" minlength=8 maxlength=20  class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Password" required>
     </div>

     <div class="mb-4">
         
      <div class="relative mt-4 rounded-md shadow-sm">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
          </svg>
          
          
          
        </div>
        <input type="password" name="cnf_password" id="cnf_password" minlength=8 maxlength=20 class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Confirm Password" required>
   </div>
 

 <div class="mb-4">
         
  <div class="relative mt-4 rounded-md shadow-sm">
    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
        <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
      </svg>
      
      
      
    </div>
    <input type="tel" name="phone" id="phone" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Your Phone number" required>
</div>

      <div>
        <button id ="singup_btn" type="submit" class="mt-10 flex w-full justify-center rounded-md bg-yellow-500 px-3 py-3 text-sm font-semibold leading-6 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Signup</button>
      </div>

      
    </form>

    <p class="mt-4 text-center text-sm leading-6 text-gray-500">
      Already a member?
      <a id ="login_now"  class="font-semibold text-yellow-600 hover:text-indigo-500">Login  Now </a>
     </p>

</div>
</div>



    
  </div>
</div>


<?php include_once "components/footer.php"  ?>

<script>
  $(document).ready(function(){
  
    $("#singup").hide();
    $("#reset_password").hide();
    
    

    $("#singup_now").click(function(e){
      e.preventDefault();
      $("#reset_password").hide();
      $("#singup").show();
      $("#loginp").hide();
      



});

$("#login_now").click(function(e){
  e.preventDefault();
  $("#reset_password").hide();
  $("#loginp").show();
  $("#singup").hide();


})

$("#login_now_two").click(function(e){
  e.preventDefault();
  $("#reset_password").hide();
  $("#loginp").show();
  $("#singup").hide();


})



$("#forgot_password_lnk").click(function(e){
  e.preventDefault();
  $("#reset_password").show();
  $("#singup").hide();
  $("#loginp").hide();


})




$("#singin_btn").click(function(e){

e.preventDefault();
console.log("trying to post");
$.ajax({
  url:"/actions.php?action=login",
  method:"POST",
  data:$("#login_form").serialize(),
  dataType:'json',
  success:function(data){
    
    
    var data = JSON.parse(JSON.stringify(data));

    console.log(data);

    if (data["status"]==="error"){
  
      $("#login_alert_msg").removeClass("bg-green-100 border-green-500 text-green-700");

      $("#login_alert_msg").addClass("bg-orange-100 border-orange-500 text-orange-700");
      $("#login_alert_msg").show();

      $("#login_alert_msg").html(data["msg"]);
      


    }

    else{
      $("#login_alert_msg").removeClass("bg-orange-100 border-orange-500 text-orange-700");

      $("#login_alert_msg").addClass("bg-green-100 border-green-500 text-green-700");
      $("#login_alert_msg").show();
      $("#login_alert_msg").html(data["msg"]);
     
    }


  }
})



})





$("#forgot_password_btn").click(function(e){

e.preventDefault();

$.ajax({
  url:"/actions.php?action=forgot_password",
  method:"POST",
  data:$("#form_reset_password").serialize(),
  dataType:'json',
  success:function(data){
    
    
    var data = JSON.parse(JSON.stringify(data));
    

   

    

    if (data["status"]==="error"){
  
      $("#forgot_alert_msg").removeClass("bg-green-100 border-green-500 text-green-700");

      $("#forgot_alert_msg").addClass("bg-orange-100 border-orange-500 text-orange-700");
      $("#forgot_alert_msg").show();

      $("#forgot_alert_msg").html(data["msg"]);
      


    }

    else{
      $("#forgot_alert_msg").removeClass("bg-orange-100 border-orange-500 text-orange-700");

      $("#forgot_alert_msg").addClass("bg-green-100 border-green-500 text-green-700");
      $("#forgot_alert_msg").show();
      $("#forgot_alert_msg").html(data["msg"]);

      
    }


  }
})



})



$("#singup_btn").click(function(e){

e.preventDefault();

$.ajax({
  url:"/actions.php?action=register",
  method:"POST",
  data:$("#singup_form").serialize(),
  dataType:'json',
  success:function(data){
    
    
    var data = JSON.parse(JSON.stringify(data));

    


    

    if (data["status"]==="error"){
  
      $("#register_alert_msg").removeClass("bg-green-100 border-green-500 text-green-700");

      $("#register_alert_msg").addClass("bg-orange-100 border-orange-500 text-orange-700");
      $("#register_alert_msg").show();

      $("#register_alert_msg").html(data["msg"]);
      


    }

    else{
      $("#register_alert_msg").removeClass("bg-orange-100 border-orange-500 text-orange-700");

      $("#register_alert_msg").addClass("bg-green-100 border-green-500 text-green-700");
      $("#register_alert_msg").show();
      $("#register_alert_msg").html(data["msg"]);

      
    }


  }
})


})



  })



 

  
</script>

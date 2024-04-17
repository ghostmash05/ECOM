<?php 
include_once "components/header.php" ;


$msg = "";
if(isset($_GET["token"]) && isset($_GET["email"] )){

    $token = mysqli_real_escape_string($conn, $_GET["token"]);
    $email = mysqli_real_escape_string($conn, $_GET["email"]);

    
    
    

    $sql_token_check = $conn->prepare("SELECT * from users WHERE email = ? and token = ? and token_expire > NOW()");
    $sql_token_check->bind_param("ss", $email, $token);
    $sql_token_check->execute();
    $res_token_check = $sql_token_check->get_result();

    if ($res_token_check->num_rows>0){

    if(isset($_POST["password"])){ 
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $cnf_password = mysqli_real_escape_string($conn, $_POST["cnf_password"]);
   
      
      if(!isset($_POST["password"])  ||  $_POST["password"]==="" ){
            $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'>Sorry, your pasword is empty </p>";
    }

    elseif(!isset($_POST["cnf_password"])  ||  $_POST["cnf_password"]==="" ){
        $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'> Sorry, your Confirm password is empty </p>";
}


    

    elseif(!isset($_POST["password"]) || $_POST["cnf_password"]==="" ){
        $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'> Sorry, your pasword and confirm password does not match </p>";
        

    }

     else{
        $password = md5($password);

        $sql_update_password = $conn->prepare("UPDATE `users` SET `password` = ? WHERE email = ? ");
        $sql_update_password->bind_param("ss", $password, $email);
       
        if($sql_update_password->execute()){

            $sql_remove_token = $conn->prepare("UPDATE `users` SET `token` = '',token_expire='' WHERE email = ? ");
            $sql_remove_token->bind_param("s", $email);
            $sql_remove_token->execute();



            $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-green-100 border-green-500 text-green-700'> Your password has been updated. Please login . </p> ";
        }

        else{

            $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'> Sorry, something went wrong. </p>";
        }
       
     
    
    }
}
    }
    else{
      $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'>  Sorry, The Pasword Reset link is invalid or expired. </p>";
    }

}

else{
    $msg = "<p class='mb-4  border-l-4   p-3 font-md bg-orange-100 border-orange-500 text-orange-700'> Sorry Invalid Link.  </p> ";
}








    
    
    ?>


<div class="flex min-h-full items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
  <div class="w-full max-w-sm space-y-10">
    <div id="login">
        <div>
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Shoes">
      <h2 class="mt-10 mb-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Reset your password</h2>
</div>
    <form  class="space-y-6" action="password_reset.php?email=<?= $email;?>&token=<?= $token;?>" method="POST">
        
         <div class="mb-4">
            <?= $msg;?>
          <div class="relative mt-2 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
              </svg>
              
              
              
            </div>
            <input type="password" name="password" id="password" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Password" required>
       </div>
      </div>
      <div class="mb-4">
         
         <div class="relative mt-2 rounded-md shadow-sm">
           <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
               <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
             </svg>
             
             
             
           </div>
           <input type="password" name="cnf_password" id="cnf_password" class="block w-full rounded-md border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-md sm:leading-6" placeholder="Confirm Password" required>
      </div>
     </div>

      
       
        <button type="submit"  class="flex w-full justify-center rounded-md bg-yellow-500 px-3 py-3 text-md font-semibold leading-6 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Password</button>
      </div>

      
    </form>

    
</div>
</div>
</div>

 <?php include_once "components/footer.php"  ?>
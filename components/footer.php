<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
console.log("trying to post");
$.ajax({
  url:"/actions.php?action=forgot_password",
  method:"POST",
  data:$("#form_reset_password").serialize(),
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
$(document).ready(function() {
$("#username").focus(function(){
$("#username").removeClass("error").removeClass("ok");
if($("#pwd").val()){
var input=$("#pwd");
var pwdlen=input.val();
if(pwdlen.length<=7){
$("span").remove();
$("#pwd").after("<span class='error'>Password should be atleast 8 characters long</span>");
}
}
else{
$("#pwd").removeClass("error").removeClass("ok").removeClass("info");
$("span").remove();
}
$("#username").after("<span class='info'></span>");
});
/*Password function*/
$("#pwd").focus(function(){
$("#pwd").removeClass("error").removeClass("ok");
$("span").remove();
if($("#username").val()){
var input=$("#username");
var validinput=/^[a-zA-Z0-9 ]*$/;
var is_username=validinput.test(input.val());
if(!is_username){
$("#username").after("<span class='error'>Username is not in alphanumeric format</span>");
}
}
else{
$("#username").removeClass("error").removeClass("ok").removeClass("info");
}
$("#pwd").after("<span class='info'></span>");
});
$("#s1").click(function(event){
event.preventDefault();
$("span").remove();
var uname=$("#username").val();
var pwd=$("#pwd").val();
if(uname=="" || pwd=="")
{
 if(uname=="")
 {
    $("#username").after("<span class='error'>Username should be provided</span>");
 }
 if(pwd=="")
 {
    $("#pwd").after("<span class='error'>Password should be provided</span>");
 }
}
else
{
$.ajax({
  url: "login.php",
  type: "POST",
  data: {username:uname,password:pwd},
  success:function(data){
  if(data=="Login successful")
  {
    window.location.href="profile.php";  
  }
  else if(data=="Admin")
  {
	  window.location.href="adminfinal.php";
  }
  else
  {
	  alert("Username/password are invalid");
  }
  }
});
}
});
});

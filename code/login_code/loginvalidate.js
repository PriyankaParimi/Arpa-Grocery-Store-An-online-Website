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
$("#username").after("<span class='info'>The username field must contain only alphabetical or numeric characters</span>");
});
/*Password function*/
$("#pwd").focus(function(){
$("#pwd").removeClass("error").removeClass("ok");
$("span").remove();
if($("#username").val()){
var input=$("#username");
var validinput=/^[a-zA-Z0-9]*$/;
var is_username=validinput.test(input.val());
if(!is_username){
$("#username").after("<span class='error'>Username is not in alphanumeric format</span>");
}
}
else{
$("#username").removeClass("error").removeClass("ok").removeClass("info");
}
$("#pwd").after("<span class='info'>The password field should be at least 8 characters long.</span>");
});
$("#submit").click(function(){
$("span").remove();
if($("#username").val()=="")
{
$("#username").after("<span class='error'>Username should be provided.</span>");
}
if($("#pwd").val()=="")
{
$("#pwd").after("<span class='error'>Password should be provided.</span>");
}
else
{
$username=$("#username").val();
$pwd=$("#pwd").val();
$.ajax({
type:"post",
url:"login.php",
data:{name:username},
success:function(response){
if(response=="ok")
{
alert("success");
}
}
});
}
});
});
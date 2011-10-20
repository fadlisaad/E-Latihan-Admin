<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Papermashup.com | jQuery PHP Username Checker</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
$(document).ready(function(){
$('#username').keyup(username_check);
});
	
function username_check(){	
var username = $('#username').val();
if(username == "" || username.length < 4){
$('#username').css('border', '3px #CCC solid');
$('#tick').hide();
}else{

jQuery.ajax({
   type: "POST",
   url: "check.php",
   data: 'username='+ username,
   cache: false,
   success: function(response){
if(response == 1){
	$('#username').css('border', '3px #C33 solid');	
	$('#tick').hide();
	$('#cross').fadeIn();
	}else{
	$('#username').css('border', '3px #090 solid');
	$('#cross').hide();
	$('#tick').fadeIn();
	     }

}
});
}



}

</script>

<style>
#username{
	padding:3px;
	font-size:18px;
	border:3px #CCC solid;
}

#tick{display:none}
#cross{display:none}
	

</style>
</head>

<body>

<?php include '../includes/header.php';?>

Here are some usernames that have been put in the database:<br/><br />

Ashley, John, Mark, Paul, Rich, Luke, Simon, Adam<br/><br/>

Username: <input name="username" id="username" type="text" />
<img id="tick" src="tick.png" width="16" height="16"/>
<img id="cross" src="cross.png" width="16" height="16"/>


<?php include '../includes/footer.php';?>

</body>
</html>
<?php

include_once 'inc/php/config.php';
include_once 'inc/php/functions.php';

//setup some variables/arrays
$action = array();
$action['result'] = null;

$text = array();

//check if the form has been submitted
if(isset($_POST['signup'])){

	//cleanup the variables
	//prevent mysql injection
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	
	//quick/simple validation
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'You forgot your username'); }
	if(empty($password)){ $action['result'] = 'error'; array_push($text,'You forgot your password'); }
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'You forgot your email'); }
	
	if($action['result'] != 'error'){
				
		$password = md5($password);	
			
		//add to the database
		$add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
		
		if($add){
			
			//get the new user id
			$userid = mysql_insert_id();
			
			//create a random key
			$key = $username . $email . date('mY');
			$key = md5($key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')");	
			
			if($confirm){
			
				//include the swift class
				include_once 'inc/php/swift/swift_required.php';
			
				//put info into an array to send to the function
				$info = array(
					'username' => $username,
					'email' => $email,
					'key' => $key);
			
				//send the email
				if(send_email($info)){
								
					//email sent
					$action['result'] = 'success';
					array_push($text,'Thanks for signing up. Please check your email for confirmation!');
				
				}else{
					
					$action['result'] = 'error';
					array_push($text,'Could not send confirm email');
				
				}
			
			}else{
				
				$action['result'] = 'error';
				array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
				
			}
			
		}else{
		
			$action['result'] = 'error';
			array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
		
		}
	
	}
	
	$action['text'] = $text;

}

?>

<?php
include 'inc/elements/header.php'; ?>

<?= show_errors($action); ?>

<form method="post" action="">

    <fieldset>
    
    	<ul>
    		<li>
    			<label for="username">Username:</label>
    			<input type="text" name="username" />
    		</li>
    		<li>
    			<label for="password">Password:</label>
    			<input type="password" name="password" />
    		</li>
    		<li>
    			<label for="email">Email:</label>
    			<input type="text" name="email" />	
    		</li>
    		<li>
    			<input type="submit" value="Signup Now" class="large blue button" name="signup" />			
    		</li>
    	</ul>
    	
    </fieldset>
    
</form>			
		
<?php
include 'inc/elements/footer.php'; ?>
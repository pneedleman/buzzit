<?
ob_start();

if (!empty($display_form)){
  $display_form = "on";
  }
if (!empty($_POST["pass"])) {

    $password = $_POST["pass"];
    $email = $_POST["login"];
    
    
	/*	    
    	echo $password; 
    	echo "<br>";
    	echo $email;
    	echo "<br><br><br>";
   */ 	
     
      include 'mysql_connect.php';

	  $strSQL= "SELECT email, aes_decrypt(password, tnow), count, ID, type, `lock` FROM users WHERE email='$email';";
	  
    $result= @mysql_query($strSQL);


while ($row = mysql_fetch_array ($result)){
	
	$v_email = $row[0];
	$v_pass =  $row[1];
	$v_count = $row[2];
	$v_id =    $row[3];
	$v_type =  $row[4];
	$v_lock =  $row[5];
		
		}  
		



if (empty($v_email)){

   echo "<span class='feedback'>E-mail address does not exist. Please Register </span>";	
      }     
  else
  {
  
  if ($v_lock == 'y'){

   echo "<span class='feedback'>You can not login until you verify your email address. Please click on the link provided in the email you received. </span>";	
      }     
  else
  {

  if ($v_count >3){
	Echo "<span class='feedback'>Your account is locked out. Please contact the admin if you feel like this may be a mistake. </span>";
	}	
	else {
	
	// echo "vpass:" . $v_pass . " " . $password;
	
 	if ($v_pass == $password) {
 	
 	  $strSQL3 = "UPDATE `users` SET `count` = '0' WHERE `email`  = '$email';";
 	  
 	  mysql_query($strSQL3);
 	
 	  $_SESSION['uid'] = $v_id;
 	  $_SESSION['type'] = $v_type;
 	  
 		//echo $_SESSION['uid'];
		
		    header("Location: success.php");
		 
	      //exit;
 		}
 		else 
 		{ 
 		 Echo "<span class='feedback'>Im sorry your login or password was incorrect. </span>";
			
			$v_count = $v_count + 1;
			$strSQL2 = "UPDATE `users` SET `count` = '$v_count' WHERE `email`  = '$email';";
			
			echo "<br>";
			
			$v_attempts = 4 - $v_count;
			echo "<span class='feedback'>You have " . $v_attempts . " more attemps before you will be locked out.</span>";
			  
 		  	mysql_query($strSQL2);
 		
	      
        }
 		  } 	
  	}
  }
} 

?>

<h3>Login<img src="images/gravatar.jpg" width="40" height="40" alt="image" class="float-right" /></h3>			

			
			<form method="post" action="">
				    
					Login:<span class="small">your email (i.e. johnsmith@gmail.com)</span></br>
					<input type="text" id="login" name="login" size ="25" value="<?php if (isset($v_mail)) { echo $v_mail; } ?>" />
					
					Password:<br /><input type="password" id="pass" name="pass" value="" / size="25">
					<br />
					<input type="submit" class="button" value="Sign In" />
					<div> <a href="register.php">register</a> | <a href="forgot.php">forgot password?</a></div>			
	
			 <br />
						Register to create and modify your buzz schedules. 
				</form>
			
		
						
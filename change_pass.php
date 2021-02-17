<? include 'head.php'; ?>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
	<? if(isset($_SESSION['uid'])) { ?>
					   
		<div id="main">
			
		<?
		

			//function to check password stength
		    function check_password($password) {

			 if(//ctype_alnum($password) // numbers & digits only
			 strlen($password)>5 // at least 8 chars
			&& strlen($password)<17 // at most 16 chars
			&& preg_match('`[A-Z]`',$password) // at least one upper case
			&& preg_match('`[a-z]`',$password) // at least one lower case
			&& preg_match('`[0-9]`',$password) // at least one digit
			){
			// valid
			  return true;

			}else{
			// not valid
			  return false;
			  }  
			}
		
			
 
		 if (!empty($_POST['pw1']) && !empty($_POST['pw2']) &&  !empty($_POST['old_pw'])){
		   
			include 'mysql_connect.php';

			$strSQL= "SELECT Aes_Decrypt(password, tnow) FROM users WHERE ID='$session_id';";
			  
			$result= @mysql_query($strSQL);


			while ($row = mysql_fetch_array ($result)){
			  
			$v_pw =  $row[0];
			
			}
			
			if ( $_POST['pw1'] <> $_POST['pw2']){
			
			  echo "<span class='feedback'>Your new passwords don't match </span>" ; 
			  }
			 else {
			
			 if (check_password($_POST['pw1'])== false){
				echo "<span class='feedback'>Password strength not met. Password must be 6-16 characters <br> and contain at least one uppercase, one lowercase, and numberic value. </span>" ;
				 }
			else {
			
			 if ($_POST['old_pw'] <> $v_pw) {
				echo "<span class='feedback'>Your old password does not match our records! </span>";
			   }
			 else 
			 {
			  
			  $pw1 = $_POST['pw1']; 
			 
			  	include 'mysql_connect.php';
		   
				 //$strSQL="INSERT INTO `users` (`FName`, `LName` `email`, `phone`, `password`, date) VALUES ('$fname', '$lname', '$email', '$phone', aes_encrypt('$password', current_timestamp()), current_timestamp());";
					   
				 $strSQL1="UPDATE `users` SET `password` = aes_encrypt('$pw1', current_timestamp()), `tnow` = current_timestamp() WHERE ID='$session_id';";
					
					$result = mysql_query($strSQL1);
					
					if (!$result) {
				die("Invalid query:<span class='feedback'>  " . mysql_error(). "</span>");
			   }
			   
			  echo "<span class='feedback'> Your password has been successfully been changed. </span>";
		  
			 }
			}
		   }
		  }
		 



		?>
		
	
		
			<h2>Change Password</h2>
			

			<form  name="sendmessage" method="post" action="change_pass.php">
				<table>		
								  			
					<tr>
					  <td style="text-align:right;"><label>Old Password* </label>
					  <span class="small">
						</span></td>
					  <td><input type="password" name="old_pw" size=30></td>
					</tr>
					
					<tr>
					  <td style="text-align:right;"><label> New password*</label>
					  <span class="small">
						</span></td>
					  <td><input type="password" name="pw1" size=30></td>
					</tr>
					
					<tr>
					  <td style="text-align:right;"><label> New password Again*</label>
					  <span class="small">
						</span></td>
					  <td><input type="password" name="pw2" size=30></td>
					</tr>
				
					<tr>
						<td><input type="hidden" name="hid" value ="<?php if (isset($session_id)) { echo $session_id; } ?>" ></td>
						<td><input type="submit" value="Submit" class="button"> <input type="reset" value="Reset" class="button"></td>
					</tr>	
				
				
				
				</table>
			</form>
			
			
		<!-- main ends -->	
		</div>
		
		
				
		<div id="sidebar">
		
			<? include 'login_menu.php'; ?>	
			
			
		<!-- sidebar ends -->		
		</div>		
		
	<?	}
	 else{ 	echo "<div id=main>you are not logged in. Sorry</div>";   } ?>

		
	<!-- content ends-->	
	</div>
	
	
	<!-- footer starts -->		
	<div id="footer">
						
	  <? include 'footer.php'; ?>
	
	<!-- footer ends-->
	</div>

<!-- wrap ends here -->
</div>

</body>
</html>

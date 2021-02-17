<? include 'head.php'; ?>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
		<div id="main">

				<?	
if (!empty($_POST["email"])) {

    $email = $_POST["email"];
    

    
		    
    //	echo $password; 
   // 	echo "<br>";
    //	echo $email;
   // 	echo "<br><br><br>";
    	
     
   include 'mysql_connect.php';

	  $strSQL= "SELECT email, aes_decrypt(password, tnow) FROM users WHERE email='$email';";
	  
    
	
    $result= @mysql_query($strSQL);


   while ($row = mysql_fetch_array ($result)){
	
	  $v_email = $row[0];
	  $v_pass =  $row[1];
	
	
  }
	
	
	

	
  if (empty($v_email)){
    
       $v_email = "none";
       echo "<span class='response'>This email address was not found in out database. Please Try again. </span>"; 
    
    }
    
    
 
    
    else  {
   

  
    $message = "Your forgotten password for buzzit2me.com is: '" . $v_pass . "' (without the quotes). \nYou may login to our site at http://vtpaul.myftp.org/php/index.php. \n\n\nPlease do not respond to this message. "; 
    $subject = "vtpaul.myftp.org Forgotten Password";
    
    mail($v_email, $subject, $message, "From:" . 'admin@buzzi2me.com'); 
      
      echo "<h2> Forgot Password </h2> <p>An email with your password has been sent to the provided email address [<a href='mailto:" . $v_email ."'>" .  $v_email  . "</a>] </p> ";
  
       $form_display = "off";  	
    
      }
  
   }
   
  
?>
 
<?php if (!empty($form_display)) {

 }
 else
 {
?>
		<h2> Forgot Password </h2>

		<p>Please enter the e-mail address you used to register your account</p>
		<form method="POST" action="forgot.php">


		  <div align="center">
			<table border="0">
			  <tr>
				<td>E-mail:
				  <input type="text" name="email" value="<?php if (isset($email)) { echo $email; } ?>" size=40>
				  <input type = "submit" value="Submit"  class = "button" /></td>
			  </tr>
			</table>
		  </div>
		</form>


		<? } ?>
					

		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />



		<!-- main ends -->	
		</div>
				
		<div id="sidebar">
		
			<? include 'login.php'; ?>	
			
			
		<!-- sidebar ends -->		
		</div>		
		
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

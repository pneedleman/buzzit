<? include 'head.php'; ?>

<script language="javascript" >

function Selected(method) {
  
  //se=document.getElementById("contact");
  //alert(method);
  
   // ma=document.getElementById("mail");
    em=document.getElementById("emaildiv");
    ph=document.getElementById("phonediv");
  
 // if (method=="mail") ma.style.display="block";
 //   else ma.style.display="none";
  if (method=="none")em.style.display="none";
   else em.style.display="none";
  if (method=="email") em.style.display="";
    else em.style.display="none";
  if (method=="text") ph.style.display="" ;
    else ph.style.display="none";

}


function checkform(){

	 con=document.getElementById("contact").value;
	 ema=document.getElementById("email").value;
	 dte=document.getElementById("date").value;


	 
	if (con == "none")
	{
		// something is wrong
		alert('Please select a valid value for Contact Method');
		return false;
	}
//	else if (ema == "")
//	{
//		// something else is wrong
//		alert('Please enter a valid email');
//		return false;
//	}
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}
	
</script>

<script language="JavaScript" src="calendar2.js"></script>

</head>

<body>
<!-- wrap starts here -->
<div id="wrap">

    <? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
			<div id="main" style="float: left; width: 550px;	padding: 0; margin: 0px 0px 0px 200px;	display: inline;">
	
<?
if (!empty($_POST["email"]) || !empty($_POST["pw1"]) || !empty($_POST["lname"]))

  {
		   
    	    $email    = $_POST["email"];
			$fname    = $_POST["fname"];
			$lname    = $_POST["lname"];		
			$phone    = $_POST["phone"];
			$password = $_POST["pw1"];	
			$chkpass  = $_POST["pw2"];
			$timezone = $_POST["timezone"];
			$carrier  = $_POST["carrier"];

			
			
			/*

	if (
      !ctype_alnum($password) // numbers & digits only
      && strlen($password)>7 // at least 8 chars
      && strlen($password)<17 // at most 16 chars
      && preg_match('`[A-Z]`',$password) // at least one upper case
      && preg_match('`[a-z]`',$password) // at least one lower case
      && preg_match('`[0-9]`',$password) // at least one digit
      ){
      // valid
      echo "<font color = 'red'> Password strength did not meet our criteria. </font> <br /><br /> ";
      }
      else {

*/
	
  
    if ($_POST["fname"]== null){
        echo "<span class='feedback'>First Name Required</span>" ;
     }
    else {
  
  		
	  if (check_password($password)== false){
        echo "<span class='feedback'>Password strength not met. Password must be 6-16 characters <br> and contain at least one uppercase, one lowercase, and numberic value. </span>" ;
     }
    else {
      
    
			
			
			if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$",$email)) {
			echo "<span class='feedback'>Please Enter a Valid Email address </span>" ;
			  }
      else {
			
			
			if ($password != $chkpass) {
      
        echo "<span class='feedback'>Password did not match. Please re-enter password. </span>";
        
        $display_form = "yes";
        
		} 
	  }
	
 		
			
			include 'mysql_connect.php';

         
        //insert default registration infg
         $strSQL="INSERT INTO `users` ( `FName` , `LName` , `email` , `phone` , `password` , `tnow` , `count`, `register_on`, `timezone`, `carrier` ) VALUES ('$fname', '$lname', '$email', '$phone', aes_encrypt('$password', current_timestamp() ), current_timestamp(), '0', current_timestamp(), '$timezone', '$carrier');";
			
			  $result = mysql_query($strSQL);
			
		 	
       if (!$result) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }

         
       
       
       
       //get new user id
         //insert default registration infg
         $strSQL1="SELECT id from `users` where `email`='$email';";;
			
			  $result1 = mysql_query($strSQL1);
			  
			    while ($row = mysql_fetch_array ($result1)){
  
            $to = $row[0];

          }		
       
           echo "Thanks for registering! Your information has been submitted. <br>";
		echo "You may now return to the <a href='index.php'>login page.</a>";		
		
		echo "<br>";
		echo "<br>";
	
		echo "First Name:<b> " . $fname . "</b><br>" ;
		echo "Last Name:<b> 	" . $lname . "</b><br>" ;
		echo "Phone: <b>  	" . $phone . "</b><br>" ;
		echo "Carrier: <b>  " . $carrier . "</b><br>";
		echo "Email: <b> <a href=mailto:" . $email  . ">" . $email . "</a></b><br>" ;
		echo "Timezone <b>  " . $timezone . "</b><br>";
		echo "Password: <b>Not shown for security purposes</b>";
		
		
		
    $salt = 'specsalt';
    
     $key = md5($salt);
				 
	$message = $fname . ", \n\nThanks for registering. You must by click the link below before you are able to login. http://buzzit2me.com/index.php?eid=$email&key=$key" . "\n\n\nPlease do not respond to this message. "; 
    $subject = "Thank you for registering with buzzit2me.com";
    
    mail($email, $subject, $message, "From:" . 'admin@buzzit2me.com'); 
      
      
      echo "<br><br>An email with this information will be sent to your email address within the next 5 minuites. ";
      echo "If it does not come within 5 min, check your junk mailbox and add buzzit2me.com to your spam folder. If you need further assistance please contact <a href='mailto:help@buzzit2me.com'>help@buzzit2me.com</a>";
		echo "<br><br> <b>Please note:</b> you must verify your email address by clicking on the link sent to you, before you can login.  </a> ";

    
		echo "<br>";
		echo "<br>";		
		
	
		$form = 'off';
		
		     }
       }
     }
   

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


					if ($form == "off"){ 
						

			}else{

    ?>
		
	

	<h2> Register </h2> 		
<form method="post" action="register.php" >


   
  <div align="center">
     
        <table>    
         <p style="font-size:16px; text-align:left;">Please enter your info: (* is required)</p>  
		  <tr>
			<td style="text-align:right;"><label>First Name*</label>
			 <span class="small"></span>
			</td>
			<td><input type="Text" name="fname" id="fname" value="<?php if (isset($fname)) { echo $fname; } ?>"></td>
	    </tr>
		
		  <tr>
			<td style="text-align:right;"><label>Last Name*</label>
			 <span class="small"></span>
			</td>
			<td><input type="Text" name="lname" id="lname" value="<?php if (isset($lname)) { echo $lname; } ?>"></td>
	    </tr>
  
		<tr>
			<td style="text-align:right;"><label>Email* </label>
			 <span class="small"> Enter Valid E-mail Address. This will be your login name</span>
			</td>
			<td><input type="Text" name="email" id="email" value="<?php if (isset($email)) { echo $email; } ?>" size=40 ></td>
		</tr>
							  
		  	<tr>
			 <td style="text-align:right;"><label> Default Cell Phone # </label>
						<span class="small"> Enter default cell number and choose carrier (if applicable)
						</span></td>
						<td><input type="Text" name="phone" value="<?php if (isset($phone)) { echo $phone; } ?>" >
					   	<select name="carrier" id="carrier">
							<option select=true>Verizon</option>
							<option>AT&T </option>
							<option>Sprint</option>
							<option> Other </option>
						</select>
			</td>
            </tr>
      
			 <td style="text-align:right;"><label> Default Timezone </label>
						<span class="small"> Select your default timezone
						</span></td>
				<?   
						echo  "<td><select name='timezone'>";
						//get data from timezone table to populte select box
						
						include 'mysql_connect.php';
						$strSQL1 = "SELECT timezone, description FROM timezone"; 
						$result= @mysql_query($strSQL1);
	       
							while ($row = mysql_fetch_array ($result)){
	
								$v_tz = $row[timezone]; 
								$v_desc = $row[description];
								
			                    echo "<option value=" . '"' . $v_tz .'"'. ">" . $v_desc . " (" . $v_tz . ")" . "</option>";
							}
						
						echo  "</select>";
						echo  "</td></tr>";
					?>
								  	
			
			
		<tr>
			<td style="text-align:right;"><label>Password* </label>
			 <span class="small">Must be between 6-16 characters and contain at least one uppercase, one lowercase, and numberic value.</span>
			</td>
			<td><input type="password" name="pw1" id="pw1"></td>
		</tr>
		<tr>
			<td style="text-align:right;"><label>Re-type Password* </label>
			 <span class="small"></span>
			</td>
			<td><input type="password" name="pw2" id="pw2"></td>
		</tr>
			
		    <tr>	
			   <td></td>
				<td><br /><input name="Submit" type="submit" value="Submit Registration" class = "button" />
			  <input name="reset" type="reset" value="Reset" class = "button" /></td>
			</tr>
	
         </table>
  </div>
</form>		


  <? } ?>
		
		
	<!-- main ends -->	
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

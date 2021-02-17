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
	
		
		if (!empty($_POST["hid"])) {
		
			$fname    = $_POST["fname"];
			$lname    = $_POST["lname"];		
			$phone    = $_POST["phone"];
			$carrier  = $_POST["carrier"];
			$tz 	  =	$_POST["timezone"];

   
			
         include 'mysql_connect.php';
		
		//  update profile information
        $strSQL="UPDATE `users` SET fname = '$fname', lname = '$lname', phone = '$phone' , carrier = '$carrier' ,  timezone = '$tz' WHERE id ='$session_id'";
						
			$result = mysql_query($strSQL);
			
			
			if (!$result) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }

				
			
	
		echo "<span class='feedback'>Thank you! Your information has been updated.</span>";
			
				
		} //end update
		
		
		 include 'mysql_connect.php';

		//display information in form
		$strSQL= "SELECT fname, lname, email, phone, carrier, timezone  FROM users WHERE ID='$session_id';";
			  
		$result= @mysql_query($strSQL);


		while ($row = mysql_fetch_array ($result)){
			
			
			$v_fname =  $row[0];
			$v_lname = $row[1];
			$v_email = $row[2];
			$v_phone =  $row[3];
			$v_carrier = $row[4];
			$v_timezone = $row[5];
			}
		
      
   ?>

<form name="edit_profile" method="post" action="edit_prof.php">	
        <table>    
         <p style="font-size:16px; text-align:left;">Please enter your info: (* is required)</p>  
		  <tr>
			<td style="text-align:right;" width=150"><label>First Name*</label>
			 <span class="small"></span>
			</td>
			<td><input type="Text" name="fname" id="fname" value="<?php if (isset($v_fname)) { echo $v_fname; } ?>"></td>
	    </tr>
		
		  <tr>
			<td style="text-align:right;"><label>Last Name*</label>
			 <span class="small"></span>
			</td>
			<td><input type="Text" name="lname" id="lname" value="<?php if (isset($v_lname)) { echo $v_lname; } ?>"></td>
	    </tr>
  
		<!--tr>
			<td style="text-align:right;"><label>Email* </label>
			 <span class="small"> Enter Valid E-mail Address. This will be your login name</span>
			</td>
			<td><input type="Text" name="email" id="email" value="<?php if (isset($v_email)) { echo $v_email; } ?>" size=40 ></td>
		</tr-->
							  
		  	<tr>
			 <td style="text-align:right;"><label> Default Cell Phone # </label>
						<span class="small"> Enter default cell number and choose carrier (if applicable)
						</span></td>
						<td><input type="Text" name="phone" value="<?php if (isset($v_phone)) { echo $v_phone; } ?>" >
					   	<select name="carrier" id="carrier">
							<option <?php if ($v_carrier =='Verizon') {echo "selected=true"; } ?>>Verizon</option>
							<option <?php if ($v_carrier =='AT&T') {echo "selected=true"; } ?>>AT&T</option>
							<option <?php if ($v_carrier =='Sprint') {echo "selected=true"; } ?>>Sprint</option>
							<option <?php if ($v_carrier =='Other') {echo "selected=true"; } ?>>Other</option>
							
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
								
			                    //echo "<option value=" . '"' . $v_tz .'"'. ">" . $v_desc . " (" . $v_tz . ")" . "</option>";
								 echo "<option "; if ($v_timezone ==$v_tz) {echo "selected=true"; } echo " value=" . '"' . $v_tz .'"'. ">" . $v_desc . " (" . $v_tz . ")" . "</option>";
						
							}
						
						echo  "</select>";
						echo  "</td></tr>";
			
			?>
			 <tr>	
			   <td>   <input type="hidden" name="hid" value="hid"></td>
				<td><br /><input name="Submit" type="submit" value="Update" class = "button" />
			  <input name="reset" type="reset" value="Reset" class = "button" /></td>
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

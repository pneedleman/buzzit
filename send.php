<? include 'head.php'; ?>
<? session_start(); ?>
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

<?


//if user is not logged in but has a request id then send them back to send.php

if (!isset($session_id) && isset($_REQUEST['edit'])) {
	
	 header("Location: send.php");
	 
}


 //if user is logged in, display default info
if (isset($session_id)) {
	

	
	include 'mysql_connect.php';
	
	$strSQL= "SELECT email, phone, carrier, timezone FROM users WHERE id='$session_id';";
	  
    $result= @mysql_query($strSQL);


		while ($row = mysql_fetch_array ($result)){
			
			$v_email = 	  $row[0];
			$v_phone =    $row[1];
			$v_carrier =  $row[2];
			$v_timezone = $row[3];
		}  

}

			  
?>

<body>
<!-- wrap starts here -->
<div id="wrap">

    <? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
		<div id="main">
	
		
<?


  // if ID comes from request we want to grab it
	if (isset($_REQUEST['edit'])){ 
		$buzz_id = $_REQUEST['edit'];
		
	}

  //if ID comes from from update we want to grab it
   if (isset($_POST['buzz_id'])){ 
		$buzz_id = $_POST['buzz_id'];
   }
   
  
  //if the form is edited, updated data to DB
  if(isset($_POST['buzz_id'])) {
	  

	   
	   $date = $_POST['date'];
	   $cell = $_POST['cell'];
	   $date = $_POST['date'];
	   $hr = $_POST['time_hr'];
	   $min = $_POST['time_min'];
	   $AMPM = $_POST['time_AMPM'];
	   $subject = $_POST['subject'];
	   $body    = $_POST['message'];
	   $recur    = $_POST['recur'];
	   $timezone = $_POST['timezone'];


	   $contact_type = $_POST['contact'];
	   $time = $hr. ":" . $min . " " . $AMPM; 
	   
	   $datetime = $date . ' '. $time;
	   
	    
	  if ($contact_type == 'email') {
		  $contact_info = $_POST['email'];   
	   }
	   else if ($contact_type == 'text')
		{
			switch ($_POST['carrier']) {
				case 'verizon':
				$carrier= '@vtext.com';
				break;
			case 'sprint' :
				$carrier = "@messaging.sprintpcs.com";
				break;
			case 'att':
				$carrier = "@mobile.att.net";
				break;
				}
			
			$cell = preg_replace("/[^0-9]/", "", $_POST['cell']);
	
		    $contact_info = $cell . $carrier;
		
		}
		

	  
		include 'mysql_connect.php';
		
		//  update buzz information
        $strSQL1="UPDATE `tasks` SET email = '$contact_info', sub = '$subject', body = '$body' , recur = '$recur' ,  next_run = STR_TO_DATE('$datetime', '%m/%d/%Y %h:%i %p')  , timezone = '$timezone' , type = '$contact_type', sent='no' WHERE id ='$buzz_id'";
						
			$result = mysql_query($strSQL1);
			
			
			if (!$result) {
        die("Invalid query:<span class='feedback'>  " . mysql_error(). "</span>");
       }

		echo "<span class='feedback'>Your buzz has been updated.</span>";

	  
	}
		
  
  //if the form is submitted , process and insert data into DB
 else if(($_POST['submitted'])=='true'){
	 
	 
	 $today = date("m/d/Y");

	 
	 //error handling - current date
	 if ($_POST['date'] < $today){
		 
		   echo "<span class='feedback'>Date is in the past. Please use a current date.</span>"; 
	 }
	 
	 else{
  
   
   $date = $_POST['date'];
   $cell = $_POST['cell'];
   $date = $_POST['date'];
   $hr = $_POST['time_hr'];
   $min = $_POST['time_min'];
   $AMPM = $_POST['time_AMPM'];
   $subject = $_POST['subject'];
   $body    = $_POST['message'];
   $recur    = $_POST['recur'];
   $timezone = $_POST['timezone'];


   $contact_type = $_POST['contact'];
   $time = $hr. ":" . $min . " " . $AMPM; 
   
   $datetime = $date . ' '. $time;
   
   
    include 'mysql_connect.php';
    //insert default registration infg
    //  $strSQL="INSERT INTO `tasks` ( `email` , `sub` , `body` ,  `next_run_on` , `next_run_time`, `recur`, `timezone` ,`next_run`)VALUES ('$contact_info', '$subject', '$body', STR_TO_DATE('$date', '%m/%d/%Y'), STR_TO_DATE('$time', '%h:%i %p' ), '$recur', '$timezone', CONVERT_TZ(STR_TO_DATE('$datetime', '%m/%d/%Y %h:%i %p'),'SYSTEM', '$timezone'));";
	

	$strSQL2="SELECT code FROM timezone WHERE timezone ='$timezone';";
	$result = mysql_query($strSQL2);
		
	while ($row = mysql_fetch_array ($result)){
	
		$tz_cd = $row[0]; 
	}
	
	
			  
  if ($contact_type == 'email') {
      $contact_info = $_POST['email'];   
   }
   else if ($contact_type == 'text')
	{
		switch ($_POST['carrier']) {
			case 'verizon':
			$carrier= '@vtext.com';
			break;
		case 'sprint' :
			$carrier = "@messaging.sprintpcs.com";
			break;
		case 'att':
			$carrier = "@mobile.att.net";
			break;
			}
		
		
	$cell = preg_replace("/[^0-9]/", "", $_POST['cell']);

	
	$contact_info = $cell . $carrier;

   	}
			
         include 'mysql_connect.php';
         
		 		 
        //insert form to DB
       //  $strSQL="INSERT INTO `tasks` ( `email` , `sub` , `body` ,  `next_run_on` , `next_run_time`, `recur`, `timezone` ,`next_run`)VALUES ('$contact_info', '$subject', '$body', STR_TO_DATE('$date', '%m/%d/%Y'), STR_TO_DATE('$time', '%h:%i %p' ), '$recur', '$timezone', CONVERT_TZ(STR_TO_DATE('$datetime', '%m/%d/%Y %h:%i %p'),'SYSTEM', '$timezone'));";
	     $strSQL="INSERT INTO `tasks` ( `email` , `sub` , `body` ,  `next_run_on` , `next_run_time`, `recur`, `timezone` ,`next_run` ,`user_id`, `type`)VALUES ('$contact_info', '$subject', '$body', STR_TO_DATE('$date', '%m/%d/%Y'), STR_TO_DATE('$time', '%h:%i %p' ), '$recur', '$timezone', STR_TO_DATE('$datetime', '%m/%d/%Y %h:%i %p'), '$session_id', '$contact_type');";
		 
			  $result = mysql_query($strSQL);
		
	
			    if (!$result) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }
	
;
	
	if($recur == "None") {
	    $recur = ""; 
	}	

	echo "<span class='feedback'>Your " . $recur .  " reminder has been set for " . $contact_info. " on ". $date ." at " . $time . " " . $tz_cd ;
   
	
	echo "</span>";

		}	
 }
	 //if we are editing, get values from DB to display in form
     if (isset($buzz_id)){
	  
				 
	    include 'mysql_connect.php';
	    
	    $strSQL=  "SELECT email, sub, body, timezone, recur, next_run, DATE_FORMAT(next_run, '%m/%d/%Y') day , type, DATE_FORMAT(next_run, '%l') hr, DATE_FORMAT(next_run, '%i') min, DATE_FORMAT(next_run, '%p') AMPM  FROM tasks WHERE id='$buzz_id';";
 
		$result= @mysql_query($strSQL);

		while ($row = mysql_fetch_array ($result)){
	  
			$v_email = $row[0];
			$v_sub	 = $row[1];
			$v_body  = $row[2];
			$v_timezone = $row[3];
			$v_occur = $row[4];
			$v_next_run = $row[5];
			$v_day = $row[6];
			$v_cont_type = $row[7];
			$v_hr = $row[8];
			$v_min = $row[9];
			$v_ampm = $row[10];
		}	
  
	}	
 
  
 
			?>
		
			 <h2><? if(isset($buzz_id)) { echo "edit your buzz"; } Else { echo "Enter your buzz"; } ?></h2>
			<form  name="setreminder" method="post" action="send.php" onSubmit="return checkform()">
				<table>		
				
					<!--p style="font-size:18px;"></p-->
				  			
					<tr>
					<td style="text-align:right;"><label>Contact Method </label>
					  <span class="small"> Select Email or Text Message</span>
					</td>
					<td> 
					<select name="contact" id="contact" style="width: 120px;" onchange="Selected(this.value);" >
						  <option value="none" selected="true"> Select: </option>
						  <option value="email" <?php if ($v_cont_type =='email') {echo "selected=true"; } ?>>E-mail</option>
						  <option value="text" <?php if ($v_cont_type =='text') {echo "selected=true"; } ?>>Text Message</option>
						  
						  
						  
						</select>
					</td>
					</tr>

					
					<tr id ="emaildiv" <?if ($v_cont_type=='email'){ echo ""; } else { echo "style=\"display:none\";"; } ?>>
						<td style="text-align:right;"><label>Email </label>
						  <span class="small"> Enter Valid E-mail Address</span>
						</td>
						<td><input type="Text" name="email" id="email" value="<?php if (isset($v_email)) { echo $v_email; }?>" size=40 ></td>
					</tr>
				
					<tr id ="phonediv" <?if ($v_cont_type=='text'){ echo ""; } else { echo "style=\"display:none\";"; } ?>>
						<td style="text-align:right;"><label>Cell Phone # </label>
						<span class="small"> Enter Valid Phone Number and choose carrier
						</span></td>
						<td><input type="Text" name="cell" value="<?php if (isset($v_phone)) { echo $v_phone; }?>">
					
					  <? echo  "<select name='carrier'>";
						//get data from timezone table to populte select box
						
						include 'mysql_connect.php';
						$strSQL1 = "SELECT code, description FROM carriers"; 
						$result= @mysql_query($strSQL1);
	       
							while ($row = mysql_fetch_array ($result)){
	
								$v_code = $row[code]; 
								$v_desc = $row[description];
								
			                    echo "<option "; if ($v_carrier ==$v_code) {echo "selected=true"; } echo " value=" . '"' . $v_code .'"'. ">" . $v_desc . "</option>";
							}
						
						echo  "</select>";
						echo  "</td>";
					?>
					
					</tr>
					
					<tr>
					  <td style="text-align:right;"><label> Subject </label>
					  <span class="small">Enter Subject of the Reminder
						</span></td>
					  <td><input type="Text" name="subject" value="<? echo $v_sub; ?>" size=40 class=text></td>
					</tr>
					<tr>
					  <td valign =top style="text-align:right;"><label>Reminder</label>
					  <span class="small"> Enter Message
						</span></td>
					  <td><textarea rows="3" cols="38" name="message" class=text><? echo $v_body; ?></textarea></td>
					</tr>
					<tr>
					  <td style="text-align:right;"><label>Date </label>
					  <span class="small"> Select Date
						</span></td>
					  <td>	<input type="Text" name="date" id="date" value="<? echo $v_day; ?>" readonly=true>
							<a href="javascript:cal.popup();">	
							<img src="images/calendar_icon.jpg" style="margin-bottom: -10px; padding:2px;"  alt="Click Here to Pick the date"></a><br>
 					   
					   </td>
					</tr>
					<tr>
					  <td style="text-align:right;"><label> Time* </label>
					  <span class="small"> Select the time / timezone
						</span></td>
					  <td>
						<select name="time_hr" class=text> 
						<option <?php if ($v_hr =='1') {echo "selected=true"; } ?>>1</option>
						<option <?php if ($v_hr =='2') {echo "selected=true"; } ?>>2</option>
						<option <?php if ($v_hr =='3') {echo "selected=true"; } ?>>3</option>
						<option <?php if ($v_hr =='4') {echo "selected=true"; } ?>>4</option>
						<option <?php if ($v_hr =='5') {echo "selected=true"; } ?>>5</option>
						<option <?php if ($v_hr =='6') {echo "selected=true"; } ?>>6</option>
						<option <?php if ($v_hr =='7') {echo "selected=true"; } ?>>7</option>
						<option <?php if ($v_hr =='8') {echo "selected=true"; } ?>>8</option>
						<option <?php if ($v_hr =='9') {echo "selected=true"; } ?>>9</option>
						<option <?php if ($v_hr =='10') {echo "selected=true"; } ?>>10</option>
						<option <?php if ($v_hr =='11') {echo "selected=true"; } ?>>11</option>
						<option <?php if ($v_hr =='12') {echo "selected=true"; } ?>>12</option>
					   </select>
						<select name="time_min" class=text>
						<option <?php if ($v_min =='00') {echo "selected=true"; } ?>>00</option>
						<option <?php if ($v_min =='05') {echo "selected=true"; } ?>>05</option>
						<option <?php if ($v_min =='10') {echo "selected=true"; } ?>>10</option>
						<option <?php if ($v_min =='15') {echo "selected=true"; } ?>>15</option>
						<option <?php if ($v_min =='20') {echo "selected=true"; } ?>>20</option>
						<option <?php if ($v_min =='25') {echo "selected=true"; } ?>>25</option>
						<option <?php if ($v_min =='30') {echo "selected=true"; } ?>>30</option>
						<option <?php if ($v_min =='35') {echo "selected=true"; } ?>>35</option>
						<option <?php if ($v_min =='40') {echo "selected=true"; } ?>>40</option>
						<option <?php if ($v_min =='45') {echo "selected=true"; } ?>>45</option>
						<option <?php if ($v_min =='50') {echo "selected=true"; } ?>>50</option>
						<option <?php if ($v_min =='55') {echo "selected=true"; } ?>>55</option>
					   </select>
						<select name="time_AMPM" class=text>
						<option <?php if ($v_ampm =='AM') {echo "selected=true"; } ?>>AM</option>
						<option <?php if ($v_ampm =='PM') {echo "selected=true"; } ?>>PM</option>
					   </select>
					<?   
						echo  "<select name='timezone'>";
						//get data from timezone table to populte select box
						
						include 'mysql_connect.php';
						$strSQL1 = "SELECT timezone, description FROM timezone"; 
						$result= @mysql_query($strSQL1);
	       
							while ($row = mysql_fetch_array ($result)){
	
								$v_tz = $row[timezone]; 
								$v_desc = $row[description];
								
			                    echo "<option "; if ($v_timezone ==$v_tz) {echo "selected=true"; } echo " value=" . '"' . $v_tz .'"'. ">" . $v_desc . " (" . $v_tz . ")" . "</option>";
							}
						
						echo  "</select>";
						echo  "</td>";
					?>
								   
					 </td>
					  <input type ="hidden" name="submitted" value="true">
					  <? if (isset($buzz_id)) { echo "<input type =\"hidden\" name=\"buzz_id\" value=$buzz_id>"; } ?>
					</tr>
					

					<tr>
					  <td style="text-align:right;"><label>Recurrence </label>
					  <span class="small"> How often do you want alert to repeat
						</span></td>
					  <td><select name="recur" class=text>
					   <option<? if ($v_occur == 'Once') {echo " selected=true";}?>>Once</option> 
					   <?php if (isset($session_id)) { echo"<option"; if ($v_occur == 'Daily') {echo " selected=true";} echo ">Daily</option>"; } ?> 
					   <?php if (isset($session_id)) { echo"<option"; if ($v_occur == 'Weekly') {echo " selected=true";} echo ">Weekly</option>"; } ?>
					   <?php if (isset($session_id)) { echo"<option"; if ($v_occur == 'Monthly') {echo " selected=true";}  echo ">Monthly</option>"; } ?>
					   <?php if (isset($session_id)) { echo"<option"; if ($v_occur == 'Yearly') {echo " selected=true";}  echo ">Yearly</option>"; } ?>
					   
					   
					   </select> <? if (!isset($session_id)) { echo"<span class='small'>  *Register to create and manage recurring buzz alerts </span> "; } ?>
					  </td>
					  	  
					</tr>
                    <tr>	
						<td></td>
						<td><br /><input type="submit" value="<? if (isset($buzz_id)) { echo "Update"; } else  { echo "Submit"; } ?> Reminder" class="button"> <input type="reset" value="Reset" class="button"></td>
					</tr>
					</table>	
				</form>
			
		<script language="JavaScript">
				var cal = new calendar2(document.forms['setreminder'].elements['date']);
				cal.year_scroll = true;
				cal.time_comp = false;
		</script>
	<!-- main ends -->	
		</div>
				
		<div id="sidebar">
		<?   if (isset($_SESSION['uid'])) { include 'login_menu.php'; } else { include 'login.php'; } ?>
	
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

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
		//create connection to DB
		include 'mysql_connect.php';

		//get name and email
		$strSQL= "SELECT fname, lname, email  FROM users WHERE ID='$session_id';";
			  
		$result= @mysql_query($strSQL);

		while ($row = mysql_fetch_array ($result)){
				
			$v_fname =  $row[0];
			$v_lname = $row[1];
			$v_email = $row[2];
			}
		
		?>
		
	<h2>Your Buzz Schedule</h2>
		

		<table width='550' border='0' cellpadding = "0" align = 'center'> 

		<?
		//get schedule 
		//$strSQL1= "SELECT id, email, sub, CASE WHEN LENGTH(BODY) > 20 THEN CONCAT(SUBSTR(body,1,20), '...')  ELSE body END body , timezone.code, recur, next_run  FROM tasks, timezone WHERE  tasks.timezone = timezone.timezone AND user_id='$session_id';";
		 $strSQL1=  "SELECT id, email, body, CASE WHEN LENGTH(sub) > 20 THEN CONCAT(SUBSTR(sub,1,20), '...') ELSE sub END sub , timezone.code, recur, next_run, DATE_FORMAT(next_run, '%a') as Week, DATE_FORMAT(next_run, '%m/%d/%y') DoW, DATE_FORMAT(next_run, '%b') month,  DATE_FORMAT(next_run, '%D') Day,  DATE_FORMAT(next_run, '%l:%i %p') Time, (next_run - NOW()) curr FROM tasks, timezone WHERE tasks.timezone = timezone.timezone AND user_id='$session_id' ORDER BY next_run DESC;";
 
	
		$result1= @mysql_query($strSQL1);

		if(mysql_num_rows($result1)==0){
		 echo "<br />No buzzes entered. Please click New Buzz on the right";
		}
		else {
			
		echo "<tr>";
			echo "<td></td>";
			echo "<td><b>Subject</b></td>";
			echo "<td><b>Occurs</b></td>";
			echo "<td><b>Action</b> </td>";
		echo "</tr>";
		
		}
				
		while ($row = mysql_fetch_array ($result1)){
				
			$v_id    = $row[0];
			$v_email = $row[1];
			$v_body  = $row[2];
			$v_sub   = $row[3];
			$v_tz_code = $row[4];
			$v_occur = $row[5];
			$v_next_run = $row[6];
			$v_dow   = $row[7];
			$v_date  = $row[8];
			$v_month = $row[9];
			$v_day   = $row[10];
			$v_time  = $row[11];
			$v_current = $row[12];
		
		if ($v_occur == 'Once') {	
			$v_occur = $v_occur . " on " . $v_date . " @ " . $v_time  . " ". $v_tz_code;
		}
		if ($v_occur == 'Daily') {	
			$v_occur = $v_occur . " @ " . $v_time  . " ". $v_tz_code;
		}
		if ($v_occur == 'Weekly') {	
			$v_occur = $v_occur . " on " . $v_dow . " @ " . $v_time  . " ". $v_tz_code;
		}
		if ($v_occur == 'Monthly') {	
			$v_occur = $v_occur . " on the " . $v_day . " @ " . $v_time  . " ". $v_tz_code;
		}
		if ($v_occur == 'Yearly') {	
			$v_occur = $v_occur . " on " . $v_month. " " .  $v_day . " @ " . $v_time  . " ". $v_tz_code;
		}
		
		    echo "<tr>";
        //echo "<td>". $v_email . "</td>";
		echo "<td>"; if ($v_current > 0) { echo "<img src='images/current.gif' class='none'>"; } else { echo "<img src='images/past.gif' class='none'>"; }  echo "</td>";
        echo "<td>" . $v_sub . "</td>"; 
       // echo "<td>" . $v_body . "</td>"; 
         echo "<td>" . $v_occur ."</td>"; 
		 echo "<td> <a href=send.php?edit=".$v_id."> Edit </a> | <a href=delete.php?bid=".$v_id." onclick=\"return confirm('Are you sure you want to delete this buzz?')\">Delete </a></td>"; 
		
		} 
		?>
	 
		</tr>
		</table>
		
	 <?if(mysql_num_rows($result1)>0){	
		echo"<div align='center'>";
		echo"<img src='images/current.gif' class='none'> Active &nbsp;<br />";
		echo"<img src='images/past.gif' class='none'> Inactive</div>";
	 }
	?>	
		
		
		
		
		
		


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

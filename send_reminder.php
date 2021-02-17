<?

	  include 'mysql_connect.php';
         //old	
	     // $strSQL= "SELECT id, email, sub, body, DATE_FORMAT(next_run_on, '%a %b. %D, %Y') as next_run_on , DATE_FORMAT(next_run_time, '%l:%i %p') as next_run_time, recur FROM tasks WHERE  sent = 'no' AND `next_run_on` =CURDATE() AND (next_run_time - CURTIME() BETWEEN -500 AND 500);";

		
	 $strSQL= "SELECT id, email, sub, body, DATE_FORMAT(next_run_on, '%a %b. %D, %Y') as next_run_on , DATE_FORMAT(next_run_time, '%l:%i %p') as next_run_time, recur FROM tasks WHERE  sent = 'no' AND `next_run_on` =CURDATE() AND (next_run_time - CURTIME() BETWEEN -200 AND 200);";
	     
		
	  	//$strSQL = "SELECT id, email, sub, body, DATE_FORMAT(next_run_on, '%a %b. %D, %Y') as next_run_on , DATE_FORMAT(next_run_time, '%l:%i %p') as next_run_time, recur, next_run, timezone FROM tasks WHERE  sent = 'no' AND CONVERT_TZ(`next_run`,timezone, 'SYSTEM')  - NOW() BETWEEN -100 AND 100;"; 
	     
	
		 $result= @mysql_query($strSQL);
	
	         while ($row = mysql_fetch_array ($result)){
	      
				 
			  $v_id = $row[0]; 
	          $v_email = $row[1];
			  $v_sub = $row[2];
			  $v_body = $row[3];
			  $v_day = $row[4];
			  $v_time = $row[5];
			  $v_recur = $row[6];
			 
			  echo $v_id . ": ". $v_day;
			  
			
			  
			  $msg = "Reminder for " . $v_day . " @ " . $v_time . ": \n\n" . $v_body;
			        
              $subject = "Reminder: " . $v_sub; 
			  
			  $headers = 'From: reminder@buzzit2me.com';

			if (!mail($v_email, $subject, $msg, $headers)){die("can't send sms"); }; 
    
			 

			$strSQL2="UPDATE tasks SET last_sent_on = NOW(), sent = 'yes' WHERE id = ". $v_id .";";
		 
			$result2 = mysql_query($strSQL2);
			
	  if (!$result2) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }
     

	if ($v_recur != "Once") {
	  	
	switch ($v_recur) {
		case 'Daily':
			$inc = 'INTERVAL 1 DAY';
			break;
		case 'Weekly' :
			$inc = 'INTERVAL 7 DAY';
			break;
		case 'Monthly':
			$inc = 'INTERVAL 1 MONTH';
			break;
		case 'Yearly':
			$inc = 'INTERVAL 1 YEAR';
			break;
			}
		
		echo " " . $inc;
	
	   $strSQL3="UPDATE tasks SET sent = 'no', next_run = ADDDATE(next_run, ". $inc ." ) WHERE id = ". $v_id .";";
		
		$result3 = mysql_query($strSQL3);
			
	  if (!$result3) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }	
	
	}


	
      echo " - email sent";

	 
			 }
			 
?>

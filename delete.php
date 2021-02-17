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
			 include 'mysql_connect.php';

			  $strSQL= "SELECT fname, lname, email  FROM users WHERE ID='$session_id';";
			  
			$result= @mysql_query($strSQL);


		while ($row = mysql_fetch_array ($result)){
			
			
			$v_fname =  $row[0];
			$v_lname = $row[1];
			$v_email = $row[2];
			}
		?>
		
		
			
			         
<?php
         
   
    
   $bid = $_REQUEST['bid'];
   

   
         include 'mysql_connect.php';
         
        $strSQL1= "DELETE FROM tasks WHERE  `id`='$bid';";
	  
         	$result1= @mysql_query($strSQL1);

    if (!$result1) {
        die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
       }
           
           
       header("Location: view_schedule.php");
 		exit;
      
   
      
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

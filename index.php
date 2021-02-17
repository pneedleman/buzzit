<? include 'head.php'; ?>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
		<div id="main">
				<?
			if (isset($_REQUEST['eid']) && isset($_REQUEST['key'])){

			  $v_key = $_REQUEST['key'];
			  $v_mail = $_REQUEST['eid'];
			  
			  $salt = 'specsalt';
			  
			  if (md5($salt) == $v_key) {
			  
			  include 'mysql_connect.php';

				  $strSQL4= "UPDATE `users` SET `lock` = 'n' WHERE email='$v_mail';";
				  
				$result4= @mysql_query($strSQL4);
				
					if (!$result4) {
					die("Invalid query:<font color = 'red'>  " . mysql_error(). "</font>");
				   }
			  
			  
			  echo "<span class='feedback'>Your account is now unlocked. You may login below.</span>";

			  }
			  else {
			  echo "<span class='feedback'>This is an invalid entry.</span><br />"; 
			  }
			  
			}			
			
			if (!empty($_GET["type"])) {
  
			if ($_GET["type"]=="logout") {
  
				echo "<span class='feedback'>You have been logged out.  Thank you for using buzzit2me.</span>";
 
				//session_destroy();
		}
	
		if ($_GET["type"]=="login"){
  
		echo"<span class='feedback'><h3>[You must log in to see this page]</h3></span>";
		}
 
		} 
    
						
			?>
		
			<h2>What is buzzit2me?</h2>
				<p>
				Buzz it to me is a free online reminder service to help people with those everyday, hard to remember tasks. 
                Set up reminders to be sent to cell phones or email addresses. Such reminders could include:
				</p>
				<ul>	
				  <li>Appointments</li>
				  <li>Friends birthdays or Anniversaries</li>
				  <li>Pay monthly bills</li>
			      <li>Pick-up groceries</li>
				  <li> many more...</li>		 
				</ul>			

				Try it now - <a href="send.php">Send a buzz</a>
			
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

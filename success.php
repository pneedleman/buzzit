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
		
		
		
		
			<h2>Welcome <? echo $v_fname; ?></h2>
				<p> Welcome to the buzzit2me login page. Use the menu on the right to navigate.</p>

				
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

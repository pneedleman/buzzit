<? include 'head.php'; ?>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
		<div id="main">
		
		
				
					<h2>About</h2>
				<p>
				buzzit2me.com was started in January 2009 by Paul Needleman, an IT consultant living in Washington, DC. Paul became 
				interested in the idea of being able to easily remind himself of every-day things. The main concept was built around 
				the need for the site to be free, quick and simple to use. 					
				</p>
					
			<h2>Usage</h2>
			 	<ul>
				<li>
				This service is only intended for persons in the United States (USA) right now. Hopefully this will be expanded soon.
				</li>
				<li>
				Only Verizon, Sprint and AT&T customers may make use of text messaging. More carriers will be added soon.
				</li>
			</ul>
			
			<h2>Privacy Policy</h2>
			<ul>
				<li>This service is provided "as is". There is no gurantee of timely delivery of  
				messages to any email/cellular provider. We cannot be held liable for any 
				losses resulting from failure to deliver messages. </li>
				<li>Information you provide on this website will not be used for any purpose other 
				than sending messages to the designated recipient. We will not collect or analyze 
				your messages or addresses/phone numbers. </li>
			</ul>

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

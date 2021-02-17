<? include 'head.php'; ?>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<? include 'menu.php'; ?>
			
	<!-- content starts -->
	<div id="content">
	
		<div id="main">
		
		<? 
		
		if (isset($_POST['type'])) {
			
		$v_type	= $_POST['type'];
		$v_message = $_POST['message'];
		$v_email = $_POST['email'];
		$v_name = $_POST['name'];
			
		  $msg = $v_message . "\n\n" . $v_name . " (". $v_email .")";
			        
          $subject = $v_type . " from buzzit"; 
			  
		  $headers = 'From: ' . $v_email;
		  
		  $to = 'paul@buzzit2me.com';

			if (!mail($to, $subject, $msg, $headers)){die("can't send sms"); }; 
			
			echo "<span class='feedback'>Your message has been sent successfully. Thanks for your feedback.</span>";
		
		}
		
		
		?>
				
			<h2>Contact</h2>
				<p>
				email: <a href="mailto:paul@buzzit2me.com">paul@buzzit2me.com</a>
				</p>
				
				<form  name="sendmessage" method="post" action="contact.php">
				<table>		
				
					<p style="font-size:18px;">Send Message</p>
				  			
					<tr>
					  <td style="text-align:right;"><label> Name </label>
					  <span class="small">Your name
						</span></td>
					  <td><input type="Text" name="name" size=30></td>
					</tr>
					
					<tr>
					  <td style="text-align:right;"><label> Email Address</label>
					  <span class="small">So we can respond
						</span></td>
					  <td><input type="Text" name="email" size=30></td>
					</tr>
					
					<tr>
					<td style="text-align:right;"><label>Type</label>
					  <span class="small">Type of Message</span>
					</td>
					
					<td> 
						<select name="type" id="type" style="width: 120px;">
							<option value="question">Question</option>
							<option value="comment">Comment</option>
							<option value="suggestion">Suggestion</option>	  
						</select>
						</td>
					</tr>
					
					<tr>
					  <td valign =top style="text-align:right;"><label>Message</label>
					  <span class="small"> Enter Message
						</span></td>
					  <td><textarea rows="3" cols="38" name="message" class=text></textarea></td>
					</tr>
					

					
					<tr>
						<td></td><td><input type="submit" value="Send Message" class="button"></td>
					</tr>
					
				  </table>
				
				
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

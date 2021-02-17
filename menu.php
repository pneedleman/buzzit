  <? 
	session_start();
   //get the current page name to highlight tab
   
   $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
       
   $page_var =  substr($_SERVER["REQUEST_URI"],strrpos($_SERVER["REQUEST_URI"],"/")+1);

  
	
   ?>
	  
	 
	 
	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="index.php" title="">buzzit2me.com</a></h1><p id="beta">Beta</p>
		<p id="slogan">free online reminder service</p>	
		
		<!--div id="top-menu">
			<p><a href="index.html">rss feed</a> | <a href="register.php">register</a> | <a href="index.html">login</a></p>
		</div-->			
				
	<!--header ends-->					
	</div>
		
	<!-- navigation starts-->	
	<div  id="nav">
		<ul>
		<? if ($page =='index.php') { echo "<li id='current'>"; } else {echo "<li>"; } ?> <a href="index.php">Home</a></li>
		<? if ($page =='about.php') { echo "<li id='current'>"; } else {echo "<li>"; } ?> <a href="about.php">About</a></li>
        <? if ($page =='send.php') { echo "<li id='current'>"; } else {echo "<li>"; }?> 	<a href="<? if(isset($_REQUEST['edit'])) { echo $page_var; } else { echo 'send.php'; }?>"><? if(isset($_REQUEST['edit'])) { echo "Edit Buzz"; } else { echo "Send Buzz"; } ?></a></li>
		<? if ($page =='contact.php') { echo "<li id='current'>"; } else {echo "<li>"; }?> 	<a href="contact.php">Contact</a></li>   
		<? if (isset($session_id)) { 
		    if ($page == 'success.php'  || $page == 'view_schedule.php' || $page=='edit_prof.php' ||  $page == 'change_pass.php' ) { echo "<li id='current'>"; } else {echo "<li>"; }  echo   "<a href='success.php'>My Account</a></li>";  }	?> 


	
		</ul>
	<!-- navigation ends-->	
	</div>		
	
	

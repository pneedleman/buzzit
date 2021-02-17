  <? 
   //get the current page name to highlight tab
   $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

   ?>
	  
	 
	 
	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="index.html" title="">buzzit2me.com</a></h1>		
		<p id="slogan">free online reminder service</p>	
		
		<div id="top-menu">
			<p><a href="index.html">rss feed</a> | <a href="index.html">contact</a> | <a href="index.html">login</a></p>
		</div>			
				
	<!--header ends-->					
	</div>
		
	<!-- navigation starts-->	
	<div  id="nav">
		<ul>
		<? if ($page =='index.php') { echo	"<li id='current'>"; } else {echo "<li>"; } ?> <a href="index.php">Home</a></li>
		<? if ($page =='send.php') { echo	"<li id='current'>"; } else {echo "<li>"; }?> 	<a href="send.php">Send Buzz</a></li>
			<li><a href="blog.html">Blog</a></li>
			<li><a href="index.html">Services</a></li>
			<li><a href="index.html">Support</a></li>
			<li><a href="index.html">About</a></li>		
		</ul>
	<!-- navigation ends-->	
	</div>		
	
	

<?
 include 'head.php'; 
	
			session_destroy();
			
			header("Location: index.php?type=logout");
			

?>
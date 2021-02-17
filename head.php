<?
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>buzzitme2.com: free reminder service</title>

<link rel="shortcut icon" href="images/favicon.ico">

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Paul Needleman" />
<meta name="description" content="Buzzit2me.com. Free Online Reminder Service. Send yourself free email and text message reminders. " />
<meta name="keywords" content="free, online, reminder, service, text, email, reminder service" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />


<link rel="stylesheet" href="images/default.css" type="text/css" />

<script language="JavaScript" src="calendar2.js"></script>


</head>

<?

if (isset($_SESSION['uid'])) { $session_id = $_SESSION['uid']; }
if (isset($_SESSION['type'])) {  $session_role = $_SESSION['type']; }



?>
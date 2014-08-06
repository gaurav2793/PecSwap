<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
require_once('connection.php');
session_start();
if(isset($_SESSION['sid'])) {
	$_SESSION = array();
}
if(isset($_SESSION[session_name()])) {
	setcookie(session_name(),'',time()-1);
}
session_destroy();
if(isset($_COOKIE['sid'])) {
	setcookie('sid','',time()-2);
}
header('Location:index.php');
?>
</body>
</html>
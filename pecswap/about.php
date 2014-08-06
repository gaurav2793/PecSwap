<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="_scripts/form.css" media="screen" />
<style type="text/css">
#signup1 {
	width:995px;
	float:left;
	background:#fffcf2;
	color:#707578;
	margin-top:20px;
	margin-bottom:20px;
	padding:15px;
	font-family:Calibri;
	font-size:large;
}
.about {
	border:1px solid #707578;
	border-top:none;
	margin-top:0;
	margin-right:40px;
	margin-left:40px;
	padding:20px;
}
.errors {
	margin-bottom:0;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>About PecSwap</title>
</head>
<body>
<center>
<div id="main" align="center">
<div id="link" align="right">
<a href="index.php">home</a>
<a href="profile.php">profile</a>
<a href="ads.php">ads</a>
<a href="forum.php">forum</a>
<a href="about.php">about</a>
<?php 
if(isset($_SESSION['sid'])) {
	echo '<a href="logout.php">logout</a>';
}
?>
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
<hr />
</div>
<div id="signup1">
<p class="errors">About PecSwap</p>
<p class="about">This initiative is a humble effort to bring us, students of PEC, closer. In the day of social networking, this is the best platform for sharing and exchanging any asset. Be it ideas, items of daily use, examinatin papers or anything.
So GO on! Register, login and share.</p>
<p class="errors">Founders of PecSwap</p>
<p class="about"><strong>Gaurav Arora</strong> - B.E. Computer Science - 2nd Year, PEC<br /><br /><strong>Cannon Kalra</strong> - B.E. Information Technology - 2nd Year, PEC</p>
</div>
<div id="footer">
</div></div></center>
</body>
</html>
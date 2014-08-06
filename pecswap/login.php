<?php 
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
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="_scripts/style2.css" media="screen" />
<style type="text/css">
input {
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	margin:6px;
	height:20px;
	padding:0.2em;
}
input[type="text"],input[type="password"] {
	width:140px;
}
input[type="submit"] {
	width:80px;
	background:#707578;
	color:#fffcf2;
	margin-top:15px;
	height:25px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to PecSwap</title>
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
<a href="signup.php">register</a>
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
</div>
</div>

<div id="main">
<hr />


</div>

<div id="login_main">
<?php
require_once('connection.php');
if(isset($_POST['sid']) && isset($_POST['password'])) {
	$sid = $_POST['sid'];
	$password = $_POST['password'];
}
if(!empty($sid) && !empty($password)) {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query = "SELECT * FROM students WHERE sid='$sid' AND password=SHA('$password')";
	$result = mysqli_query($conn,$query) or die("Error querying to the database");
	$row = mysqli_fetch_array($result);	
	if(mysqli_num_rows($result)==1) {
		setcookie('sid',$row['sid'],time()+30*24*3600);
		$_SESSION['sid'] = $row['sid'];
		header('Location:index.php');
	}
	else {
		echo '<p class="errors">You must enter a correct SID and Password combination to login.</p>';
		display_login();
	}
} else {
	echo '<p class="errors">You must enter your SID and Password to login.</p>';
	display_login();
}
function display_login() { ?>
	<center>
	<form action="login.php" method="post">
    <table>
    <tr>
	<td>SID :</td>
    <td><input type="text" id="sid" name="sid" <?php if(isset($_POST['sid'])) { echo $_POST['sid']; } ?> /></td>
    </tr>
    <tr>
	<td>password :</td>
    <td><input type="password" id="password" name="password"  />&nbsp;&nbsp;&nbsp;&nbsp;<a href="forgot.php" class="forgot">forgot password?</a></td>
    </tr>
    <tr>
    <td></td>
	<td><input type="submit" value="Login" name="submit" id="submit" /></td>
    </tr>
    </table>
	</form>
    </center>
<?php }
?>

</div>
<div id="footer">
</div>
</body>
</html>
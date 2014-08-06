<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
?>
<?php
if(!isset($_SESSION['sid'])) {
	header('Location:login.php');
} else {
	$sid = $_SESSION['sid'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query = "SELECT * FROM students WHERE sid='$sid'";
	$result = mysqli_query($conn,$query) or die("Error querying the database");
	$row = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<style type="text/css">
input[type="text"] {
	border:none;
	padding:0.2em;
	background:#fffcf2;
	width:230px;
	font-family:Century Gothic;
	font-size:90%;
}
input[type="submit"] {
	-moz-border-radius:3px;
	-webkit-border-radius:5px;
	margin:30px;
	margin-bottom:5px;
	margin-top:10px;
	background:#707578;
	color:#fffcf2;
	height:25px;
}
input:focus
{
	border:none;
}
#login,.status {
	float:left;
	width:1000px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['name']; ?></title>
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
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
</div>
</div>

<div id="main">
<hr />
<div id="login" class="status">
Just click on the field you want to edit and hit Save after the changes.
</div>
<div id="cover">
<br />
<br />
<br />
<br />
<div align="left">
<?php
if(isset($_POST['submit']) || isset($_POST['submit2'])) {
	if(isset($_POST['submit2'])) {
		header('Location:profile.php');
	}
	if(isset($_POST['submit'])) {
		$name1=$_POST['name'];
		$email1=$_POST['email'];
		$contact1=$_POST['contact'];
		$query="UPDATE students SET name='$name1', email='$email1', contact='$contact1' WHERE sid='$sid'";
		mysqli_query($conn,$query) or die("Error querying to database 2");
		header('Location:profile.php');
	}
}	
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table width="600" border="0px" cellspacing="8px" class="auth">
  <tr>
    <img class="logged" src="profile_pic/<?php echo $row['profile_pic']; ?>" height="150" width="140"  />
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <td>Name: </td>
    <td><input type="text" name="name" value="<?php echo $row['name']; ?>" /></td>
    </tr>
  <tr>
    <td>SID: </td>
    <td><?php echo $row['sid']; ?></td>
  </tr>
  <tr>
    <td>contact: </td>
    <td><input type="text" name="contact" value="<?php echo $row['contact']; ?>" /></td>
  </tr>
  <tr>
    <td>e-mail: </td>
    <td><input type="text" name="email" value="<?php echo $row['email']; ?>" /></td>
  </tr>
  <!--<tr>
  	<center><td colspan="2">PEC University of Technology</td>
    </center>
   </tr>-->
</table>
<input type="submit" name="submit" value="Save Changes" />
<input type="submit" name="submit2" value="Discard Changes" />
</form>
<br /><br />
</div>
</div>
</div>
<div id="footer">
</div>
</body>
</html>
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
}
if(isset($_GET['sid'])) {
	$sid1 = $_GET['sid'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query = "SELECT * FROM students WHERE sid='$sid1'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result);
}
else {
	header('Location:index.php');
}
if($sid1 == $_SESSION['sid']) {
	header('Location:profile.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['name']; ?></title>
</head>
<body>
<center>
<div id="main" align="center">
<div id="link" align="right">
<a href="index.php">home</a>
<a href="profile.php">profile</a>
<a href="#">ads</a>
<a href="#">news</a>
<a href="#">about us</a>
<?php
if(isset($_SESSION['sid'])) {
	echo '<a href="logout.php">logout</a>';
}
?>
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
</div>
</div>
<div id="main">
<hr />
<div id="cover">
<br />
<br />
<br />
<br />
<div align="left">
<table width="600" border="0px" cellspacing="8px" class="auth">
  <tr>
    <img class="logged" src="profile_pic/<?php echo $row['profile_pic']; ?>" height="150" width="140"  />
    <td>Name: </td>
    <td><?php echo $row['name']; ?></td>
    </tr>
  <tr>
    <td>SID: </td>
    <td><?php echo $row['sid']; ?></td>
  </tr>
  <tr>
    <td>contact: </td>
    <td><?php echo $row['contact']; ?></td>
  </tr>
  <tr>
    <td>e-mail: </td>
    <td><?php echo $row['email']; ?></td>
  </tr>
  <!--<tr>
  	<center><td colspan="2">PEC University of Technology</td>
    </center>
   </tr>-->
</table>
<br /><br />
</div>
</div>
</div>
<div id="main" style="background-color:#ffffff">
sad
</div>
<div id="footer">
</div>
</body>
</html>
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
.errors1 {
	width:335px;
	margin-left:200px;
	background:#707578;
	color:#fffcf2;
	padding:5px;
	padding-left:10px;
}
form
{
	margin-top:20px;
}
input[type="password"] {
	-moz-border-radius:3px;
	-webkit-border-radius:5px;
	padding:0.2em;
	background:#fffcf2;
	width:200px;
	font-family:Century Gothic;
	font-size:90%;
}
input[type="submit"] {
	-moz-border-radius:3px;
	-webkit-border-radius:5px;
	margin:30px;
	height:30px;
	margin-bottom:5px;
	margin-top:10px;
	background:#707578;
	color:#fffcf2;
	height:25px;
	margin-top:20px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['name']; ?></title>
</head>
<body>
<?php
$error_msg="";
if(isset($_POST['submit1']) || isset($_POST['submit2'])) {
	if(isset($_POST['submit2'])) {
		header('Location:profile.php');
	} else {
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		if(sha1($password1)==$row['password']) {
			$query = "UPDATE students SET password=SHA('$password2') where sid='$sid'";
			mysqli_query($conn,$query);
			header('Location:profile.php');
		} else {
			$error_msg = "Old Password entered by you is incorrect.";
		}
	}
}	
?>
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
<span class="logged">
<img src="_images/_online.jpg" />&nbsp;
<?php echo $row['sid']; ?>
</span>
<a class="logged" href="editprofile.php">edit profile</a>
<a href="password.php">change password</a>
<a class="logged" href="logout.php">logout</a>
</div>
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
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <?php if(!empty($error_msg)) { ?>
  <p class="errors1"><?php  echo $error_msg;  echo '</p>'; } ?>
  <tr>
  	<td>Old password:</td>
    <td><input type="password" name="password1" /></td>
   </tr>
   <tr>
   	<td>New Password:</td>
    <td><input type="password" name="password2" /></td>
   </tr>
   <tr>
   <td>   <input type="submit" name="submit1" value="Change Password" /></td>
   <td><input type="submit" name="submit2" value="Discard Changes" /></td>
  </form>
  <!--<tr>
  	<center><td colspan="2">PEC University of Technology</td>
    </center>
   </tr>-->
</table>
<br /><br />



</div>
</div>
</div>




<div id="footer">

</div>



</body>
</html>
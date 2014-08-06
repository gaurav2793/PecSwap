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
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Free!</title>
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
<h1 align="left">
Sign Up!!!
</h1>
<hr width="1000px" />
<?php
if(isset($_SESSION['sid'])) {
	echo '<p class="errors">You must log out of your account to continue.<br>';
	echo '<a href="logout2.php">logout</a></p>';
}if(!isset($_SESSION['sid'])) {
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$sid = $_POST['sid'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	/*$verify = $_FILES['verify']['name'];
	$dp = $_FILES['dp']['name'];
	$verify_type = $_FILES['verify']['type'];
	$dp_type = $_FILES['dp']['type'];
	$verify_size = $_FILES['verify']['size'];
	$dp_size = $_FILES['dp']['size'];
	$target_verify = 'sid_pic/'.$verify;
	$target_dp = 'profile_pic/'.$dp;
	$query = "SELECT * FROM tmp_register where sid='$sid'";
	$result = mysqli_query($conn,$query) or die("Error querying the database1");
	if(mysqli_num_rows($result) == 0) {*/
	if(!empty($name) && !empty($sid) && !empty($email) && !empty($contact) && !empty($password1)) {
	  $query = "SELECT * FROM students where sid='$sid'";
	  $result = mysqli_query($conn,$query) or die("Error querying the database2");
	  if(mysqli_num_rows($result)==0) {
		/*if(($verify_type == 'image/gif' || $verify_type == 'image/jpeg' || $verify_type == 'image/pjpeg' || $verify_type == 'image/png') 
		&& ($dp_type == 'image/gif' || $dp_type == 'image/jpeg' || $dp_type == 'image/pjpeg' || $dp_type == 'image/png')
		&& $verify_size>0 && $dp_size>0 && $verify_size<3145728 && $dp_size<3145728) {*/
			 if($password1 == $password2 ) { 
				 /*move_uploaded_file($_FILES['verify']['tmp_name'],$target_verify);
				 move_uploaded_file($_FILES['dp']['tmp_name'],$target_dp);*/
				 $query = "INSERT INTO students (name,sid,email,contact,password,profile_pic) 					VALUES('$name','$sid','$email','$contact',SHA('$password1'),'default.jpg')";
				 mysqli_query($conn,$query) or die("Error querying the database3");
				 mysqli_close($conn);
				 echo '<p class="errors">Thanks for the registeration. Now you can login with your SID and password.<br><a href="login.php">login</a></p>';
			 }
			 else {
				 echo '<p class="errors">Passwords donot match<br>';
				 display_form();
			 }
		/*}
		else {
			echo '<p class="errors">Please upload a jpeg/pjpeg/png/gif image and ensure that the maximum image size is less than 3 MB.<br></p>';
			display_form();
		}*/
	  } else {
	  		echo '<p class="errors">A student is already registered with the same SID.<br></p>';
	  		display_form();
	  } }else {
		  echo '<p class="errors">Please fill in the empty fields to continue.</p>';
		  display_form();
	  }
	/*} else {
		echo '<p class="errors">A student has already sent his registration details with the same sid.</p>';
		display_form();
	}*/
} else {
	display_form();
} }
function display_form() {
	?><table id="signup">
	<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <tr>
	<td>Name:</td>
    <td><input type="text" name="name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" /></td>
	</tr>
    <tr>
    <td>SID:</td>
    <td><input type="text" name="sid" value="<?php if(isset($_POST['sid'])) { echo $_POST['sid']; } ?>" /></td>
	</tr>
    <tr>
    <td>Contact No.:</td>
    <td><input type="text" name="contact" value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; } ?>" /></td>
    </tr>
    <tr>
	<td>E-Mail ID:</td>
    <td><input type="text" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" /></td>
	</tr>
    <tr>
    <td>Password:</td>
    <td><input type="password" name="password1" /></td>
	</tr>
    <tr>
    <td>Confirm Password:</td>
    <td><input type="password" name="password2" /></td>
    </tr>
    <tr><td></td>
	<td><input type="submit" name="submit" value="Sign Up" /></td>
    </tr>
	</form></table>
    <?php
}
?>
</div>

<div id="footer">
</div></div></center>
</body>
</html>
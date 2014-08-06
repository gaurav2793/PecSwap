<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
if(isset($_SESSION['sid'])) {
	$sid = $_SESSION['sid'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query = "SELECT * FROM students WHERE sid='$sid'";
	$result = mysqli_query($conn,$query) or die("Error querying the database");
	$row = mysqli_fetch_array($result);
}
if(isset($_GET['title']) && isset($_GET['ad_no'])) {
	$title=$_GET['title'];
	$ad_no=$_GET['ad_no'];
	$query1 = "SELECT * FROM ads WHERE ad_no='$ad_no'";
	$result1 = mysqli_query($conn,$query1) or die('Error querying the database2');
	$row1 = mysqli_fetch_array($result1);	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="_scripts/form.css" media="screen" />
<style type="text/css">
#signup1 {
	width:1005px;
	float:right;
	background:#fffcf2;
	color:#707578;
	margin-top:20px;
	margin-bottom:20px;
	padding:10px;
	padding-top:0px;
	font-family:Calibri;
}
h1 {
	text-decoration:underline;
	font-size:28px;
	text-align:left;
	font-family:Calibri;
	margin-left:20px;
}
p {
	margin:30px;
	font-size:21px;
}
.img {
	float:left;
	max-height:250px;
}
#buttons {
	float:right;
	width:250px;
	margin-top:-200px;
}
span.button {
	display:block;
	color:#fffcf2;
	margin:40px;
	border:outset #fffcf2;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	background-color:#707578;
	font-size:28px;
	padding:7px;
}
#details {
	width:380px;
}
#others {
	position:static !important;
	margin-top:30px;
}
#advertisement {
	margin-top:15px;
	margin-bottom:15px;
	min-height:300px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_GET['title']; ?></title>
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
else {
	echo '<a href="signup.php">register</a>';
}
?>
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
<hr />
</div>
<div id="signup1">
<div id="advertisement">
  <p class="img">
  <img src="<?php echo 'ads_pic/'.$row1['picture']; ?>" height="230px" width="230px" /></p>
  <?php
  echo '<h1>'.$title.'</h1>';
  echo '<p id="details">'.$row1['details'].'</p>';
  echo '<p><strong>Price : Rs. '.$row1['price'].'</strong></p>';
  ?>
  <div id="buttons">
  <span class="button"><?php echo $row1['contact']; ?></span>
  <span class="button">Reply</span>
  </div>
</div>
<div id="others">
<p class="errors">Other Realted Advertisements</p>
</div>
</div>

<div id="footer">
</div></div></center>
</body>
</html>
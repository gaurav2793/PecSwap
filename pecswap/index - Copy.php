<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to PecSwap</title>
<style type="text/css">
input {
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	margin:3px;
	height:15px;
	padding:0.2em;
}
input[type="text"],input[type="password"] {
	width:100px;
}
input[type="submit"] {
	width:50px;
	background:#fffcf2;
	color:#707578;
	border-color:#707578; 
	height:25px;
}
#search1 {
	margin-top:-1px;
	height:28px;
	background:#fffcf2;
	color:#707578;
	width:664px;
	margin-bottom:10px;
}
.more {
	background:#707578;
	width:678px;
	padding-top:10px;
	padding-bottom:10px;
	margin-top:30px;
	display:block;
}
.more a {
	text-decoration:none;
}
.more a:hover {
	text-decoration:underline;
}
</style>
</head>
<body>
<center>
<div id="main" align="center">
<div id="user">
<?php 
if(isset($_SESSION['sid'])) {
	$sid=$_SESSION['sid'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query="SELECT * FROM students WHERE sid='$sid'";
	$result = mysqli_query($conn, $query) or die("Error querying the database");
	$row = mysqli_fetch_array($result);/*
	?><img src="profile_pic/<?php echo $row['profile_pic'] ?>" height="30" width="30" />&nbsp;&nbsp;&nbsp;<?php */
	echo 'Welcome, ';
	echo $row['name'];
	
}
?>
</div>
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
</div>
</div>

<div id="main">
<hr />
<?php
if(!isset($_SESSION['sid'])) {
	?>
	<div id="login">
	<form action="login.php" method="post">
	SID : <input type="text" id="sid" name="sid" size="12" maxlength="12" />&nbsp;&nbsp;
	password : <input type="password" id="password" name="password" size="12" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" value="Login" name="submit" id="submit" />
	</form>
	</div>
    <?php
}
?>
<div id="cover">
<img src="_images/_cover.png" width="90%" />
<br />
</div>
</div>


<div id="post_ad">
<span id="button"><a href="post_ad.php">Post a Free Ad </a></span>

</div>
<div id="main0">
<form action="search.php" method="get">
<input type="text" name="search" id="search1" value="Search" 
onfocus="if(this.value=='Search') { this.value=''; }" 
onblur="if(this.value=='') { this.value='Search'; }" />
</form>
<?php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
$query = "SELECT * FROM ads ORDER BY date desc LIMIT 4";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($result)) {
	?>
    <div class="ads">
    <img src="<?php echo 'ads_pic/'.$row['picture']; ?>" height="100px" width="100px" class="ad_pic" />
    <?php
	echo '<p class="title"><a href="#" class="title">'.$row['title'].'</a></p>';
	echo '<p>'.$row['details'].'</p>';
	echo '<p>Price: Rs '.$row['price'].'</p>';
	echo '<p>Contact: '.$row['contact'].'</p>';
	echo '</div>';
}
?>
<span class="more">
<a href="ads.php">View more advertisements</a>
</span>
</div>
<div id="sidebar">
<strong><h2>Our Members</h2></strong>
<hr />
<?php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
$query = "SELECT * FROM students";
$result = mysqli_query($conn,$query) or die("Error querying to the database");
while($row=mysqli_fetch_array($result)) {
	echo '<a class="member1" href="viewprofile.php?sid='.$row['sid'].'">';
	echo '<div class="members">';
	?><img src="profile_pic/<?php echo $row['profile_pic']; ?>" height="45" width="45" /><?php echo '</td>';
	echo '<span class="members0">';
	echo $row['sid'].'<br>';
	echo $row['name'];
	echo '</span>';
	echo '</div>';
	echo '</a>';	 
}
?>
</div>
<div id="footer">
<div align="left">
<ul><li>About us</li><li>Contact Us</li><li>Learn from us</li></ul>
</div>
<div id="footer_right">
<img src="_images/facebook.jpg" width="300px" height="90px" />
<hr />
<img src="_images/twitter.jpg" width="300px" height="90px" />
</div>
</div>
</body>
</html>
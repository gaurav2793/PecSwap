<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
if(isset($_SESSION['sid'])) {
$sid = $_SESSION['sid'];
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
$query="SELECT * FROM students WHERE sid='$sid'";
$result = mysqli_query($conn, $query) or die("Error querying the database");
$row = mysqli_fetch_array($result) or die("Error");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="_scripts/style.css" type="text/css" />
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
#sidebar {
	border:none;
	background:inherit;
}
</style>
<title>Advertisements</title>
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
</div>
<div id="post_ad">
<span id="button"><a href="post_ad.php">Post a Free Ad </a></span>

</div>
<div id="sidebar">
<strong><h3>Categories</h3></strong>
<hr />
<a href='ads.php?category=mobile_phones' class="category">Mobile Phones and<br /> Accessories</a>
<a href='ads.php?category=electrical_appliances' class="category">Electrical Apliances</a>
<a href='ads.php?category=books' class="category">Books and Novels</a>
<a href='ads.php?category=others' class="category">Others</a>
</div>
<div id="main0">
<form action="search.php" method="get">
<input type="text" name="search" id="search1" value="Search" 
onfocus="if(this.value=='Search') { this.value=''; }" 
onblur="if(this.value=='') { this.value='Search'; }" />
</form>
<?php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
if(isset($_GET['category'])) {
	$category=$_GET['category'];
	$query ="SELECT * FROM ads WHERE category='$category' ORDER BY date desc ";
	$result=mysqli_query($conn,$query);
} else {
	$query = "SELECT * FROM ads ORDER BY date desc LIMIT 5";
	$result=mysqli_query($conn,$query);
}
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
<div id="footer">
</div></div></center>
</body>
</html>
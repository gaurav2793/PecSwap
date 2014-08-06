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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['name']; ?></title>
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
    <img class="logged" src="profile_pic/<?php echo $row['profile_pic']; ?>" height="120" width="110"  />
    
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
<div id="post_ad">
<span id="button"><a href="post_ad.php">Post a Free Ad </a></span>

</div>
<div id="sidebar">
<strong><h3>Categories</h3></strong>
<hr />
<a href='profile.php?category=mobile_phones' class="category">Mobile Phones and<br /> Accessories</a>
<a href='profile.php?category=electrical_appliances' class="category">Electrical Apliances</a>
<a href='profile.php?category=books' class="category">Books and Novels</a>
<a href='profile.php?category=others' class="category">Others</a>
</div>
<div id="main0">
<form action="search.php" method="get">
<input type="text" name="search" id="search1" value="Search" />
</form>
<?php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
if(isset($_GET['category'])) {
	$category=$_GET['category'];
	$query ="SELECT * FROM ads WHERE category='$category' and posted_by='$sid' ORDER BY date desc ";
	$result=mysqli_query($conn,$query);
} else {
	$query = "SELECT * FROM ads where posted_by='$sid' ORDER BY date desc LIMIT 4";
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

</div>



</body>
</html>
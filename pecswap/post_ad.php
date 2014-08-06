<?php
require_once('connection.php');
session_start();
if(!isset($_SESSION['sid'])) {
	if(isset($_COOKIE['sid'])) {
		$_SESSION['sid']=$_COOKIE['sid'];
	}
}
if(!isset($_SESSION['sid'])) {
	header('Location:login.php');
}
$sid = $_SESSION['sid'];
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
$query="SELECT * FROM students WHERE sid='$sid'";
$result = mysqli_query($conn, $query) or die("Error querying the database");
$row = mysqli_fetch_array($result) or die("Error");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="_scripts/form.css" type="text/css" />
<link rel="stylesheet" href="_scripts/style.css" type="text/css" />
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
<title>Post a free Ad!</title>
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
Post a Free Advertisement
</h1>
<hr width="1000px" />
<?php
if(isset($_POST['submit'])) {
	$category = $_POST['category'];
	$title = $_POST['title'];
	$details = $_POST['details'];
	$price = $_POST['price'];
	$contact = $_POST['contact'];
	if(empty($contact) || empty($title)) { echo '<p class="errors">Contact number and Title are required to be filled</p>'; display_form(); }
	/*if(!empty($_FILES['picture']['name'])) {
		rename($_FILES['picture']['name'],"$ad_no.jpg");
		move_uploaded_file($_FILES['picture']['tmp_name'],"ads_pic/$ad_no.jpg");
		$picture = "$ad_no.jpg";
		$ad_no++;
	} else {
		$picture = 'default.jpg';
	}*/
	$query = "INSERT INTO ads(date,title,details,price,contact,posted_by,category,picture) VALUES(CURRENT_TIMESTAMP,'$title','$details','$price','$contact','$sid','$category','$picture')";
	mysqli_query($conn, $query) or die("Error querying to database2");
	$query="SELECT ad_no FROM ads WHERE title='$title' AND details='$details'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result);
	$ad_no=$row['ad_no'];
	if(!empty($_FILES['picture']['name'])) {
		rename($_FILES['picture']['name'],"$ad_no.jpg");
		move_uploaded_file($_FILES['picture']['tmp_name'],"ads_pic/$ad_no.jpg");
		$picture = "$ad_no.jpg";
		$query="UPDATE ads SET picture='$picture' WHERE title='$title' AND details='$details'";
		mysqli_query($conn,$query);
	} else {
		$picture = 'default.jpg';
		$query="UPDATE ads SET picture='$picture' WHERE title='$title' AND details='$details'";
		mysqli_query($conn,$query);
	}
	header('Location:index.php');
} else {
	display_form();
}
function display_form() {
	$sid = $_SESSION['sid'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
	$query="SELECT * FROM students WHERE sid='$sid'";
	$result = mysqli_query($conn, $query) or die("Error querying the database");
	$row = mysqli_fetch_array($result) or die("Error");
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<table id="signup">
	<tr>
    	<td>Category:</td>
        <td><select name="category" id="category">
        <option value="mobile_phones" <?php if( isset( $_POST['category']) && $_POST['category'] == 'mobile_phones' ) {
		echo 'selected="selected"'; } ?> >Mobile Phones and Accessories</option>
        <option value="electrical_appliances"  <?php if( isset( $_POST['category']) && $_POST['category'] == 'electrical_appliances' ) {
		echo 'selected="selected"'; } ?> >Electrical Appliances</option>
        <option value="books"  <?php if( isset( $_POST['category']) && $_POST['category'] == 'books' ) {
		echo 'selected="selected"'; } ?> >Books and Novels</option>
        <option value="others"  <?php if( isset( $_POST['category']) && $_POST['category'] == 'others' ) {
		echo 'selected="selected"'; } ?> >Others</option>
        </select></td>
    </tr>
	<tr>
    	<td>Title:</td>
        <td><input type="text" name="title" id="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>" /></td>
    </tr>
    <tr>
    	<td>Details</td>
        <td><textarea name="details" id="details" rows="3" cols="40"></textarea></td>
    </tr>
    <tr>
    	<td>Price ( in Rs.)</td>
        <td><input type="text" name="price"  value="<?php if(isset($_POST['price'])) { echo $_POST['price']; } ?>" /></td>
    </tr>
    <tr>
    	<td>Upload a picture</td>
        <td><input type="file" name="picture"  value="" /></td>
    </tr>
    <tr>
    	<td>Contact No.:</td>
        <td><input type="text" name="contact"  value="<?php if(isset($row['contact'])) { echo $row['contact']; } ?>" /></td>
    </tr>
    <tr>
    	<td></td>
        <td><input type="submit" name="submit" value="Post Ad" /></td>
    </tr>
</table>
</form>
<?php } ?>
</div>

<div id="footer">
</div></div></center>
</body>
</html>
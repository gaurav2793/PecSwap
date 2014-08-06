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
	$row = mysqli_fetch_array($result) or die("Error fetching data");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="_scripts/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="_scripts/style2.css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Our Wall</title>
<style type="text/css">
#post_ad {
	border:1px solid #fffcf2;
	height:auto;
	margin-left:153px;
}
input {
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	margin:6px;
	height:20px;
	padding:0.2em;
}
input[type="text"],input[type="password"], {
	width:140px;
}
textarea {
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border:1px solid #8a8a8a;
	font-size:18px;
	padding:0.3em;
	width:240px;
}
input[type="submit"] {
	width:80px;
	background:#707578;
	color:#fffcf2;
	margin-top:15px;
	height:25px;
}
#main0 {
	margin-top:-281px;
	margin-right:153px;
	margin-bottom:20px;
	width:700px;
	height:auto;
}
h3 {
	margin-left:10px;
}
#share {
	float:right;
	margin-right:14px;
}
#status1 {
	width:400px;
	float:left;
}
.view {
	font-size:13px;
	font-family:Calibri;
}
#post_ad a:hover {
	padding:0;
	background:#707578;
}
.like {
	color:#707578;
}
.comment {
	width:500px;
	height:12px;
	float:left;
	margin-left:38px;
	margin-top:-12px;
	-moz-border-radius:0;
	-webkit-border-radius:0;
	color:#707578;
}
strong {
	text-decoration:none;
	font-size:medium;
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
<?php
if(isset($_SESSION['sid'])) {
	echo '<a href="logout.php">logout</a>';
}
else {
	echo '<a href="signup.php">register</a>';
}
?>
<?php
if(isset($_POST['submit'])) {
	$status=$_POST['status'];
	$name=$row['name'];
	$sid=$row['sid'];
	$picture=$row['profile_pic'];
	$query="INSERT INTO status(status_no,date,status,name,sid,profile_pic) VALUES(NULL,CURRENT_TIMESTAMP,'$status','$name','$sid','$picture')";
	mysqli_query($conn,$query) or die("Error querying the database1");
	header('Location:forum.php');
}
?>
</div>
<div id="top_left" align="left">
<img src="_images/_logo.jpg" />
</div>
<hr />
</div>
<div id="post_ad">
<?php
$query = "SELECT * FROM students where sid='$sid'";
$result = mysqli_query($conn,$query) or die("Error querying to the database");
while($row=mysqli_fetch_array($result)) {
	echo '<div class="members">';
	?><img src="profile_pic/<?php echo $row['profile_pic']; ?>" height="45" width="45" /><?php 
	echo '<span class="members0">';
	echo $row['name'].'<br>';
	echo '<a href="profile.php" class="view">View profile</a>';
	echo '</span>';
	echo '</div>';	 
}
?>
<h3 align="left">Share + Discuss</h3>
<span><form method="post" action="forum.php">
<textarea name="status" id="status" rows="3" ></textarea><br />
<input type="submit" name="submit" value="Share"  id="share"/>
</form></span>
</div>
<div id="main0">
<?php
$query="SELECT * FROM status ORDER BY date DESC LIMIT 4";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($result)) {
	?><img src="profile_pic/<?php echo $row['profile_pic']; ?>" height="45" width="45" class="status_pic" /><?php
	echo '<p class="status1"><strong>'.$row['name'].'</strong><br>';
	echo $row['status'].'<br></p>';
	$status_no=$row['status_no'];
	$query1 = "SELECT * FROM comments WHERE posted_on='$status_no' ORDER BY date DESC LIMIT 2";
	$result1=mysqli_query($conn,$query1) or die("Error fetching comments");
	$no_of_comments=mysqli_num_rows($result1);
	echo '<div class="comments">';
	while($row1=mysqli_fetch_array($result1)) {
		?><img src="profile_pic/<?php echo $row1['profile_pic']; ?>" height="30" width="25" class="status_pic" /><?php
		echo '<p class="status2"><strong>'.$row1['name'].'</strong><br>';
		echo $row1['comment'].'<br></p>'; 
		echo '<hr class="comment_hr">';
		if($no_of_comments>2) {
		echo '<font color="#fffcf2">View more comments</font>';
	}
	} 
	$sid=$_SESSION['sid'];
	$query2 = "SELECT * FROM students WHERE sid='$sid'";
	$result2 = mysqli_query($conn,$query2) or die("Error querying the database");
	$row2 = mysqli_fetch_array($result2) or die("Error fetching data");
	?>
    <img src="profile_pic/<?php echo $row2['profile_pic']; ?>" height="30" width="25" class="status_pic" /><?php
	echo '<p class="status2"><strong>'.$row2['name'].'</strong><br>';
	 ?> 
	<form action="comment.php" method="post">
	<input type="text" name="comment" class="comment" value="Write your comment here..." 
	onfocus="if(this.value=='Write your comment here...') { this.value=''; }" 
	onblur="if(this.value=='') { this.value='Write your comment here...'; }" />
	<input type="hidden" name="posted_on" value="<?php echo $status_no; ?>"  />
	</form>
	<?php
	echo '</p>';
	echo '<hr class="comment_hr">';
	echo '</div>';
echo '<hr>';
}?>
</div>
<div id="footer">
</div>
</center>
</body>
</html>
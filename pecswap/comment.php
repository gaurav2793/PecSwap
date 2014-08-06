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
$comment = $_POST['comment'];
$posted_on = $_POST['posted_on'];
$sid = $_SESSION['sid'];
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error connecting to the database");
$query = "SELECT * FROM students WHERE sid='$sid'";
$result = mysqli_query($conn,$query) or die("Error querying the database");
$row = mysqli_fetch_array($result) or die("Error fetching data");
$name=$row['name'];
$picture=$row['profile_pic'];
$query1 = "INSERT INTO comments(comment_no,date,comment,name,sid,posted_on,profile_pic) VALUES(NULL,CURRENT_TIMESTAMP,'$comment','$name','$sid','$posted_on','$picture')";
mysqli_query($conn,$query1) or die("Error querying the database");
header('Location:forum.php');
?>
<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
include_once("adminHeader.php");
?>
<div>
	<h2>Thank you for your registeration.</h2>
	<a href="registerUser.php">register another user</a>
</div>
<?php
include_once("adminFooter.php");
?>

<?php
session_start();

if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$userid = $_SESSION["uid"];
$childid= $_REQUEST["Id"];
$mpid = $_REQUEST["mpid"];
echo "$mpid";
$date = date("Y-m-d");

  $cnn = mysqli_connect("localhost","root","","rar");
$qry="insert into movingplankids (mpid, ChildId) values ('$mpid', '$childid')";

$cnn->query($qry);

$qry1="update childcase set ctsid='5' where ChildId='$childid' and statusId='12'";
$cnn->query($qry1);

$qry2="insert into childtransportcase (ChildId, UserId, ctsId, Dosc) values ('$childid', '$userid', '5', '$date')";
$cnn->query($qry2);
  header("location: checkListOfKidsForMovingPlan.php?mpid=$mpid");



?>

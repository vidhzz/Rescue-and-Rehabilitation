<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$userid=$_SESSION["uid"];
$mpid=$_REQUEST["mpid"];
$childid=$_REQUEST["childid"];
$date=date("Y-m-d");

$cnn = mysqli_connect("localhost","root","","rar");
$qry="insert into childtransportcase (ChildId, UserId, ctsId, Dosc) values ('$childid', '$userid', '6', '$date')";
$cnn->query($qry);

$qry1="update childcase set ctsid='6' where statusId='12' and ChildId='$childid'";
$cnn->query($qry1);


header("location: checklistOfKids.php?mpid=$mpid");
?>

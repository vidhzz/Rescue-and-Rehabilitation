<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$choice=$_POST["status"];
$udid=$_POST["udid"];

$date=date("Y-m-d");

$cnn = mysqli_connect("localhost","root","","rar");
if($choice == "approved"){
  $qry1="update uploaddocs set status='$choice' where udid='$udid' ";
  $cnn->query($qry1);

}
if($choice == "rejected"){
  $reason=$_POST["reason"];
  $qry1="update uploaddocs set status='$choice', rejectreason='$reason', dateOfRejection='$date' where udid='$udid'";
  $cnn->query($qry1);
}
header("location: docsListForVerification.php");


?>

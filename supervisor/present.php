<?php
      session_start();
      if($_SESSION["logged_in"]==False){
   	 	header("location: ../loginUser.php");
   	 }
      $suid = $_SESSION["uid"];
      $id = $_REQUEST["Id"];

      $date = date("Y-m-d");


      $cnn = mysqli_connect("localhost","root","","rar");
      $qry="update child set Checked='Present' where ChildId= $id ";
      $cnn->query($qry);

      #adding supervisor id in child table.
      $qry2 = "update Child set SuUserId='$suid', DoSupervisor='$date' where ChildId='$id' ";
      $cnn->query($qry2);

      header("location:attendance.php");
?>

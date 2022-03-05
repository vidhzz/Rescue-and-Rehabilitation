<?php

session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$count = $_SESSION["count1"];
$count++;
$_SESSION["count"] = $count;
$cnn = mysqli_connect("localhost","root","","rar");
$result5 = $cnn->query("select * from treatmentques");
$totalRows = mysqli_num_rows($result5);
if($count<=$totalRows){
				//$count++;
				$table4 = "<table id='simple-table' class='table  table-bordered table-hover' style='font-size: 15px;'>";
					//$count = $_SESSION["count"];
					$qry4 = "select * from treatmentques where TqId='$count'";
					$result4 = $cnn->query($qry4);
					$row4  = $result4->fetch_assoc();
					$table4.="<tr><td colspan='2'>".$row4["TqName"]."</td></tr><tr><td><input type='radio'name='ans' value='".$row4["v1"]."'>".$row4["v1"]."</td><td><input type='radio'name='ans' value='".$row4["v2"]."'>".$row4["v2"]."</td></tr><tr><td><input type='radio'name='ans' value='".$row4["v3"]."'>".$row4["v3"]."</td><td><input type='radio'name='ans' value='".$row4["v4"]."'>".$row4["v4"]."</td></tr>";

					$table4.="</table>";
					$_SESSION["table4"] = $table4;
	}
header("location:startTreatment.php");
?>

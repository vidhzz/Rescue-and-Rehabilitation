<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
      $fn="";
      $ln="";
      $childid=$_REQUEST['Id'];
      $count = $_REQUEST['Count'];
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from Child where ChildId='$childid'";
			$result = $cnn->query($qry);
      //$roww=$result->fetch_assoc();
      //$childid = $row["ChildId"];


			/*$qry5="select * from Child where FirstName='$fn' and LastName='$ln'";
			//	echo $qry;
			$result5 = $cnn->query($qry5);
			$row5 = $result->fetch_assoc();
			$childid = $row5["ChildId"];*/

		//	$qr2="select max(statusId) as statusId from childcase where ChildId='$childid'";
			$qr3="select * from childcase where ChildId='$childid'";


			$result3 = $cnn->query($qr3);

			$count = mysqli_num_rows($result3);
			if($count % 2 == 0 ){
          $count = $count/2;
			}else{
				$count = $count - 1;
        $count = $count/2;
			}






					$str = "<table border='3' style='width:100%; height:100%; text-align:center;'> ";
					while($row1=$result->fetch_assoc()){

                $fn = $row1["FirstName"];
                $ln = $row1["LastName"];
								$str.="	<tr><td colspan='2' align='center'><img src='../pics/".$row1["Photo"]."' height='100' width='100'></td></tr>
								<tr><th>IOM</th><td>".$row1["IOM"]."</td></tr>
								<tr><th>UAM</th><td>".$row1["UAM"]."</td></tr>
								<tr><th>Full Name</th><td>".$row1["FirstName"]." ".$row1["LastName"]."</td></tr>
								<tr><th>Father Name</th><td>".$row1["FatherName"]."</td></tr>
								<tr><th>Mother Name</th><td>".$row1["MotherName"]."</td></tr>
								<tr><th>Date of Birth</th><td>".$row1["DOB"]."</td></tr>
								<tr><th>Age</th><td>".$row1["Age"]."</td></tr>
								<tr><th>Gender</th><td>".$row1["Gender"]."</td></tr>
								<tr><th>Education</th><td>".$row1["Education"]."</td></tr>
								<tr><th>Qualification</th><td>".$row1["Qualification"]."</td></tr>
								<tr><th>Sessions Completed</th><td>".$count."<br><a href='sessionDetails.php?Count="$count"&Id=".$row1["ChildId"]."'>click here for fullfledge details</a></td></tr>

							 ";



			$str.="</table>";
		}





?>



<?php
include_once("psyOfficerHeader.php");
?>

						<div class="page-header">
							<h1>
								Details of <?php echo "$fn $ln"; ?>

							</h1>
						</div><!-- /.page-header -->


							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php

									echo $str;

								?>


							</div><!-- /.col -->
						<!-- /.row -->


<?php
	include_once("psyOfficerFooter.php");
?>

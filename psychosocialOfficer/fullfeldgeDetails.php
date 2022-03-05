<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
	$fn="Farah";
	$ln="Khan";
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from Child where FirstName='$fn' and LastName='$ln'";
			//	echo $qry;
			$result = $cnn->query($qry);
			$tot = mysqli_num_rows($result);


			/*$qry5="select * from Child where FirstName='$fn' and LastName='$ln'";
			//	echo $qry;
			$result5 = $cnn->query($qry5);
			$row5 = $result->fetch_assoc();
			$childid = $row5["ChildId"];*/



			$qr33="select child.ChildId from child inner join childcase on child.ChildId=childcase.ChildId where FirstName='$fn' and LastName='$ln'";
			$result33 = $cnn->query($qr33);
			$row33=$result33->fetch_assoc();
			$childid = $row33["ChildId"];



			$qr3="select * from childcase where ChildId='$childid'";
			$result3 = $cnn->query($qr3);
			$count = mysqli_num_rows($result3);
			if($count % 2 == 0 ){
				$count = $count/2;
			}else{
				$count = $count - 1;
				$count = $count / 2;
			}









					if($tot > 1){

						$str = "<div class='row'>";
						while($row=$result->fetch_assoc()){

							$str.="<div class='col-sm-2'><ul class='ace-thumbnails clearfix' style='float: right;' > <li>
								<a href='".$row["Photo"]."' data-rel='colorbox'>
									<img width='150' height='150' alt='150x150' src='../pics/".$row["Photo"]."'/>
									<div class='text'>
										<div class='inner'>".$row["FirstName"]." ".$row["LastName"]."</div>
									</div>
								</a>

								<div class='tools tools-bottom'>
									<a href='".$row["Photo"]."' data-rel='colorbox'>
										<i class='ace-icon fa fa-search-plus'></i>
									</a>

									<a href='fullfeldgeDetails2.php?Id=".$row["ChildId"]."&Count=".$count."'>
										<i class='ace-icon fa fa-user'></i>
									</a>
								</div>
							</li> </ul></div>";

						}

						$str.="</div>";

					}
					else{



					$str = "<table border='3' style='width:100%; height:100%; text-align:center;'> ";
					while($row1=$result->fetch_assoc()){

								$str.="	<tr><td colspan='2' align='center' style='padding:20px;'><img src='../pics/".$row1["Photo"]."'></td></tr>
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
								<tr><th>Sessions Completed</th><td>".$count."  (<a href='sessionDetails.php?Id=".$childid."&Count=".$count."'>click here for fullfledge details</a>)</td></tr>

							 ";



			$str.="</table>";
		}

		}



?>



<?php
include_once("psyOfficerHeader.php");
?>

						<div class="page-header">
							<h1>
								Details of <?php echo "$fn  $ln"; ?>

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

<?php
/*$pic="";
$iom="";
$uam="";
$fn="";
$ln="";
$fatname="";
$motname="";
$dob="";
$gender="";
$loc="";
$edu="";
$qua="";*/

session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$cnn = mysqli_connect("localhost","root","","RAR");

$pic = $_SESSION["pic"];
$name = $_SESSION["name"];
$userid = $_SESSION["uid"];
$stButton = "<input type='submit' name='st' value='Start Tracing'
style='margin-left:880px;font-size:15px;' class='btn btn-xs btn-danger'";
$childid = $_REQUEST["Id"];
$qryy="select csid from childconference where ChildId='$childid'";
$result1 = $cnn->query($qryy);
$row1= $result1->fetch_assoc();
$csid = $row1["csid"];
$currentdate = Date("Y-m-d");

$str1 = "<input class='btn btn-info' type='submit' name='btn'
value='Conference Details' style='float:right;'><br><br>";
$qry4 = "select conNotes from conferenceDetails where ChildId=$childid";
$result4 = $cnn->query($qry4);
$row4 = $result4->fetch_assoc();
$count12 = mysqli_num_rows($result4);
if($count12==1){
$notes = $row4["conNotes"];
$str3 = "<br><br><br><br>
<div class='widget-box' tyle='width:500px; margin:auto; height:100px''>
						<div class='widget-header'>
								<h2>Child Conference details:</h2>
						</div>
						<div class='well'>
							<h3>".$notes."</h3>
						</div>
						</div>
				";
			}
$qry="select * from child where ChildId='$childid'";
$result=$cnn->query($qry);
if(isset($_POST["btn"])){
	header("location:conferenceDetails.php?id=$childid");
}
//$row=$result->fetch_assoc();
/*$pic=$row["Photo"];
$iom=$row["IOM"];
$uam=$row["UAM"];
$fn=$row["FirstName"];
$ln=$row["LastName"];
$fatname=$row["FatherName"];
$motname=$row["MotherName"];
$dob=$row["DOB"];
$gender=$row["Gender"];
$loc=$row["Locality"];
$edu=$row["Education"];
$qua=$row["Qualification"];*/


		$str = "<div>";
		while($row=$result->fetch_assoc()){

			$str.="<div id='user-profile-1' class='user-profile row'>
					<div class='col-xs-12 col-sm-3 center' style='left: 0px; top: 0px'>
							<div>
									<span class='profile-picture'>
									<img id='avatar' height='200' width='160' alt='Alex's Avatar' src='../pics/".$row["Photo"]."' /> </span>
									<div class='space-4'>
									</div>
									<div class='width-80 label label-info label-xlg arrowed-in arrowed-in-right'>
											<div class='inline position-relative'>

												<span class='white'>".$row["FirstName"]." ".$row["LastName"]."</span> </a>

											</div>
									</div>
							</div>
							<div class='space-6'>
							</div>

					</div>
					<div class='col-xs-12 col-sm-9'>
							<div class='profile-user-info profile-user-info-striped'>

								<div class='profile-info-row'>
										<div class='profile-info-name'>
												IOM
										</div>
										<div class='profile-info-value'>
												<span class='editable' id='iom'>".$row["IOM"]."</span>
										</div>
								</div>

								<div class='profile-info-row'>
										<div class='profile-info-name'>
												UAM
										</div>
										<div class='profile-info-value'>
												<span class='editable' id='uam'>".$row["UAM"]."</span>
										</div>
								</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													FirstName
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='fn'>".$row["FirstName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													LastName
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='ln'>".$row["LastName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Father Name
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='fatname'>".$row["FatherName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Mother Name
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='motname'>".$row["MotherName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													DOB
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='dob'>".$row["DOB"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Gender
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='gender'>".$row["Gender"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Locality
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='loc'>".$row["Locality"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Education
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='edu'>".$row["Education"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
												Qualification
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='qua'>".$row["Qualification"]."</span>
											</div>
									</div>

							</div>
					</div>
			</div>";

		}
		$str.="</div>";

?>




<?php
include_once("socialHeader.php");
?>

<div class="main-content-inner">
	<div class="page-content">
	<div class="ace-settings-container" id="ace-settings-container">
			<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
					<i class="ace-icon fa fa-cog bigger-130"></i>
			</div>

			<div class="ace-settings-box clearfix" id="ace-settings-box">
					<div class="pull-left width-50">
							<div class="ace-settings-item">
									<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
													<option data-skin="no-skin" value="#438EB9">#438EB9</option>
													<option data-skin="skin-1" value="#222A2D">#222A2D</option>
													<option data-skin="skin-2" value="#C6487E">#C6487E</option>
													<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
									</div>
									<span>&nbsp; Choose Skin</span>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
									<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
									<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
									<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
									<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
									<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
									</label>
							</div>
					</div><!-- /.pull-left -->

					<div class="pull-left width-50">
							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
									<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
									<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
							</div>

							<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
									<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
							</div>
					</div><!-- /.pull-left -->
			</div><!-- /.ace-settings-box -->
	</div><!-- /.ace-settings-container -->

						<div class="page-header">
                            <h1>User Profile Page
								</h1>
                        </div>
<!-- /.page-header -->
						<form method="post">
							<?php

							 		if($csid==1){
										echo $str1;
									}

								?>


						<div class="row">

								<!-- PAGE CONTENT BEGINS -->
							<!--	<div class="hr dotted"> -->


                                <div>

																	<?php

																		echo $str;
																		if($csid==2){
																			echo $str3;
																		}

																	?>

                                </div>
								</form>

													</div>

                        </div>
											</div>



<?php
include_once("socialFooter.php");
?>

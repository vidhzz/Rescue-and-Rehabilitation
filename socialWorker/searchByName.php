


<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];

		$firstName = "";
		$lastName = "";
		$User = "";
		$msg="";
		$notFname = "";
		$notLname = "";
		$count1 = 0;
		$info = "";
		$info1 = "";
		if(isset($_POST["btn"])){
			$firstName = $_POST["FirstName"];
			$lastName = $_POST["LastName"];
			if(!preg_match("/^([a-zA-Z' ]+)$/",$firstName) or empty($firstName)){
				$notFname = "<font color='red'>Enter correct First Name</font>";
				$count1 = $count1 + 1;
			}
			if(!preg_match("/^([a-zA-Z' ]+)$/",$lastName) or empty($lastName)){
				$notLname = "<font color='red'>Enter correct Last Name</font>";
				$count1 = $count1 + 1;
			}

			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from child where FirstName='$firstName' and LastName='$lastName'";
			$result = $cnn->query($qry);
			$row = $result->fetch_assoc();
			$childid = $row["ChildId"];
			$qry1 = "select max(ctsId) as ctsId from childtransportcase where ChildId='$childid'";
			//echo $qry1;
			$result1 = $cnn->query($qry1);
			$row1 = $result1->fetch_assoc();
			$cc = mysqli_num_rows($result1);
		//	echo $row1["ctsId"];
if($count1==0){
			if($cc!=0){
					if($row1["ctsId"]==7){

				//	$result = $cnn->query($qry);
					$count = mysqli_num_rows($result);
					if($count > 0 ){
					$User = "<table id='simple-table' class='table  table-bordered table-hover'><tr><th class='detail-col'>Photo</th><th>IOM</th><th>UAM</th><th>Name</th><th>View Profile</th></tr>";
						while ($row=$result->fetch_assoc()) {
						$User.="<tr><td class='center'><img src='pics/".$row["Photo"]."' height='140' width='180'></td><td class='center'>".$row["IOM"]."</td><td class='center'>".$row["UAM"]."</td><td class='center'>".$row["FirstName"]." ".$row["LastName"]." </td><td class='center'><a href='detailedDisplay.php?Id=".$row["ChildId"]."'>View</a></td></tr>";

						}
					}
					else{
						$msg="<font color='red'>invalid child name, please try again!</font>";
					}
					$User.="</table>";

			}else{
				$info = "<script>alert('The delivery of this child is in progress.');</script>";
			}
}
else{
	$info1 = "<script>alert('Transport progress has not yet started.');</script>";
}
}
		}

		if(isset($_POST["rst"])){

			$firstName="";
			$lastName = "";
			$msg = "";

		}
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
							<h1>
								Search By Child Name

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="FirstName" class="col-xs-10 col-sm-5" value="<?php echo "$firstName";?>" />
											<?php echo "$notFname";?>
										</div>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="LastName" class="col-xs-10 col-sm-5" value="<?php echo "$lastName";?>" />
											<?php echo "$notLname";?>
											<?php
											echo $msg;
											?>
										</div>
									</div>



									<div>
										<?php
											echo $User;
											echo $info;
											echo $info1;
										?>
									</div>



									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" name="btn" value="Search">



											&nbsp; &nbsp; &nbsp;
											<input class="btn" type="submit" value="Reset" name="rst">

										</div>
									</div>

									<div class="hr hr-24"></div>
								</div>
							</div>
						</div>
					</div>



<?php
include_once("socialFooter.php");
?>

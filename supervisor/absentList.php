


<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$pic = $_SESSION["pic"];
$name = $_SESSION["name"];
		$firstName = "";
		$lastName = "";
		$User = "";
		$msg="";
		$msg1="";
		$count = 0;
		$notFname = "";
		$notLname = "";

		if(isset($_GET["btn"])){
			$firstName = $_GET["FirstName"];
			$lastName = $_GET["LastName"];

			if(!preg_match("/^([a-zA-Z' ]+)$/",$firstName) or empty($firstName)){
				$notFname = "<font color='red'>Enter correct First Name</font>";
				$count = $count + 1;
			}
			if(!preg_match("/^([a-zA-Z' ]+)$/",$lastName) or empty($lastName)){
				$notLname = "<font color='red'>Enter correct Last Name<br></font>";
				$count = $count + 1;
			}

			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from user where FirstName='$firstName' and LastName='$lastName' and UTypeId='1'";
			$result = $cnn->query($qry);
			$row=$result->fetch_assoc();
			$count1 = mysqli_num_rows($result);
			if($count1 > 0){
			$scid = $row["UserId"];
			$qryy = "select * from child where ScUserId='$scid' and Checked='Absent'";
			if($count==0){
			$resultt = $cnn->query($qryy);
			$count = mysqli_num_rows($resultt);
			if($count > 0 ){
			$User = "<table id='simple-table' class='table  table-bordered table-hover'><tr><th class='detail-col'>Photo</th><th>IOM</th><th>UAM</th><th>Name</th><th>View Profile</th></tr>";
				while ($roww=$resultt->fetch_assoc()) {
				$User.="<tr><td class='center'><img src='pics/".$roww["Photo"]."' height='140' width='180'></td><td class='center'>".$roww["IOM"]."</td><td class='center'>".$roww["UAM"]."</td><td class='center'>".$roww["FirstName"]." ".$roww["LastName"]." </td><td class='center'><a href='detailedDisplayOfEntrySup.php?Id=".$roww["ChildId"]."'>View</a></td></tr>";

				}
				$User.="</table>";
			}
			else{
				$msg="<font color='red'>No Absent Children are Found!</font>";
			}
		}else {
			$msg1="<font color='red'>Invalid Screener Name!</font>";
		}
}
		}

		if(isset($_GET["rst"])){

			$firstName="";
			$lastName = "";
			$msg = "";
			$msg1="";
		}
	?>
<?php
include_once("Supervisorheader.php");
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
								 Absent List

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="get">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Screener's First Name </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="FirstName" class="col-xs-10 col-sm-5" value="<?php echo "$firstName";?>" />
											<?php echo "$notFname";?>
										</div>
										<br><br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Screener's Last Name </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="LastName" class="col-xs-10 col-sm-5" value="<?php echo "$lastName";?>" />
												<?php echo "$notLname";?>
											<?php
											echo $msg;
											echo $msg1;
											?>
										</div>
									</div>



									<div>
										<?php
											echo $User;
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


<?php
include_once("Supervisorfooter.php");
?>

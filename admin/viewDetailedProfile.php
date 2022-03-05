<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$userid="";

$cnn = mysqli_connect("localhost","root","","rar");
$userid = $_REQUEST["Id"];
$qry="Select *,usertype.UTypeName from user inner join usertype on user.UTypeId=usertype.UTypeId where UserId='$userid'";
$result=$cnn->query($qry);
//$row=$result->fetch_assoc();



		$str = "<div>";
		while($row=$result->fetch_assoc()){
			//echo "aaaaaaaaaa";
			$str.="<div id='user-profile-1' class='user-profile row'>
					<div class='col-xs-12 col-sm-3 center' style='left: 0px; top: 0px'>
							<div>
									<span class='profile-picture'>
									<img id='avatar' height='200' width='160' alt='Alex's Avatar' src='pics/".$row["Photo"]."' /> </span>
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
												Gender:
										</div>
										<div class='profile-info-value'>
												<span class='editable' id='iom'>".$row["Gender"]."</span>
										</div>
								</div>

								<div class='profile-info-row'>
										<div class='profile-info-name'>
												User Name:
										</div>
										<div class='profile-info-value'>
												<span class='editable' id='uam'>".$row["UserName"]."</span>
										</div>
								</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													First Name:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='fn'>".$row["FirstName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Last Name:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='ln'>".$row["LastName"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Date of Join:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='fatname'>".$row["DOJ"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Company Number:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='motname'>".$row["ContactNo1"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Mobile Number:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='dob'>".$row["ContactNo2"]."</span>
											</div>
									</div>

									<div class='profile-info-row'>
											<div class='profile-info-name'>
													User Type:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='dob'>".$row["UTypeName"]."</span>
											</div>
									</div>



									<div class='profile-info-row'>
											<div class='profile-info-name'>
													Skype Id:
											</div>
											<div class='profile-info-value'>
													<span class='editable' id='loc'>".$row["SkypeId"]."</span>
											</div>
									</div>



							</div>
					</div>
			</div>";

		}
		$str.="</div>";

?>




<?php
include_once("adminHeader.php");
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
                            <h1>User Profile
								</h1>
                        </div>
                        <!-- /.page-header -->

						<div class="row">
                            <div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<!--	<div class="hr dotted"> -->
                                </div>
                                <div>

									<?php

										echo $str;

									?>




                                </div>

                        </div>
											</div>



<?php
include_once("adminFooter.php");
?>

<?php

session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];
		$oldPass="";
		$newPass="";
		$conPass="";
		$info="";
		$info1="";
		$info2="";
		$count = 0;
		$notPass = "";
		if(isset($_POST["btn"])){

			$oldPass = $_POST["oldPass"];
			$newPass = $_POST["newPass"];
			$conPass = $_POST["conPass"];
			$cnn1 = mysqli_connect("localhost","root","","rar");
			$qry1="select Password from user where UserId='$id'";
			$result = $cnn1->query($qry1);
			$row = $result->fetch_assoc();
			$pass = $row["Password"];
			$uppercase = preg_match('@[A-Z]@', $newPass);
			$lowercase = preg_match('@[a-z]@', $newPass);
			$number    = preg_match('@[0-9]@', $newPass);
			$specialChars = preg_match('@[^\w]@', $newPass);
			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPass) < 8) {
    			$notPass = "<font color='red'>* Password should be at least 8 characters in length<br>* should include at
					least one upper case letter,one number and one special character<font>";
					$count = $count + 1;
			}
			if($oldPass==$pass){
				if($conPass==$newPass){
				$cnn = mysqli_connect("localhost","root","","rar");
				$qry="update user set Password='$conPass' where UserId='$id'";
				if($count==0){
				$cnn->query($qry);
				$info2 = '<font color="green">Password updated successfully!</font>';
			}
				$oldPass="";
				$newPass="";
				$conPass="";
				}
				else{
					$info = '<font color="red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm Password does not match with new password!</font>';
				}
			}

			else{
				$info1 = '<font color="red">Old password is invalid</font>';
			}

		}

		if(isset($_POST["rst"])){

			$oldPass="";
			$newPass="";
			$conPass="";
			$info="";
			$info1="";
		}



	?>
<?php
include_once("Screenerheader.php");
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
								Change Password
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Old Password </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1" name="oldPass" class="col-xs-10 col-sm-5" value="<?php echo $oldPass;?>" />
											<?php
												echo $info1;
											?>
										</div>

										<br><br><br>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> New Password </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1" name="newPass" class="col-xs-10 col-sm-5" value="<?php echo $newPass;?>" />
											<?php echo $notPass;?>
										</div>

										<br><br><br>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1" name="conPass" class="col-xs-10 col-sm-5" value="<?php echo $conPass;?>" />
											<?php
												echo $info;
											?>
										</div>
										<br>
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
										<?php
											echo $info2;
										?>
									</div>






									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" name="btn" value="Change">



											&nbsp; &nbsp; &nbsp;
											<input class="btn" type="submit" value="Reset" name="rst">
											&nbsp; &nbsp; &nbsp;
											<a href="Screener.php">Go to Main page</a>
										</div>
									</div>

									<div class="hr hr-24"></div>
									</form>
								</div>
							</div>
						</div>

<?php
include_once("Screenerfooter.php");
?>

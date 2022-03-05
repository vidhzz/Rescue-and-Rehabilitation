<?php
		session_start();
		if($_SESSION["logged_in"]==False){
		 header("location: ../loginUser.php");
		}
		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];
		$count = 0;
		$count1 = 0;
		//$info=" welcome,&nbsp;&nbsp;&nbsp;$name";

		$fn="";
		$ln="";
		$un="";
		$si="";
		$cn="";
		$pic="";
		$em="";
		$msg="";
		$notFname="";
		$notLname="";
		$notUname="";
		$notCon1="";
		$notSkypeId="";
		$notEmailId="";


		if(isset($_POST["submit"])){
			$fn = $_POST["fn"];
			$ln=$_POST["ln"];
			$cn=$_POST["cn"];
			$un=$_POST["un"];
			$si=$_POST["si"];
			$em = $_POST["em"];

			$cnn = mysqli_connect("localhost","root","","rar");
			if(!preg_match("/^([a-zA-Z' ]+)$/",$fn) or empty($fn)){
				$notFname = "<font color='red'>Enter correct First Name</font>";
				$count1 = $count1 + 1;
			}

			if(!preg_match("/^([a-zA-Z' ]+)$/",$ln) or empty($ln)){
				$notLname = "<font color='red'>Enter correct Last Name</font>";
				$count1 = $count1 + 1;
			}

			if(!preg_match('/^[a-zA-Z0-9]{5,}$/',$un) or empty($un)){
				$notUname = "<font color='red'> Enter correct Username</font>";
				$count1 = $count1 + 1;
			}

			if(strlen($cn)!=9 or !preg_match('/^[1-9][0-9]*$/', $cn)){
				$notCon1 = "<font color='red'> Enter correct contact number</font>";
				$count1 = $count1 + 1;
			}

			if (!preg_match('/^[a-z][a-z0-9\.,\-_]{5,31}$/i', $si)) {
				$notSkypeId = "<font color='red'> Enter correct Skype name</font>";
				$count1 = $count1 + 1;
			}
			if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $em)){
				$notEmailId = "<font color='red'> Enter correct Email Id</font>";
				$count1 = $count1 + 1;
			}
if($count1==0){
			if($cnn->query("update user set FirstName='$fn', LastName='$ln', UserName='$un', ContactNo2='$cn', SkypeId='$si', Email='$em' where UserId='$id' ")){
				$msg="<p style='text-align:center;'><font color='green'>Updated Successfully!</font></p>";
			}else{
				$msg="<p style='text-align:center;'><font color='red'>Error while updating!</font></p>";
			}
		}
	}
		if(isset($_POST["rst"])){
			$count = 1;
			$fn="";
			$ln="";
			$un="";
			$si="";
			$cn="";
			$em="";
		}

		$cnn = mysqli_connect("localhost","root","","RAR");

		$qry="Select * from user where UserId='$id' ";
		$result=$cnn->query($qry);
		$row=$result->fetch_assoc();
		$pic=$row["Photo"];
	if($count==0){

		$cnn = mysqli_connect("localhost","root","","RAR");

		$qry="Select * from user where UserId='$id' ";
		$result=$cnn->query($qry);
		$row=$result->fetch_assoc();
		$fn=$row["FirstName"];
		$ln=$row["LastName"];
		$cn=$row["ContactNo2"];
		$un=$row["UserName"];
		$si=$row["SkypeId"];
		$em=$row["Email"];
	}
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
                            <h1>User Profile Page</h1>
            </div>
                        <!-- /.page-header -->

<div class="row">
	<v class="col-xs-12"> 											<!-- PAGE CONTENT BEGINS -->									<form class="form-horizontal" role="form" method="post" >																					<div class="form-group">																						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  </label>										<div class="col-sm-9">											<img height="200" width="200" class="center"  src="../pics/<?php echo "$pic"; ?>" >													</div>															<br><br>															<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>								<div class="col-sm-9">

		<input type="text"  name="fn" class="col-xs-10 col-sm-5" value="<?php echo "$fn";?>" />
		<?php echo "$notFname";?>
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>
<div class="col-sm-9">
<input type="text"  name="ln" class="col-xs-10 col-sm-5" value="<?php echo "$ln";?>" />
	<?php echo "$notLname";?>
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Name </label>
<div class="col-sm-9">
<input type="text"  name="un" class="col-xs-10 col-sm-5" value="<?php echo "$un";?>" />
	<?php echo "$notUname";?>
</div>
							<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact Number </label>
<div class="col-sm-9">
<input type="text"  name="cn" class="col-xs-10 col-sm-5" value="<?php echo "$cn";?>" />
	<?php echo "$notCon1";?>
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Skype Id </label>
<div class="col-sm-9">
<input type="text"  name="si" class="col-xs-10 col-sm-5" value="<?php echo "$si";?>" />
	<?php echo "$notSkypeId";?>
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email Id </label>
<div class="col-sm-9">
<input type="text"  name="em" class="col-xs-10 col-sm-5" value="<?php echo "$em";?>" />
	<?php echo "$notEmailId";?>
</div>

</div>
<?php echo "$msg"; ?>
<div class="clearfix form-actions">
<div class="col-md-offset-3 col-md-9">
<input class="btn btn-info" type="submit" name="submit" value="Update">
&nbsp; &nbsp; &nbsp;
<input class="btn" type="submit" value="Reset" name="rst">
&nbsp; &nbsp; &nbsp;
<a href="admin.php">Go to Display page</a>
</div>
				</div>
<div class="hr hr-24"></div>

       <!-- /.main-container -->
		 </div>
	 </div>



		<?php
		include_once("adminFooter.php");
		?>

<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$pic = $_SESSION["pic"];
$name = $_SESSION["name"];
$id = $_REQUEST["Id"];
$photo="";
$iom="";
$uam="";
$fn="";
$ln="";
$fatname="";
$motname="";
$dob="";
$Gender="";
$loc="";
$edu="";
$qua="";
$age = "";
$rn="";
$dos="";
$dosu="";
$scid="";
$suid="";
$token = 0;
$msg="";

$notIom = "";
$notUam = "";
$notRn = "";
$notFn = "";
$notLn = "";
$notFatn = "";
$notMotn = "";
$notDate = "";
$notAge = "";
$notGen = "";
$notLoc = "";
$notScdate = "";
$notSudate = "";
$notScid = "";
$notEdu = "";
$notQua = "";
$count = 0;
$info123 = "";
$notSuid = "";



			if(isset($_POST["submit"])){
				//$photo=$_POST["pic"];
				$iom=$_POST["iom"];
				$uam=$_POST["uam"];
				$fn=$_POST["fn"];
				$ln=$_POST["ln"];
				$fatname=$_POST["fatname"];
				$motname=$_POST["motname"];
				$dob=$_POST["dob"];
			//	$gender=$_POST["gender"];
				$age=$_POST["age"];
				$loc=$_POST["loc"];
				$edu=$_POST["edu"];
				$qua=$_POST["qua"];
				$rn=$_POST["rn"];
				$dos=$_POST["dos"];
				$dosu=$_POST["dosu"];
				$scid=$_POST["scid"];
				$suid=$_POST["suid"];

				if(!ctype_alnum($iom)){
					$notIom = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!ctype_alnum($uam)){
					$notUom = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!is_numeric($age)){
					$notAge = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!is_numeric($scid)){
					$notScid = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!is_numeric($suid)){
					$notSuid = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(is_numeric($loc)){
					$notLoc = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!ctype_alpha($edu)){
					$notEdu = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(!ctype_alpha($qua)){
					$notQua = "<font color='red'>Invalid Entry</font>";
					$count = $count + 1;
				}
				if(empty($dob)){
					$notDate = "<font color='red'>Enter Date</font>";
					$count = $count + 1;
				}
				if(empty($dos)){
					$notScdate = "<font color='red'>Enter Date</font>";
					$count = $count + 1;
				}
				if(empty($dosu)){
					$notSudate = "<font color='red'>Enter Date</font>";
					$count = $count + 1;
				}


				if(!preg_match("/^([a-zA-Z' ]+)$/",$fn) or empty($fn)){
					$notFn = "<font color='red'>Enter correct First Name</font>";
					$count = $count + 1;
				}
				if(!preg_match("/^([a-zA-Z' ]+)$/",$ln) or empty($ln)){
					$notLn = "<font color='red'>Enter correct Last Name</font>";
					$count = $count + 1;
				}
				if(!preg_match("/^([a-zA-Z' ]+)$/",$rn) or empty($rn)){
					$notRn = "<font color='red'>Enter correct registeration Name</font>";
					$count = $count + 1;
				}
				if(!preg_match("/^([a-zA-Z' ]+)$/",$fatname) or empty($fatname)){
					$notFatn = "<font color='red'>Enter correct father Name</font>";
					$count = $count + 1;
				}
				if(!preg_match("/^([a-zA-Z' ]+)$/",$motname) or empty($motname)){
					$notMotn = "<font color='red'>Enter correct mother Name</font>";
					$count = $count + 1;
				}
				if(!isset($_POST["gender"])){
					$notGender = "<font color='red'>fill this field</font>";
					$count = $count + 1;
				}
				else{
					$Gender=$_POST["gender"];
				}





					$cnn = mysqli_connect("localhost","root","","RAR");


          $qry="update Child set IOM='$iom', UAM='$uam', RegistrationName='$rn', FirstName='$fn', LastName='$ln', FatherName='$fatname', MotherName='$motname', DOB='$dob', Age='$age',
          Gender='$Gender', Locality='$loc', DoScreener='$dos', DoSupervisor='$dosu', ScUserId='$scid', SuUserId='$suid', Education='$edu', Qualification='$qua' where ChildId='$id' ";

				//echo $qry;
if($count == 0){
				if($cnn->query($qry)){
				$msg = "<p style='text-align:center;'><font color='green'>updated successfully!</font></p>";
				}else{
					$msg = "<p style='text-align:center;'><font color='red'>error updating data!</font></p>";
				}
}
			}


			if(isset($_POST["reset"])){
				$token = 1;
				$photo="";
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
				$qua="";
				$age = "";
				$rn="";
				$dos="";
				$dosu="";
				$scid="";
				$suid="";

			}

			if($token == 0){

      $cnn = mysqli_connect("localhost","root","","RAR");

  		$qry="Select * from Child where ChildId='$id' ";
  		$result=$cnn->query($qry);
  		$row=$result->fetch_assoc();
      //$photo=$row["Photo"];
      $iom=$row["IOM"];
      $uam = $row["UAM"];

      $rn = $row["RegistrationName"];
  		$fn=$row["FirstName"];
  		$ln=$row["LastName"];
      $fatname=$row["FatherName"];
  		$motname=$row["MotherName"];
      $dob = $row["DOB"];
      $age = $row["Age"];
      $gender = $row["Gender"];
      $loc = $row["Locality"];
      $dos = $row["DoScreener"];
      $dosu = $row["DoSupervisor"];
      $scid = $row["ScUserId"];
      $suid = $row["SuUserId"];
      $edu = $row["Education"];
      $qua = $row["Qualification"];

		}

	?>





<?php
include_once("Supervisorheader.php");
?>
<div class="main-content-inner">
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
		Edit Profile of Children
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form" method="post">



			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> IOM </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="iom" class="col-xs-10 col-sm-5" value="<?php echo "$iom"; ?>"/>
					<?php echo "$notIom"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> UAM </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="uam" class="col-xs-10 col-sm-5" value="<?php echo "$uam"; ?>" />
					<?php echo "$notUam"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Registration Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="rn" class="col-xs-10 col-sm-5" value="<?php echo "$rn"; ?>" />
					<?php echo "$notRn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="fn" class="col-xs-10 col-sm-5" value="<?php echo "$fn"; ?>"/>
					<?php echo "$notFn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="ln" class="col-xs-10 col-sm-5" value="<?php echo "$ln"; ?>"/>
					<?php echo "$notLn"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Father's Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="fatname" class="col-xs-10 col-sm-5" value="<?php echo "$fatname"; ?>"/>
					<?php echo "$notFatn"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mother's Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="motname" class="col-xs-10 col-sm-5" value="<?php echo "$motname"; ?>"/>
					<?php echo "$notMotn"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date Of Birth </label>

				<div class="col-sm-9">
					<input type="date" id="form-field-1" name="dob" class="col-xs-10 col-sm-5" value="<?php echo "$dob"; ?>" />
					<?php echo "$notDate"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Age </label>

				<div class="col-sm-9">
					<input type="number" id="form-field-1" name="age" class="col-xs-10 col-sm-5" value="<?php echo "$age"; ?>"/>
					<?php echo "$notAge"; ?>

				</div>
			</div>

			<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gender: </label>

					<div class="col-sm-9">

						<input type="radio" id="form-field-1" name="gender" value="male" <?php if($gender=="male") {echo "checked";} ?>/> male
						 &nbsp;&nbsp;&nbsp;
						<input type="radio" id="form-field-1" name="gender" value="female" <?php if($gender=="female") {echo "checked";} ?>/> female
						<?php echo "$notGen"; ?>
					</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Locality  </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="loc" class="col-xs-10 col-sm-5" value="<?php echo "$loc"; ?>"/>
					<?php echo "$notLoc"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date of Screener Entry </label>

				<div class="col-sm-9">
					<input type="date" id="form-field-1" name="dos" class="col-xs-10 col-sm-5" value="<?php echo "$dos"; ?>"/>
					<?php echo "$notScdate"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date of Supervisor Entry </label>

				<div class="col-sm-9">
					<input type="date" id="form-field-1" name="dosu" class="col-xs-10 col-sm-5" value="<?php echo "$dosu"; ?>"/>
					<?php echo "$notSudate"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Screener Id  </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="scid" class="col-xs-10 col-sm-5" value="<?php echo "$scid"; ?>"/>
					<?php echo "$notScid"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Supervisor Id </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="suid" class="col-xs-10 col-sm-5" value="<?php echo "$suid"; ?>"/>
					<?php echo "$notSuid"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Education </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="edu" class="col-xs-10 col-sm-5" value="<?php echo "$edu"; ?>"/>
					<?php echo "$notEdu"; ?>

				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Qualification </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="qua" class="col-xs-10 col-sm-5" value="<?php echo "$qua"; ?>"/>
					<?php echo "$notQua"; ?>

				</div>
			</div>
			<?php echo "$msg"; ?>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">

						<input type="submit" name="submit" value="submit">
						<input type="submit" name="reset" value="reset">
						<a href="editProfileAttendance.php">go back to the edit profile page</a>
				</div>
			</div>
		</form>
	</div>
</div>




<?php
include_once("Supervisorfooter.php");
?>

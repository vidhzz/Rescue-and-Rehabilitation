<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$fn = $_SESSION["fname"];
$ln = $_SESSION["lname"];

$cnn = mysqli_connect("localhost","root","","RAR");
$qry1="select * from user where FirstName='$fn' and LastName='$ln' ";
$result1 = $cnn->query($qry1);

$row1=$result1->fetch_array();
$uid = $row1["UserId"];

$date = date("Y-m-d");


$photo="";
$iom="";
$uam="";
$fn="";
$ln="";
$fatname="";
$motname="";
$dob="";
$Gender="";
$gender = "";
$loc="";
$edu="";
$qua="";
$age = "";
$rn="";
$dos="";
//$dosu="";
$scid="";
$suid="";
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
$notGender = "";
$notLoc = "";
$notScdate = "";
$notScid = "";
$notSuid = "";
$notEdu = "";
$notQua = "";
$count = 0;
$info123 = "";

			if(isset($_POST["submit"])){
				//$photo=$_POST["photo"];
				$iom=$_POST["iom"];
				$uam=$_POST["uam"];
				$fn=$_POST["fn"];
				$ln=$_POST["ln"];
				$fatname=$_POST["fatname"];
				$motname=$_POST["motname"];
				$dob=$_POST["dob"];
				$gender=$_POST["gender"];
				$age=$_POST["age"];
				$loc=$_POST["loc"];
				$edu=$_POST["edu"];
				$qua=$_POST["qua"];
				$rn=$_POST["rn"];
				$dos=$_POST["dos"];
			//	$dosu=$_POST["dosu"];
				$scid=$_POST["scid"];
				$suid=$_POST["suid"];
				if(isset($_FILES['photo'])){
				//  $docType = $_POST["doctype"];
			//	echo "aa";
					 $errors= array();
					 $file_name = $_FILES['photo']['name'];
					 $file_size =$_FILES['photo']['size'];
					 $file_tmp =$_FILES['photo']['tmp_name'];
					 $file_type=$_FILES['photo']['type'];
					 $temp=explode('.',$_FILES['photo']['name']);
					 $file_ext=strtolower(end($temp));

					 $extensions= array("jpeg","jpg","png");

					 if(in_array($file_ext,$extensions)=== false){
							$errors[]="extension not allowed, use jpeg, jpg or png files";
					 }

					 if($file_size > 8097152){
							$errors[]='File size exceed the required!';
					 }

					 if(empty($errors)==true){
							if(move_uploaded_file($file_tmp,"../pics/".$file_name)){

							$photo = $file_name;
						//	echo $photo;

							}
					 }else{
							print_r($errors);
					 }
				}
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
				if(!ctype_alpha($loc)){
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
				if($_POST["iom"]=="" || $_POST["uam"]=="" || $_POST["fn"]=="" || $_POST["ln"]=="" || $_POST["fatname"]=="" || $_POST["motname"]=="" ||
				$_POST["dob"]=="" || $_POST["age"]=="" || $_POST["loc"]=="" || $_POST["edu"]=="" || $_POST["rn"]=="" || $_POST["dos"]=="" || $_POST["scid"]=="" || $_POST["suid"]=="" ){
					$msg = "<p style='text-align:center;' ><font color='red'>Please Fill All The Fields!</font></p>";
				}
				else{
					$cnn = mysqli_connect("localhost","root","","RAR");
					if($count==0){
					$qry="insert into Child (Photo, IOM, UAM, RegistrationName, FirstName, LastName,
					FatherName, MotherName, DOB, Age, Gender, Locality, DoScreener, ScUserId, SuUserId,
					Education, Qualification)
					values ('$photo', '$iom', '$uam', '$rn', '$fn', '$ln', '$fatname', '$motname', '$dob', '$age', '$Gender',
					'$loc', '$dos', '$scid', '$uid', '$edu', '$qua')";
					$cnn->query($qry);
					$info123 = "<script> alert('registered Successfully!') </script>";
			}
		}
		}

			if(isset($_POST["reset"])){

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
				//$suid="";


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
		Register New Child Record

	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload Photo :</label>

				<div class="col-sm-9">
					<input type="file" id="form-field-1" name="photo" class="col-xs-10 col-sm-5" value="<?php echo $photo; ?>" />
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> IOM </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="iom" class="col-xs-10 col-sm-5" value="<?php echo $iom; ?>" />
					<?php echo "$notIom"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> UAM </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="uam" class="col-xs-10 col-sm-5" value="<?php echo $uam; ?>"/>
					<?php echo "$notUam"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Registration Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="rn" class="col-xs-10 col-sm-5" value="<?php echo $rn; ?>"/>
					<?php echo "$notRn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="fn" class="col-xs-10 col-sm-5" value="<?php echo $fn; ?>"/>
					<?php echo "$notFn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="ln" class="col-xs-10 col-sm-5" value="<?php echo $ln; ?>"/>
					<?php echo "$notLn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Father's Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="fatname" class="col-xs-10 col-sm-5" value="<?php echo $fatname; ?>"/>
					<?php echo "$notFatn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mother's Name </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="motname" class="col-xs-10 col-sm-5" value="<?php echo $motname; ?>"/>
					<?php echo "$notMotn"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date Of Birth </label>

				<div class="col-sm-9">
					<input type="date" id="form-field-1" name="dob" class="col-xs-10 col-sm-5" value="<?php echo $dob; ?>"/>
					<?php echo "$notDate"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Age </label>

				<div class="col-sm-9">
					<input type="number" id="form-field-1" name="age" class="col-xs-10 col-sm-5" value="<?php echo $age; ?>"/>
					<?php echo "$notAge"; ?>
				</div>
			</div>
			<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gender: </label>

					<div class="col-sm-9">

						<input type="radio" id="form-field-1" name="gender" value="male" <?php if($Gender=="male")echo "checked"; ?>/> male
						 &nbsp;&nbsp;&nbsp;
						<input type="radio" id="form-field-1" name="gender" value="female" <?php if($Gender=="female")echo "checked"; ?>/> female
						<?php echo "$notGender"; ?>
					</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Locality  </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="loc" class="col-xs-10 col-sm-5"value="<?php echo $loc; ?>" />
					<?php echo "$notLoc"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date of Screener Entry </label>

				<div class="col-sm-9">
					<input type="date" id="form-field-1" name="dos" class="col-xs-10 col-sm-5" value="<?php echo $date; ?>"/>
					<?php echo "$notScdate"; ?>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Screener Id  </label>

				<div class="col-sm-9">
					<input type="number" id="form-field-1" name="scid" class="col-xs-10 col-sm-5" value="<?php echo $scid; ?>"/>
					<?php echo "$notScid"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Supervisor Id  </label>

				<div class="col-sm-9">
					<input type="number" id="form-field-1" name="suid" class="col-xs-10 col-sm-5" value="<?php echo $uid;?>"/>
					<?php echo "$notSuid"; ?>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Education </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="edu" class="col-xs-10 col-sm-5" value="<?php echo $edu; ?>"/>
					<?php echo "$notEdu"; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Qualification </label>

				<div class="col-sm-9">
					<input type="text" id="form-field-1" name="qua" class="col-xs-10 col-sm-5" value="<?php echo $qua; ?>"/>
					<?php echo "$notQua"; ?>
				</div>
				<?php echo "$msg"; ?>
				<?php echo "$info123"; ?>
			</div>


			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">

						<input class="btn btn-info" type="submit" name="submit" value="submit">
						&nbsp; &nbsp; &nbsp;
						<input class="btn btn-info" type="submit" name="reset" value="reset">

				</div>
			</div>
			<div class="hr hr-24"></div>
		</form>
	</div>
</div>
</div>



<?php
include_once("Supervisorfooter.php");
?>

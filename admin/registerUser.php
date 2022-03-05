<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$notFname = "";
		$notLname = "";
		$notUname = "";
		$notGender = "";
		$notCon1 = "";
		$notCon2 = "";
		$notSkypeId = "";
		$notEmailId = "";
		$notUtype = "";
		$notDate = "";
		$notPass = "";
		$count = 0;
		$fName="";
		$lName="";
		$uName = "";
		$pass="";
		//$UTypeId="";
		$notPic = "";
		$Gender="";
		$SkypeId="";
		$EmailId="";
		$photo = "";
		$DOJ= "";
		$contact1="";
		$contact2="";
		$errors = "";
		//$string="";

		$cnn = mysqli_connect("localhost","root","","rar");
		$query = "select * from usertype";
		$string = "<select name='utype' id='ss'><option>select any option</option>";
		$result = $cnn->query($query);
		while($row=$result->fetch_assoc()){
			$string.="<option>".$row["UTypeName"]."</option>";
		}
		$string.="</select>";




		if(isset($_POST["btn"])){
			$fName=$_POST["fname"];
			$lName=$_POST["lname"];
			$uName=$_POST["uname"];
			$pass=$_POST["pass"];

			$UType=$_POST["utype"];
			//echo $UType;
			//$Gender=$_POST["gender"];
			$SkypeId=$_POST["skypeid"];
			$EmailId = $_POST["emailid"];
			//$photo = $_POST["photo"];
			$DOJ= $_POST["doj"];
			$contact1=$_POST["contact1"];
			$contact2=$_POST["contact2"];
			$uppercase = preg_match('@[A-Z]@', $_POST["pass"]);
			$lowercase = preg_match('@[a-z]@', $_POST["pass"]);
			$number    = preg_match('@[0-9]@', $_POST["pass"]);
			$specialChars = preg_match('@[^\w]@', $_POST["pass"]);

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
						$errors ="<br><font color='red'>extension not allowed, use jpeg, jpg or png files</font>";
						$count = $count + 1;
				 }

				 if($file_size > 8097152){
						$errors ='<br><font color="red">File size exceed the required!</font>';
						$count = $count + 1;
					}

				 if(empty($errors)==true){
						if(move_uploaded_file($file_tmp,"../pics/".$file_name)){

						$photo = $file_name;
					//	echo $photo;

						}
				 }
			}

			$cnn = mysqli_connect("localhost","root","","rar");
			if(empty($DOJ)){
				$notDate = "<font color='red'>Enter Date</font>";
				$count = $count + 1;
			}
			if(!isset($_POST["utype"])){
				$notUtype = "<font color='red'>Enter User Type</font>";
				$count = $count + 1;
			}
			if(!preg_match("/^([a-zA-Z' ]+)$/",$fName) or empty($fName)){
				$notFname = "<font color='red'>Enter correct First Name</font>";
				$count = $count + 1;
			}
			if(!preg_match("/^([a-zA-Z' ]+)$/",$lName) or empty($lName)){
				$notLname = "<font color='red'>Enter correct Last Name</font>";
				$count = $count + 1;
			}
			if(!isset($_POST["gender"])){
				$notGender = "<font color='red'>fill this field</font>";
				$count = $count + 1;
			}
			else{
				$Gender=$_POST["gender"];
			}
			if(!preg_match('/^[a-zA-Z0-9]{5,}$/',$uName) or empty($uName)){
				$notUname = "<font color='red'> Enter correct Username</font>";
				$count = $count + 1;
			}
			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["pass"]) < 8) {
    			$notPass = "<font color='red'>* Password should be at least 8 characters in length<br>* should include at
					least one upper case letter,one number and one special character<font>";
					$count = $count + 1;
			}
			if(strlen($contact1)!=9 or !preg_match('/^[1-9][0-9]*$/', $contact1)){
				$notCon1 = "<font color='red'> Enter correct contact number</font>";
				$count = $count + 1;
			}

			if(strlen($contact2)!=9 or !preg_match('/^[1-9][0-9]*$/', $contact2)){
				$notCon2 = "<font color='red'> Enter correct contact number</font>";
				$count = $count + 1;
			}

			if (!preg_match('/^[a-z][a-z0-9\.,\-_]{5,31}$/i', $SkypeId)) {
				$notSkypeId = "<font color='red'> Enter correct Skype name</font>";
				$count = $count + 1;
			}
			if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $EmailId)){
				$notEmailId = "<font color='red'> Enter correct Email Id</font>";
				$count = $count + 1;
			}

			if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) {
				$count = $count + 1;
				$notPic = "<font color='red'> Upload Photo Id</font>";
			}

			$qry1 = "select * from UserType where UTypeName='$UType'";
			$resultt = $cnn->query($qry1);
			$row1 = $resultt->fetch_assoc();
			$utype1 = $row1["UTypeId"];
			//echo $utype1;
			$qry="insert into user (FirstName,LastName,UserName,Password,DOJ,ContactNo1,ContactNo2,Photo,UTypeId,Gender,SkypeId,Email) values
			('$fName','$lName','$uName','$pass','$DOJ','$contact1','$contact2','$photo','$utype1','$Gender','$SkypeId','$EmailId')";
			if($count==0){
				$cnn->query($qry);
				header("location:greeting.php");
			}
		}
		if(isset($_POST["rst"])){
			$fName="";
			$lName="";
			$uName = "";
			$pass="";
			$UTypeId="";
			//$Gender="";
			$SkypeId="";
			$EmailId = "";
			$photo = "";
			$DOJ= "";
			$contact1="";
			$contact2="";
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
							<h1>
								Register User

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal"  role="form" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Upload Photo: </label>

										<div class="col-sm-9">
											<input type="file" id="form-field-1"  name="photo" class="col-xs-10 col-sm-5"/>
											<?php echo "$notPic"; echo $errors; ?>
										</div>
										<br>
										<br>
										<br>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name: </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="fname" class="col-xs-10 col-sm-5" value="<?php echo "$fName";?>" />
											<?php echo "$notFname";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name: </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="lname" class="col-xs-10 col-sm-5" value="<?php echo "$lName";?>" />
											<?php echo "$notLname";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gender: </label>

										<div class="col-sm-9">

											<input type="radio" id="form-field-1"  name="gender" class="" value="male" <?php if($Gender=="male") echo "checked"; ?> /> male

											&emsp;&emsp;
											<input type="radio" id="form-field-1"  name="gender" class="" value="female" <?php if($Gender=="female") echo "checked"; ?> /> female
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<?php echo "$notGender";?>
										</div>
										<br>
										<br>


										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Name: </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="uname" class="col-xs-10 col-sm-5" value="<?php echo "$uName";?>" />
											<?php echo "$notUname";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password: </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1"  name="pass" class="col-xs-10 col-sm-5" value="<?php echo "$pass";?>" />
											<?php echo "$notPass";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact Number 1: </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="contact1" class="col-xs-10 col-sm-5" value="<?php echo "$contact1";?>" />
											<?php echo "$notCon1";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact Number 2: </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="contact2" class="col-xs-10 col-sm-5" value="<?php echo "$contact2";?>" />
												<?php echo "$notCon2";?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date of Join: </label>

										<div class="col-sm-9">
											<input type="date" id="form-field-1"  name="doj" class="col-xs-10 col-sm-5" value="<?php echo "$DOJ";?>" />
											<?php echo "$notDate";?>
										</div>
										<br>
										<br>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Type: </label>

										<div class="col-sm-9">
											<?php
												echo $string;
												echo $notUtype;
											?>
										</div>
										<br>
										<br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><img src="skype.png" height="30" width="30"> Skype Id: </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="skypeid" class="col-xs-10 col-sm-5" value="<?php echo "$SkypeId";?>" />
											<?php echo "$notSkypeId";?>
										</div>
										<br><br><br>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email Id:</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="emailid" class="col-xs-10 col-sm-5" value="<?php echo "$EmailId";?>" />
											<?php echo "$notEmailId";?>
										</div>

									</div>



									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" name="btn" value="Register" >



											&nbsp; &nbsp; &nbsp;
											<input class="btn" type="submit" value="Reset" name="rst">
										</div>
									</div>

									<div class="hr hr-24"></div>
						</form>
					</div>
				</div>
			</div>


<?php
include_once("adminFooter.php");
?>

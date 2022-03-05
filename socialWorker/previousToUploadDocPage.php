<?php

		session_start();
		if($_SESSION["logged_in"]==False){
		 header("location: ../loginUser.php");
		}

		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];
		$startloc="";
		$destloc="";
		$startdate="";
		$delidate="";

		$mpid="";
		$info="";
		$info1="";
		$count = 0;
		$notStartloc = "";
		$notDestloc = "";
		$notStartdate = "";
		$notDelidate = "";
		$notDelidate1 = "";
		$cnn1 = mysqli_connect("localhost","root","","rar");
		if(isset($_POST["btn"])){

			$startloc = $_POST["startloc"];
			$destloc = $_POST["destloc"];
			$startdate = $_POST["startdate"];
			$delidate = $_POST["delidate"];

			if(!ctype_alpha($startloc) or $startloc==""){
	      $notStartloc = "<font color='red'>Invalid Entry</font>";
	      $count = $count + 1;
	    }
			if(!ctype_alpha($destloc) or $destloc==""){
	      $notDestloc = "<font color='red'>Invalid Entry</font>";
	      $count = $count + 1;
	    }
			if(empty($startdate)){
				$notStartdate = "<font color='red'>Enter Date</font>";
				$count = $count + 1;
			}
			$dt1 = new DateTime($startdate);
			$dt2 = new DateTime($delidate);
			if(empty($delidate)){
				$count = $count + 1;
				$notDelidate = "<font color='red'>Enter Date</font>";
			}
			if($dt1>=$dt2){
				$count = $count + 1;
				$notDelidate1 = "<font color='red'>Enter correct date</font>";
			}

 			$cnn1 = mysqli_connect("localhost","root","","rar");
			if($count==0){
			if( !empty("$startloc") and !empty("$destloc") and !empty("$startdate") and !empty("$delidate")){
			$qry1="select mpid from movingplan where fromdate='$startdate' and todate='$delidate' and fromplace='$startloc' and toplace='$destloc' ";
			if($result1=$cnn1->query($qry1)){

				$roww=$result1->fetch_assoc();
				$mpid=$roww["mpid"];
				//echo $mpid;

				header('location: uploadGovtSignedDocs.php?mpid='.$mpid);

			}else{
				$info="<font color='red'>Incorrect entries, please check the fields again!</font>";
			}
		}else{
			$info="<font color='red'>Please complete all the fields!</font>";
		}
	}
			//$row = $result->fetch_assoc();
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
								Fill the form in order to upload the documents related to that details
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Starting location </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="startloc" class="col-xs-10 col-sm-5" value="<?php echo "$startloc";?>" />
											<?php echo "$notStartloc";?>
										</div>



										<br><br><br>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Destination location </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="destloc" class="col-xs-10 col-sm-5" value="<?php echo "$destloc";?>" />
											<?php echo "$notDestloc";?>
										</div>

										<br><br><br>


										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Start date of journey </label>

										<div class="col-sm-9">
											<input type="date" id="form-field-1" name="startdate" class="col-xs-10 col-sm-5" value="<?php echo "$startdate";?>" />
											<?php echo "$notStartdate";?>
										</div>

										<br><br><br>


										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Delivery date of journey  </label>

										<div class="col-sm-9">
											<input type="date" id="form-field-1" name="delidate" class="col-xs-10 col-sm-5" value="<?php echo "$delidate";?>" />
											<?php echo "$notDelidate";?>
											<?php echo "$notDelidate1";?>
										</div>

										<br><br><br>



										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

										<br><br>
										<div style="margin-left: 350px">
										<input class="btn btn-info" type="submit" name="btn" value="Go to upload page" >
										<?php echo "$info"; ?>
									</div>

									</div>


							</div>
						</div>




					</form>

								</div>
							</div>

<?php
include_once("socialFooter.php");
?>

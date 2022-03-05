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
		$notes="";
		$drivername="";
		$mpid="";
		$info="";
		$info1="";
		$count = 0;
		$notStartloc = "";
		$notDestloc = "";
		$notStartdate = "";
		$notDelidate = "";
		$notDelidate1 = "";
		$notDrivername = "";
		$notNotes = "";
		$cnn1 = mysqli_connect("localhost","root","","rar");
		if(isset($_POST["btn"])){

			$startloc = $_POST["startloc"];
			$destloc = $_POST["destloc"];
			$startdate = $_POST["startdate"];
			$delidate = $_POST["delidate"];
			$notes = $_POST["notes"];
			$drivername = $_POST["drivername"];
			if(!ctype_alpha($startloc) or $startloc==""){
	      $notStartloc = "<font color='red'>Invalid Entry</font>";
	      $count = $count + 1;
	    }
			if(!ctype_alpha($destloc) or $destloc==""){
	      $notDestloc = "<font color='red'>Invalid Entry</font>";
	      $count = $count + 1;
	    }
			if(!preg_match("/^([a-zA-Z' ]+)$/",$drivername) or empty($drivername)){
	      $notDrivername = "<font color='red'>Enter correct First Name</font>";
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
			if($notes==""){
				$notNotes = "<font color='red'>Enter Notes</font>";
				$count = $count + 1;
			}
 			$cnn1 = mysqli_connect("localhost","root","","rar");
			if($count==0){

				if( !empty("$startloc") and !empty("$destloc") and !empty("$startdate") and
				!empty("$delidate") and !empty("$notes") and !empty("$drivername")){

					$qry1="insert into movingplan (fromdate, todate, driver, notes, fromplace, toplace, UserId)
					values ('$startdate', '$delidate', '$drivername', '$notes', '$startloc', '$destloc', '$id')";

						if($cnn1->query($qry1)){
							$qryy="select mpid from movingplan where fromdate='$startdate'
							and todate='$delidate' and driver='$drivername' and notes='$notes' and
							fromplace='$startloc' and toplace='$destloc'";
							//echo $qryy;
							$resultt=$cnn1->query($qryy);
							$roww=$resultt->fetch_assoc();
							$mpid=$roww["mpid"];
							//echo $mpid;

							header('location: printMovingPlan.php?mpid='.$mpid);

						}else{
							$info="<font color='red'>Details not inserted!</font>";
						}
			}
		else{
			$info="<font color='red'>Please complete all the fields!</font>";
		}

	}

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
								Moving Plan
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
											<?php echo "$notDelidate1";?>

											<?php echo "$notDelidate";?>
										</div>

										<br><br><br>


										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Driver Full Name  </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="drivername" class="col-xs-10 col-sm-5" value="<?php echo "$drivername";?>" />
											<?php echo "$notDrivername";?>
										</div>

										<br><br><br>


										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Notes<font color='red'>&emsp;(Please include all the stops in between the journey)</font>  </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="notes" class="col-xs-10 col-sm-5" value="<?php echo "$notes";?>" />
											<?php echo "$notNotes";?>
										</div>
										&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

										<br><br>
										<div style="margin-left: 350px">
										<input class="btn btn-info" type="submit" name="btn" value="Save" >
										<?php echo "$info"; ?>
									</div>

									</div>


							</div>
						</div>




					</form>
									<div class="hr hr-24"></div>
								</div>
							</div>

<?php
include_once("socialFooter.php");
?>

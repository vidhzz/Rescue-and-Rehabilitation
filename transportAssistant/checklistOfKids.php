
<?php
	session_start();
	if($_SESSION["logged_in"]==False){
	 header("location: ../loginUser.php");
	}
	$pic = $_SESSION["pic"];
	$name = $_SESSION["name"];
  $mpid=$_REQUEST["mpid"];
	$info=" ";

  $str="";
  $cnn = mysqli_connect("localhost","root","","rar");
	$qry="select * from movingplankids inner join child on movingplankids.ChildId=child.ChildId inner join childaddress on child.ChildId=childaddress.ChildId
	inner join childcase on childaddress.ChildId=childcase.ChildId where mpid='$mpid' and childcase.ctsId='5'";
	$result = $cnn->query($qry);
	$c = mysqli_num_rows($result);

	$str = "";
	if($c > 0){

		while ($row=$result->fetch_assoc()) {

			$str.="<div class='well well-lg' style='float: center;'>

                <b> <h5> Photo :</b><img src='../pics/".$row["Photo"]."' width='110' height='80'>
                <br><br><b> <h5> Name :</b>".$row["FirstName"]." ".$row["LastName"]."
                <br><br><b> <h5> IOM  :</b>".$row["IOM"]."
                <br><br><b> <h5> UAM :</b>".$row["UAM"]."
                <br><br><b> <h5> Area :</b>".$row["area"]."
                <br><br><b> <h5> City :</b>".$row["city"]."
                <br><br><b> <h5> pinCode :</b>".$row["pinCode"]."
                <br><br><b> <h5> State :</b>".$row["state"]."
                <br><br> <a href='redirectVerified.php?mpid=".$mpid."&childid=".$row["ChildId"]."'><input type='submit' class='btn btn-info' name='verkids' value='Click Once Verified'/> </a>

						</div>
            <br>";

		}

		$str.="";

	}else{
		$info="<font color='green'><h5>Done with the verification of current moving plan!</h5><br> <a href='redirect.php?mpid=$mpid'><h3>CLICK HERE TO NOTIFY SOCIAL WORKER</h3></a></font>";
		$str="";
	}





?>

<?php
include_once("TAheader.php");
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
								List of children to verify
							</h1>
						</div>

            <div><?php echo "$str";?></div>
						<div><?php echo "$info";?></div>


					</div>








								<?php
								include_once("TAfooter.php");
								?>

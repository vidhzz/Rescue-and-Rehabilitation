<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$pic = $_SESSION["pic"];
$name = $_SESSION["name"];
if(isset($_POST["btn"])){

$_SESSION["fn"]=$_POST["fn"];
$_SESSION["ln"]=$_POST["ln"];
$_SESSION["date"]=$_POST["date"];
header("location:todaysEntryList.php");
}

if(isset($_POST["rst"])){
	$fn = "";
	$ln = "";
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
								List of Childrens by Date
              </h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post" >

									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Enter Screener's First Name: </label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" name="fn" class="col-xs-10 col-sm-5"  />
									</div>



									<br><br><br>

									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Enter Screener's Last Name: </label>

									<div class="col-sm-9">
										<input type="text" id="form-field-1" name="ln" class="col-xs-10 col-sm-5"  />
									</div>
									<br><br><br>

									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Enter Childrens Registered Date by Screener:<small>(yyyy-mm-dd)</small> </label>

									<div class="col-sm-9">
										<input type="date" id="form-field-1" name="date" class="col-xs-10 col-sm-5"  />
									</div>
									<br><br><br>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" name="btn" value="submit">



											&nbsp; &nbsp; &nbsp;
											<input class="btn" type="submit" value="Reset" name="rst">


										</div>
									</div>



                </form>

              <!--  <div class="hr hr-24"></div>
                <h3>
                  <b>Total: <?php echo "$total"; ?></b>
                </h3>
                <a href="attendanceReport.php">
                <div>
                <button class="search-filter-header bg-primary" >
															<h5>
																View Today's Attendance Report
															</h5>
								</button>
              </div>
						</a> -->

									<div class="hr hr-24"></div>

								</div>
							</div>
						</div>


<?php
include_once("Supervisorfooter.php");
?>

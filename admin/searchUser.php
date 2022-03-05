<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
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
								Search

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box widget-color-dark">


											<div class="widget-body">
												<div class="widget-main">
													&emsp;&emsp;&emsp;&emsp;
													<img src="searchByUser.png">
													<hr />

												</div>

												<div>
													<a href="searchByUser.php" class="btn btn-block btn-inverse">

														<span>User</span>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box widget-color-orange">


											<div class="widget-body">
												<div class="widget-main">
													&emsp;&emsp;&emsp;&emsp;
													<img src="searchByUserType.png" height="128" width="128">

													<hr />

												</div>

												<div>
													<a href="searchByUserType.php" class="btn btn-block btn-warning">

														<span>User Type</span>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box widget-color-blue">


											<div class="widget-body">
												<div class="widget-main">
													&emsp;&emsp;&emsp;&emsp;
													<img src="searchByContact.png">

													<hr />

												</div>

												<div>
													<a href="searchByContact.php" class="btn btn-block btn-primary">

														<span>Contact</span>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box widget-color-green">


											<div class="widget-body">
												<div class="widget-main">
													&emsp;&emsp;&emsp;&emsp;
													<img src="icon.png">

													<hr />

												</div>

												<div>
													<a href="searchByAZ.php" class="btn btn-block btn-success">

														<span>A-Z</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

<?php
include_once("adminFooter.php");
?>

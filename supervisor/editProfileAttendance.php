<?php
		session_start();
		if($_SESSION["logged_in"]==False){
		 header("location: ../loginUser.php");
		}
		$pic = $_SESSION["pic"];
		$name = $_SESSION["name"];
		$fn=$_SESSION["fn"];
		$ln=$_SESSION["ln"];
		$date = $_SESSION["date"];

		$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from user where FirstName='$fn' and LastName='$ln' ";
			$result = $cnn->query($qry);
			$row=$result->fetch_assoc();
			$userid = $row["UserId"];

			$qry1="select * from Child where ScUserId = '$userid' and Checked='Present' and DoScreener='$date' ";
			$result1 = $cnn->query($qry1);



			$str = "<table id='simple-table' class='table  table-bordered table-hover'><tr><th colspan='3' class='search-filter-header bg-primary' style='font-size:25px;'>Present Childrens</th></tr><tr><th class='detail-col' style='font-size:20px;' ><b>Photo</b></th><th class='center' style='font-size:20px;'><b>Full Name</b></th><th class='center' style='font-size:20px;'><b>Edit Profile</b></th></tr>";
			while ($row1=$result1->fetch_assoc()) {

           //$childid = $row1["ChildId"];
    				$str.="<tr><td class='center'><img src='pics/".$row1["Photo"]."' height='140' width='180'></td><td class='center' style='font-size:18px;'>".$row1["FirstName"]." ".$row1["LastName"]."</td><td class='center' style='font-size:18px;'><a href='editProfileOfChildren.php?Id=".$row1["ChildId"]."'>edit profile</a></td></tr>";

			}

		$str.="</table>";





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
								Edit Profiles
              </h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post" action="supervisor.php">

									<div>
										<?php
											echo $str;
										?>
									</div>

                  <br><br>
                  <p style="text-align:right;"><input type="submit" name="btn" value="Done" class="btn btn-info"></p>



                </form>
							</div>
						</div>
					</div>






<?php
include_once("Supervisorfooter.php");
?>

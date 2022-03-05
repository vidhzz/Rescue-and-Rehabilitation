<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select *,childcase.childid from child inner join childcase on child.childid=childcase.childid where statusid='12'";
		//	echo $qry;
			$result = $cnn->query($qry);

			$str = "<div class='row'>";
			while($row=$result->fetch_assoc()){

				$str.="<div class='col-sm-2'><ul class='ace-thumbnails clearfix' 	style='float: right;' > <li>
					<a href='".$row["Photo"]."' data-rel='colorbox'>
						<img width='150' height='150' alt='150x150' src='../pics/".$row["Photo"]."'/>
						<div class='text'>
							<div class='inner'>".$row["FirstName"]." ".$row["LastName"]."</div>
						</div>
					</a>

					<div class='tools tools-bottom'>
						<a href='../pics/".$row["Photo"]."' data-rel='colorbox'>
							<i class='ace-icon fa fa-search-plus'></i>
						</a>

						<a href='childDetailInfo.php?Id=".$row["ChildId"]."'>
							<i class='ace-icon fa fa-user'></i>
						</a>
					</div>
				</li> </ul></div>";

			}

			$str.="</div>";



?>



<?php
include_once("psyOfficerHeader.php");
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
								closed Case

							</h1>
						</div><!-- /.page-header -->


							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php

									echo $str;

								?>


							</div><!-- /.col -->
						<!-- /.row -->
					</div>


<?php
	include_once("psyOfficerFooter.php");
?>

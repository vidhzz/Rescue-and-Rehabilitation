<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
?>
<?php
include_once("psyOfficerHeader.php");
?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">UI &amp; Elements</a>
							</li><a href="#">Home</a>
							<li class="active">Elements</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

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
							<h1 class="center">
								PSYCHOSOCIAL BENEFICIARY FORM
							</h1>
						</div><!-- /.page-header -->

            <!-- <div align="right">

                 <b>Form Number:</b> <input type="text" name="formnum">
                 <div class="hr  hr-bold hr18"></div>
            </div> -->


            <!--<div class="center">
              <h4><i>Individual Forms</i></h4>
            </div>-->
            <form method="post">
            <font size="3">
                <table border="2" width="90%" height="600" align="center" cellpadding="20">

                  <tr>
                    <th>Child situation and result in the first session</th>
                    <th>Child situation and result in the second session</th>
                    <th>Child situation and result in the third session</th>
                  </tr>

                  <tr>

                    <td><textarea rows="8" cols="40">

                    </textarea></td>
                    <td><textarea rows="8" cols="45">

                    </textarea></td>
                    <td><textarea rows="8" cols="40">

                    </textarea></td>

                  </tr>

                  <tr>
                    <td colspan="3">
                      &emsp;
                      <input type="checkbox" name="lit" value="lit">case in progress
                      &emsp; &emsp; &emsp;
                      <input type="checkbox" name="lit" value="lit">case referred
                      &emsp; &emsp; &emsp;
                      <input type="checkbox" name="lit" value="lit">name of referred agency
                      &emsp; &emsp; &emsp;
                      <input type="checkbox" name="lit" value="lit">case discussed in conference
                    </td>


                  </tr>

                  <tr>

                    <td colspan="3">
                      <p style="text-align:center">Final details</p>
                      <textarea rows="8" cols="140">

                      </textarea>
                    </td>

                  </tr>

                  </table>
                  </font>

                  <br><br>



          </form>






										</div>
									</div><!-- /.col -->
								</div>

									<div class="vspace-6-sm"></div>
									<div class="hr hr-double hr-dotted hr18"></div>





<?php
include_once("psyOfficerFooter.php");
?>

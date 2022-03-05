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
			$qry="select * from user where FirstName='$fn' and LastName='$ln'";
			$result = $cnn->query($qry);
      $row=$result->fetch_assoc();
			$userid = $row["UserId"];
      $qry1="select * from Child where ScUserId = '$userid' and DoScreener='$date' and Checked='Present'";
			$result1 = $cnn->query($qry1);

			$str = "<div class='row'>";
			while($row1=$result1->fetch_assoc()){

				$str.="<div class='col-sm-2'><ul class='ace-thumbnails clearfix' style='float: right;' > <li>
					<a href='".$row1["Photo"]."' data-rel='colorbox'>
						<img width='150' height='150' alt='150x150' src='../pics/".$row1["Photo"]."'/>
						<div class='text'>
							<div class='inner'>".$row1["FirstName"]." ".$row1["LastName"]."</div>
						</div>
					</a>

					<div class='tools tools-bottom'>
						<a href='../pics/".$row1["Photo"]."' data-rel='colorbox'>
							<i class='ace-icon fa fa-search-plus'></i>
						</a>

						<a href='editProfileOfChildren.php?Id=".$row1["ChildId"]."'>
							<i class='fa fa-edit'></i>
						</a>
					</div>
				</li> </ul></div>";

			}

			$str.="</div>";


      $qry2="select * from Child where ScUserId = '$userid' and DoScreener='$date' and Checked='Absent' ";
			$result2 = $cnn->query($qry2);
      $str2 = "<div class='row'>";
			while($row2=$result2->fetch_assoc()){

				$str2.="<div class='col-sm-2'><ul class='ace-thumbnails clearfix' style='float: right;' > <li>
					<a href='".$row2["Photo"]."' data-rel='colorbox'>
						<img width='150' height='150' alt='150x150' src='../pics/".$row2["Photo"]."'/>
						<div class='text'>
							<div class='inner'>".$row2["FirstName"]." ".$row2["LastName"]."</div>
						</div>
					</a>

					<div class='tools tools-bottom'>
						<a href='../pics/".$row2["Photo"]."' data-rel='colorbox'>
							<i class='ace-icon fa fa-search-plus'></i>
						</a>


					</div>
				</li> </ul></div>";

			}

			$str2.="</div>";










?>



<?php
include_once("Supervisorheader.php");
?>
<div class="main-content-inner">
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
								Record of Children (By: <?php echo "$fn $ln"; ?> &nbsp;  &nbsp;  Date: <?php echo "$date"; ?>)

							</h1>
						</div><!-- /.page-header -->

            <div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                <h3><font color='#0066FF'>Present Children</font></h3>
								<?php

									echo $str;

								?>
                <br> <br>
                <h3><font color='#0066FF'>Absent Children</font></h3>
                <?php

                  echo $str2;

                ?>

                <br><br>
                <a href="todaysEntryBySupervisor.php">go back to view and edit page</a>


							</div><!-- /.col -->
						</div><!-- /.row -->


				<?php
				include_once("Supervisorfooter.php");
				?>

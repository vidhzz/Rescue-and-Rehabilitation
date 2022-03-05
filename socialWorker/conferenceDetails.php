<?php


session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
//$userid = $_SESSION["uid"];
$childid = $_REQUEST["id"];
$info3 = "";
$cnn = mysqli_connect("localhost","root","","RAR");
$det = "";
$dd = Date("Y-m-d");
$qry2 = "select * from conferenceDetails where ChildId=$childid";
$result = $cnn->query($qry2);
$row = mysqli_num_rows($result);
if($row==1){
  $rows = $result->fetch_assoc();
  $det = $rows["conNotes"];
  if(isset($_POST["btn"])){
    $conDet = $_POST["con"];
    $qry2 = "update conferenceDetails set conNotes='$conDet',date='$dd',
    submit='yes' where ChildId='$childid'";
    $qry22 = "update childconference set csid='2' where ChildId='$childid'";
    $cnn->query($qry22);
    $cnn->query($qry2);
    header("location: socialWorker.php");
  }
  if(isset($_POST["btn1"])){
    $conDet = $_POST["con"];
    $qry4 = "update conferenceDetails set conNotes='$conDet',date='$dd',
    submit='no' where ChildId='$childid'";
    $cnn->query($qry4);
    header("location: socialWorker.php");
  }

}else{
  if(isset($_POST["btn"])){
    $conDet = $_POST["con"];
    $qry1 = "insert into conferenceDetails
    (ChildId,conNotes,date,submit) values ('$childid','$conDet','$dd','yes')";
    $qry23 = "update childconference set csid='2' where ChildId='$childid'";
    $cnn->query($qry23);
    $cnn->query($qry1);
    header("location: socialWorker.php");
  }
  if(isset($_POST["btn1"])){
    //echo 'aa';
    $conDet = $_POST["con"];
    $qry1 = "insert into conferenceDetails
    (ChildId,conNotes,date,submit) values ('$childid','$conDet','$dd','no')";
    $cnn->query($qry1);
    header("location: socialWorker.php");

  }
}
//$childid = $_REQUEST["Id"];

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
                            <h1>Enter Child's Conference Decision.
								</h1>
            </div><br><br>
<!-- /.page-header -->
						<form method="post">

    						<div class="widget-header">
                  <div class="well">
                  <h3>Enter Conference Decision:</h3><br>
                    <textarea name="con" rows="15" cols="110">
                      <?php echo $det; ?>
                    </textarea>
                    <?php echo $info3; ?>

<br><br>

                    <input class="btn btn-info" type="submit" name="btn" value="Submit">

                      <input id="bt" class="btn btn-info" type="submit"
                      name="btn1" value="Save and Exit" style="float:right;" onclick="func()">

                  </div>
                </div>



    						</div>
          </form>
                        </div>
											</div>



<?php
include_once("socialFooter.php");
?>

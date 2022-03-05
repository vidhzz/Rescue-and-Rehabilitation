
<?php

		session_start();

		if($_SESSION["logged_in"]==False){
		 header("location: ../loginUser.php");
		}
		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];
    $mpid=$_REQUEST["mpid"];

		$info="";
		$info1="";
    $ctsid1="";
    $str="";


 			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from movingplan where mpid='$mpid'";
			$result = $cnn->query($qry);


        $str = "<table id='simple-table' class='table  table-bordered table-hover'>";
        while ($row=$result->fetch_assoc()) {

              $str.="<tr><th>Starting Location</th><td class='center'>".$row["fromplace"]."</td></tr>
              <tr><th>Destination Location</th><td class='center'>".$row["toplace"]."</td></tr>
              <tr><th>Start date of journey</th><td class='center'>".$row["fromdate"]."</td></tr>
              <tr><th>Delivery date of journey</th><td class='center'>".$row["todate"]."</td></tr>
              <tr><th>Driver full name</th><td class='center'>".$row["driver"]."</td></tr>
              <tr><th>Notes</th><td class='center'>".$row["notes"]."</td></tr>";

           }

        $str.="</table>";


			if(isset($_POST["print"])){
				header("location: checkListOfKidsForMovingPlan.php?mpid=".$mpid);
			}

?>

<?php
include_once("socialHeader.php");
?>
<div class="main-content-inner">
  <script>
  function myFunction(){
    window.print();
  }
  </script>


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
							<h1 style="text-align: center;">
                Moving plan details
							</h1>
						</div><!-- /.page-header -->
            <small>  <button onclick="myFunction()"  style="float: right;">Print this page</button></small>
            <br><br>

              <?php echo "$str"; ?>
							<br>
							<form method="post">
								<div style="text-align: center;">
							<input type="submit" class="btn btn-info" name="print" value="Add Kids" >
						</div>
							</form>

								</div>
							</div>


<?php
include_once("socialFooter.php");
?>

<?php
	session_start();
	if($_SESSION["logged_in"]==False){
	 header("location: ../loginUser.php");
	}
	$pic = $_SESSION["pic"];
	$name = $_SESSION["name"];

	$info="";
$udid="";
	$cnn = mysqli_connect("localhost","root","","rar");
	$qry="select * from uploaddocs where status is NULL";
	$result = $cnn->query($qry);
	$c = mysqli_num_rows($result);

	$str = "<table id='simple-table' class='table  table-bordered table-hover'><tr><th>Document ID</th><th class='detail-col'>
	Document Type</th><th class='center'>View Document</th><th class='center'>Approved or Rejected</th></tr>";
	if($c > 0){

		while ($row=$result->fetch_assoc()) {
			$udid=$row["udid"];
			$str.="<tr><td>".$row["udid"]."</td><td class='center'>".$row["doctype"]."</td><td class='center'><a href='../socialWorker/doc/".$row["document"]."' target='_blank'>view</a></td>
			<td class='center'>
			<form method='post' action='redirectApprovedRej.php'>doc ID:
			<input type='text' value='".$udid."' name='udid'>
			<input type='radio' name='status' value='approved' onclick='myFunction1()'> Approved &emsp;&emsp;
			<input type='radio' name='status' value='rejected' onclick='myFunction()'> Rejected <br>
			<div id='hey' style='display:none'>

				<h4>Reason:
					<input type='text' name='reason'/>

				</h4>

			</div><br>
			<input type='submit' name='btn' value='submit'/>
			</form>

			 </td></tr>";

		}

		$str.="";

	}else{
		$info="<font color='red'>No documents to verify at the moment!</font>";
		$str="";
	}

	/*if(isset($_POST["btn"])){
		$choice=$_POST["status"];
		if($choice == "rejected"){
			$qry1="update uploaddocs set status='$choice',  ";
		}
	}*/


?>

<?php
include_once("SOheader.php");
?>

            <script>
                  function myFunction() {
                    var x = document.getElementById("hey");
                    if (x.style.display === "none") {
                      x.style.display = "block";
                    }
                  }

									function myFunction1() {
                    var x = document.getElementById("hey");
                    if (x.style.display === "block") {
                      x.style.display = "none";
                    }
                  }
           </script>

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
								Documents to Verify
							</h1>
						</div>


						<div><?php echo "$str"; ?></div>
						<h5><?php echo "$info";?></h5>


					</div>
				</div>

								<?php
								include_once("SOfooter.php");
								?>

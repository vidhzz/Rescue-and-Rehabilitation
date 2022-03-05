<?php
			session_start();
			if($_SESSION["logged_in"]==False){
			 header("location: ../loginUser.php");
			}
			$name = $_SESSION["name"];
			$pic = $_SESSION["pic"];

			$total= 0;
			$table= "";
			$info1 = "";
			$info2 = "";
			$info3 = "";
			$dd = DATE("Y-m-d");

			$benForm = "";
			$nxt = "";
			$back = "";



			$childid = $_SESSION["childid"];
			$cnn = mysqli_connect("localhost","root","","rar");
			$qryy1 = "select max(ChildCaseId) as ChildCaseId from childcase where childid='$childid'";
			$resultt = $cnn->query($qryy1);
			$roww = $resultt->fetch_assoc();
			$ccid = $roww["ChildCaseId"];




			$result6 = $cnn->query("select * from treatmentques");
			$totalRows1 = mysqli_num_rows($result6);
			$qry="select * from child where childid='$childid'";

			$result = $cnn->query($qry);
			$row = $result->fetch_assoc();
			$name1 = $row["FirstName"]." ".$row["LastName"];

			$patientName = "Patient Name: ".$name1;



			$qryy3 = "select * from treatmentans where ChildCaseId='$ccid'";
			$resultt5 = $cnn->query($qryy3);
			$cnt = mysqli_num_rows($resultt5);

			if($cnt==$totalRows1){

				$benForm = "<input type='submit' name='benForm' value='Next to Beneficiary Form' class='btn btn-xs btn-info'  style='margin-left: 800px;font-size: 15px;'>";
				$back = "<input type='submit' name='back' value='Back'
				  style='margin-right: 900px;font-size: 15px;color:white;background-color: orange;'>";
			}

			elseif($cnt==0){
			$nxt = "<input type='submit' name='next' value='Next'   style='margin-left: 970px;font-size: 15px;color:white;background-color: orange;'>
										<br><br><br>";
			$qryy4 = "select * from treatmentques where TqId='1'";
			$resultt6 = $cnn->query($qryy4);
			$roww6 = $resultt6->fetch_assoc();
			$tqid = $roww6["TqId"];


			$table4 = "<table id='simple-table' class='table  table-bordered table-hover' style='font-size: 15px;'>";
					//$count = $_SESSION["count"];
					$qry4 = "select * from treatmentques where TqId='$tqid'";
					$result4 = $cnn->query($qry4);
					$row4  = $result4->fetch_assoc();
					$table4.="<tr><td colspan='2'>".$row4["TqName"]."</td></tr><tr><td><input type='radio'name='ans'
					value='".$row4["v1"]."'>".$row4["v1"]."</td><td><input type='radio'name='ans' value='".$row4["v2"].
					"'>".$row4["v2"]."</td></tr><tr><td><input type='radio'name='ans' value='".$row4["v3"]."'>".$row4["v3"].
					"</td><td><input type='radio'name='ans' value='".$row4["v4"]."'>".$row4["v4"]."</td></tr>";

					$table4.="</table>";
			}
			else{
				$back = "<input type='submit' name='back' value='Back'
				  style='margin-right: 900px;font-size: 15px;color:white;background-color: orange;'>";
				$nxt = "<input type='submit' name='next' value='Next'   style='margin-left: 920px;font-size: 15px; color:white; background-color: orange;'>
										<br><br><br>";
				$qryy7 = "select * from treatmentques where TqId = (select min(TqId) from treatmentques where TqId not in (select TqId from treatmentans where ChildCaseId = '$ccid'))";

				$resultt7 = $cnn->query($qryy7);
				$roww7  = $resultt7->fetch_assoc();
				$tqid = $roww7["TqId"];

				$table4 = "<table id='simple-table' class='table  table-bordered table-hover' style='font-size: 15px;'>";

					$qry4 = "select * from treatmentques where TqId='$tqid'";
					$result4 = $cnn->query($qry4);
					$row4  = $result4->fetch_assoc();
					$table4.="<tr><td colspan='2'>".$row4["TqName"]."</td></tr><tr><td><input type='radio'name='ans' value='".$row4["v1"]."'>".$row4["v1"]."</td><td><input type='radio'name='ans' value='".$row4["v2"]."'>".$row4["v2"]."</td></tr><tr><td><input type='radio'name='ans' value='".$row4["v3"]."'>".$row4["v3"]."</td><td><input type='radio'name='ans' value='".$row4["v4"]."'>".$row4["v4"]."</td></tr>";

					$table4.="</table>";

			}


			if(isset($_POST["back"])){

				$qry880 = "delete from treatmentans where ChildCaseId=$ccid and
				TqId=(select max(TqId) from treatmentans where ChildCaseId=$ccid)";
				$cnn->query($qry880);
				header("location:redirect.php");

			}




			if(isset($_POST["next"])){




				$ans = $_POST["ans"];

				if(isset($_POST["ans"])){

					$qryy = "insert into treatmentans (ChildCaseId, TqId, Ans) values ('$ccid','$tqid','$ans')";
					$cnn->query($qryy);
			}




				header("location:redirect.php");
			}




		if(isset($_POST["benForm"])){

			if($_POST["DOT"]==""){
				$info1 = "<font style='color:red;margin-left:650px;'><small>please fill this field</small></font>";
			}
			else{

				$date = $_POST["DOT"];
				$query123 = "select max(statusId) as statusId from childcase where childId='$childid'";

				$resultt123 = $cnn->query($query123);
				$roww123 = $resultt123->fetch_assoc();
				$sid = $roww123["statusId"];

				$query321 = "update childcase set DOSess='$date' where childid='$childid' and statusId='$sid'";

				$cnn->query($query321);
				header("location:beneficiaryForm.php?ccid=$ccid");
			}

		}

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
								The Patient health Questionnaire(PHQ-9)

							</h1>
						</div><!-- /.page-header -->

							<form method="post">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div style="font-size: 20px;">
									<br>
								<?php
									echo $patientName;
								?>

								&emsp;&emsp;&emsp;&emsp;&emsp;
								&emsp;&emsp;&emsp;&emsp;&emsp;
								&emsp;&emsp;&emsp;&emsp;&emsp;


								Date of visit <small>(yyyy-mm-dd)</small>:
								<input type="text" name="DOT" value="<?php echo $dd; ?>">
								</div>
								<?php echo $info1 ?>
								<br><br>

							<h2><b>Note:</b></h2><h3>A depression diagnosis that warrants treatment or a treatment change, needs at least one of the first two questions endorsed as positive("more than half the days" or "nearly every day") in the past two weeks. In addition, the tenth question, about difficulty at work or home or getting along with others should be answered at least "somewhat difficult".</h3>

							<br><br>
							<br>


							<?php //echo $info3; ?>							<hr style="border: 1px solid black;"><br>
							<div class="center">
								<?php

									if($cnt<10){

										echo $table4;

										echo $nxt;


									}echo $back;


											echo $benForm;






								?>
							</div>
						<!--	 -->

							</div><!-- /.col -->
						<!-- /.row -->
						</form>
					</div>



<?php
	include_once("psyOfficerFooter.php");
?>

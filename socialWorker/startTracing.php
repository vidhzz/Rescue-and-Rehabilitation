<?php
	session_start();
	if($_SESSION["logged_in"]==False){
	 header("location: ../loginUser.php");
	}

	$name = $_SESSION["name"];
	$pic = $_SESSION["pic"];
	$userid = $_SESSION["uid"];
	$cnn = mysqli_connect("localhost","root","","rar");
	$rd = "";
	$fat = "";
	$mot = "";
	$relName = "";
	$rel = "";
	$alert = "";
	$count1 = 0;
	$alert1 = "";
	$alert2 = "";
	$childid=$_REQUEST["ID"];
	$dd = date("Y-m-d");
	$flag = 0;

	$str="

	Father's Contact Number:   <input type='number' name='fat'><br><br>
	Mother's Contact Number:   <input type='number' name='mot'><br><br>
	Relative's Name:           <input type='text' name='relName'><br><br>
	Relative's Contact Number: <input type='number' name='rel'><br><br>


	";
	$qry1 = "select foundContact from callparent where ChildId=$childid and cpid=(select max(cpid) from
	callparent where ChildId=$childid)";
	//echo $qry1;
	$result = $cnn->query($qry1);
	$count = mysqli_num_rows($result);
	$ans = $result->fetch_assoc();
	if($count==1){
		$a = $ans["foundContact"];
		if($a=='yes'){
			header("location:startTracing1.php?id=$childid");
		}
	}




			if(isset($_POST["rd"])){


			//echo "aa";
					$rd = $_POST["rd"];

					if(isset($_POST["btn"])){

						$fat = $_POST["fat"];
						$mot = $_POST["mot"];
						$relName = $_POST["relName"];
						$rel = $_POST["rel"];
						if(!empty($fat) or !empty($mot) or !empty($relName) or !empty($rel)){

							if(!empty($fat)){
								if(strlen($fat)!=9){
								//	echo "1";
										$flag = $flag + 1;
										$count1 = $count1 + 1;
								}
						}
						if(!empty($mot)){
							if(strlen($mot)!=9){
							//	echo "2";
									$flag = $flag + 1;
									$count1 = $count1 + 1;
							}
						}
						if(!empty($rel)){
							if(strlen($rel)!=9){
							//	echo "3";
									$flag = $flag + 1;
									$count1 = $count1 + 1;
							}
						}
								if(is_numeric($relName)){
								//	echo "4";
									$alert1 = "<script>alert('invalid relative name');</script>";
									$count1 = $count1 + 1;
								}
					}
					else{
						$alert = "<script>alert('please fill the mentioned entries');</script>";
						$count1 = $count1 + 1;
					}
						$qry = "insert into callparent (ChildId,foundContact,date,fatherContact,
						motherContact,relativeName,relativeContact) values ('$childid','yes','$dd','$fat','$mot','$relName','$rel')";
						//echo $qry;
						if($flag==0){
						//	echo $count1;
							if($count1==0){
								$cnn->query($qry);
								header("location: startTracing1.php?id=$childid");
						}
				}
					else{
							$alert2 = "<script>alert('invalid contact number');</script>";
					}
				}



					if(isset($_POST["exit"])){

					$qry="insert into callparent (ChildId,foundContact,date) values ('$childid','no','$dd')";
					//echo $qry;

					$cnn->query($qry);
					header("location: socialWorker.php");
					}

					if(isset($_POST["exit1"])){
						$qry1 = "update childcase set ctsId='4' where ChildId=$childid and statusId='12'";
						$qry2 = "insert into childconference (ChildId,csid) values ('$childid','1')";
						$qry3 = "insert into childtransportcase (ChildId,UserId,ctsId,Dosc) values
						('$childid','$userid','4','$dd')";
					//	echo $qry3;
						$cnn->query($qry1);
						$cnn->query($qry2);
						$cnn->query($qry3);
						header("location: socialWorker.php");
					}


			}




?>

<?php
include_once("socialHeader.php");
?>
<script>
	function showPara(){
		var chkYes = document.getElementById("rad");
		var chkno = document.getElementById("rad1");
		chkno.style.display = "None";
		chkYes.style.display = "block";
	}
	function showParaNo(){
		var chkYes = document.getElementById("rad");

		var chkno = document.getElementById("rad1");
		chkno.style.display = "block";
		chkYes.style.display = "None";

	}
	function func(){
		if(document.getElementById("chk1").checked){
		var cc = document.getElementById("aa");
		var cd = document.getElementById("ab");
		cc.style.display = "block";
		cd.style.display = "none";
		}
		else{
		var cc = document.getElementById("aa");
		var cd = document.getElementById("ab");
		cc.style.display = "none";
		cd.style.display = "block";
		}
	}
</script>
<div class="main-content">
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
                            <h1>Parent Tracing
								</h1>
                        </div>
                        <!-- /.page-header -->

						<div class="row">
                            <div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<!--	<div class="hr dotted"> -->


							<form method="post" >
								<div class="widget-box" style="width:500px; margin:auto;">
											<div class="widget-header">
												<h4 class="smaller">
													Contact Details

												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
												<div class="well">
												<h4 class="green smaller lighter"><font color="#132BAE">Contact found?</font></h4>
													<input type="radio" value="yes" name="rd" onclick="showPara();">&nbsp;yes &nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" value="no" name="rd" onclick="showParaNo();">&nbsp;no
												</div>
													<hr>


													<div id="rad" style="display:none;">


														<div class="well">

															<?php

																echo $str;
																echo $alert;
																echo $alert1;
																echo $alert2;

															?>

															&emsp;&emsp;&emsp;&emsp;
															&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
															<input class="btn btn-info" type="submit" id="submit" name="btn" value="Submit" class="center">
														</div>
															&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
															&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
															&emsp;&emsp;&emsp;&emsp;&emsp;
														<!--	<a href="startTracing1.php?id=<?php echo $childid ?>"><i style="font-size:15px">Next&rarr;</i></a>
														-->


													</div>



													<div id="rad1" style="display:none;">

															&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
															<input id="ab" class="btn btn-info" type="submit" value="save and exit" name="exit">
															<br><br><br>
															<input id="chk1" type="checkbox" name="conference" onclick="func()">
															<font color="red">Even after many attempts if family contact is not found.</font>



													</div>
													<div id="aa" style="display:none;text-align:center;">
													<br><br>
													<input class="btn btn-info" type="submit" value="next" name="exit1">
													</div>

									</form>

												</div>
											</div>
										</div>



                            </div>
                        </div>
											</div>
										</div>
									</div>




<?php
include_once("socialFooter.php");
?>

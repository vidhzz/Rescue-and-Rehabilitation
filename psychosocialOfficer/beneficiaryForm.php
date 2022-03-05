<?php
	session_start();
	if($_SESSION["logged_in"]==False){
	 header("location: ../loginUser.php");
	}
	$name = $_SESSION["name"];
	$pic = $_SESSION["pic"];
	$childid = $_SESSION["childid"];
	$uid = $_SESSION["uid"];
	$checked = "";
	$info = "";
	$info33 = "";
//	$count = 0;
	$dd = DATE("Y-m-d");
	$cc = [];
	$count = 0;
	$cnn = mysqli_connect("localhost","root","","rar");
	$ccid = $_REQUEST["ccid"];
	$qry="select * from child where ChildId='$childid'";
	$result = $cnn->query($qry);
	$row = $result->fetch_assoc();
	$rdate = $row["DoSupervisor"];
	$name1 = $row["FirstName"]." ".$row["LastName"];
	$fatname = $row["FatherName"];
	$edu = $row["Education"];
	$qua = $row["Qualification"];


	$qry456 = "select * from treatmentans where ChildCaseId='$ccid' and Tqid!='10'";
	$result456 = $cnn->query($qry456);
	while($row456 = $result456->fetch_assoc()){
		$ans = $row456["Ans"];
		if($ans == "Not At All"){
			array_push($cc,0);
		}
		elseif($ans == "Several Days"){
			array_push($cc,1);
		}
		elseif($ans == "More Than Half the Days"){
			array_push($cc,2);
		}
		else{
			array_push($cc,3);
		}
	}
	foreach($cc as $v){
		$count = $count + $v;
	}

	if($count>4&&$count<10){
		$strTable = "<table id='simple-table' class='table  table-bordered table-hover'>
		<tr> <th class='detail-col' colspan='3'> PHQ-9= ".$count."</th> </tr>
		<tr>
			<th class='detail-col'> PHQ-9 Score</th>
			<th class='detail-col'> Provisional Diagnosis</th>
			<th class='detail-col'> Treatment Recommendation<br><small>Patient Preferences Should be considered</small></th>
		</tr>
		<tr style='background-color:yellow;'>
			<td> 5-9 </td>
			<td> Minimal Symptoms* </td>
			<td> Support, educate to call if worse, return in one month </td>
		</tr>
		<tr>
			<td> 10-14 </td>
			<td> Minor depression++<br>Dysthymia*<br>Major Depression, mild </td>
			<td> Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> 15-19 </td>
			<td> Minor depression, moderately severe </td>
			<td> Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> >20 </td>
			<td> Minor depression, severe </td>
			<td> Antidepressant or psychotherapy<br>(especially if not improved on monotherapy) </td>

		</tr>

		</table><br><a href='phqAns.php?ccid=".$ccid."' target='_blank'><h4><b><i>click here to see all PHQ-9 answers</i></b></h4></a>";
	}
	elseif ($count>9&&$count<15) {
		$strTable = "<table id='simple-table' class='table  table-bordered table-hover'>
		<tr> <th class='detail-col' colspan='3'> PHQ-9= ".$count."</th> </tr>
		<tr>
			<th class='detail-col'> PHQ-9 Score</th>
			<th class='detail-col'> Provisional Diagnosis</th>
			<th class='detail-col'> Treatment Recommendation<br><small>Patient Preferences Should be considered</small></th>
		</tr>
		<tr >
			<td> 5-9 </td>
			<td> Minimal Symptoms* </td>
			<td> Support, educate to call if worse, return in one month </td>
		</tr>
		<tr style='background-color:yellow;'>
			<td> 10-14 </td>
			<td> Minor depression++<br>Dysthymia*<br>Major Depression, mild </td>
			<td> Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> 15-19 </td>
			<td> Minor depression, moderately severe </td>
			<td> Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> >20 </td>
			<td> Minor depression, severe </td>
			<td> Antidepressant or psychotherapy<br>(especially if not improved on monotherapy) </td>

		</tr>

		</table><br><a href='phqAns.php?ccid=".$ccid."' target='_blank'><h4><b><i>click here to see all PHQ-9 answers</i></b></h4></a>";

	}
	elseif ($count>14&&$count<20) {
		$strTable = "<table id='simple-table' class='table  table-bordered table-hover'>
		<tr> <th class='detail-col' colspan='3'> PHQ-9= ".$count."</th> </tr>
		<tr>
			<th class='detail-col'> PHQ-9 Score</th>
			<th class='detail-col'> Provisional Diagnosis</th>
			<th class='detail-col'> Treatment Recommendation<br><small>Patient Preferences Should be considered</small></th>
		</tr>
		<tr>
			<td> 5-9 </td>
			<td> Minimal Symptoms* </td>
			<td> Support, educate to call if worse, return in one month </td>
		</tr>
		<tr>
			<td> 10-14 </td>
			<td> Minor depression++<br>Dysthymia*<br>Major Depression, mild </td>
			<td> Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy </td>
		</tr>
		<tr style='background-color:yellow;'>
			<td> 15-19 </td>
			<td> Minor depression, moderately severe </td>
			<td> Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> >20 </td>
			<td> Minor depression, severe </td>
			<td> Antidepressant or psychotherapy<br>(especially if not improved on monotherapy) </td>

		</tr>

		</table><br><a href='phqAns.php?ccid=".$ccid."' target='_blank'><h4><b><i>click here to see all PHQ-9 answers</i></b></h4></a>";

	}
	elseif ($count<=5) {
		$strTable = "<table id='simple-table' class='table  table-bordered table-hover'>
		<tr> <th class='detail-col' colspan='3'> PHQ-9= ".$count."  <font color='red'> There is no provisional diagnosis
		and treatment for this child</font></th> </tr>
		<tr>
			<th class='detail-col'> PHQ-9 Score</th>
			<th class='detail-col'> Provisional Diagnosis</th>
			<th class='detail-col'> Treatment Recommendation<br><small>Patient Preferences Should be considered</small></th>
		</tr>
		<tr>
			<td> 5-9 </td>
			<td> Minimal Symptoms* </td>
			<td> Support, educate to call if worse, return in one month </td>
		</tr>
		<tr>
			<td> 10-14 </td>
			<td> Minor depression++<br>Dysthymia*<br>Major Depression, mild </td>
			<td> Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy </td>
		</tr>
		<tr style='background-color:yellow;'>
			<td> 15-19 </td>
			<td> Minor depression, moderately severe </td>
			<td> Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> >20 </td>
			<td> Minor depression, severe </td>
			<td> Antidepressant or psychotherapy<br>(especially if not improved on monotherapy) </td>

		</tr>

		</table><br><a href='phqAns.php?ccid=".$ccid."' target='_blank'><h4><b><i>click here to see all PHQ-9 answers</i></b></h4></a>";
	}
	else{
		$strTable = "<table id='simple-table' class='table  table-bordered table-hover'>
		<tr> <th class='detail-col' colspan='3'> PHQ-9= ".$count."</th> </tr>
		<tr>
			<th class='detail-col'> PHQ-9 Score</th>
			<th class='detail-col'> Provisional Diagnosis</th>
			<th class='detail-col'> Treatment Recommendation<br><small>Patient Preferences Should be considered</small></th>
		</tr>
		<tr>
			<td> 5-9 </td>
			<td> Minimal Symptoms* </td>
			<td> Support, educate to call if worse, return in one month </td>
		</tr>
		<tr>
			<td> 10-14 </td>
			<td> Minor depression++<br>Dysthymia*<br>Major Depression, mild </td>
			<td> Support, watchful waiting<br>Antidepressant or psychotherapy<br>Antidepressant or psychotherapy </td>
		</tr>
		<tr>
			<td> 15-19 </td>
			<td> Minor depression, moderately severe </td>
			<td> Antidepressant or psychotherapy </td>
		</tr>
		<tr style='background-color:yellow;'>
			<td> >20 </td>
			<td> Minor depression, severe </td>
			<td> Antidepressant or psychotherapy<br>(especially if not improved on monotherapy) </td>

		</tr>

		</table><br><a href='phqAns.php?ccid=".$ccid."' target='_blank'><h4><b><i>click here to see all PHQ-9 answers</i></b></h4></a>";

	}



	$qry2="select * from user where UserId='$uid'";
	$result2 = $cnn->query($qry2);
	$row2 = $result2->fetch_assoc();
	$counselor = $row2["FirstName"]." ".$row2["LastName"];


	$qrry4 = "select max(statusId) as statusId from childcase where ChildId='$childid'";
	$resuult4 = $cnn->query($qrry4);
	$roow4 = $resuult4->fetch_assoc();
	$stid = $roow4["statusId"];
	$qry55 = "select * from childstatus where statusId='$stid'";
	//echo $qry55;
	$result55 = $cnn->query($qry55);
	$row55 = $result55->fetch_assoc();
	$sessNum = $row55["statusName"];


	if(isset($_POST["Submit"])){
		$choosed = $_POST["phyprob"];
		$txtarea = $_POST["description"];
		$qry3="select PhyId from PhyProblems where PhyProbTitle='$choosed'";
		$result3 = $cnn->query($qry3);
		$row3 = $result3->fetch_assoc();
		$phyid=$row3["PhyId"];


		$qry4 = "insert into treatmentProblem (PhyId, Description, ChildCaseId) values ('$phyid', '$txtarea', '$ccid')";
		$cnn->query($qry4);

		$info = "<span id='bb' style='color:#32CD32;'><font >Submitted!, Select other problem if any with its details.</font> <button type='button' onclick='bb()'><i class='fa fa-close' style='font-size:15px'></i></button><span>";

	//	header("location:beneficiaryForm.php");

	}

	if(isset($_POST["Submit1"])){


		$des1 = $_POST["description1"];


		if(isset($_POST["nextSess"])){


			if($_POST["nextSess"]=="yes"){

				$qry0 = "insert into treatmentdetails (ChildCaseId, PHQ9, Notes, Dons, IsNextSessReq) values ('$ccid','$count','$des1','$dd','yes')";
				$cnn->query($qry0);

				$result111 = $cnn->query("select max(statusId) as statusId from childcase where ChildId='$childid'");
				$row111 = $result111->fetch_assoc();
				$statusId = $row111["statusId"];


				if($statusId<12)
				{
					$statusId++;
					$qry01 = "insert into childcase (ChildId,statusId,DOSess) values ('$childid','$statusId','$dd')";
					$cnn->query($qry01);
				}

					header("location:psychosocialOfficer.php");

			}

			else{

				$result111 = $cnn->query("select max(statusId) as statusId from childcase where ChildId='$childid'");
				$row111 = $result111->fetch_assoc();
				$statusId = $row111["statusId"];

				$qry0 = "insert into treatmentdetails (ChildCaseId, PHQ9, Notes, Dons, IsNextSessReq) values ('$ccid','$count','$des1','$dd','no')";
				$cnn->query($qry0);
				$statusId++;
				$qry333 = "insert into childcase (ChildId,statusId,DOSess) values ('$childid','$statusId','$dd')";
				$cnn->query($qry333);
			//	echo $qry0;
				$qry010 = "insert into childcase (ChildId,statusId,DOSess,ctsId) values ('$childid','12','$dd','1')";
				$cnn->query($qry010);


			//	echo $qry010;
				header("location:psychosocialOfficer.php");

			}
		}
		else{
			$info33 = "<font style='color:red;margin-left:650px;'><small>please fill this field</small></font>";
		}



	}



?>
<?php
include_once("psyOfficerHeader.php");
?>
<script type="text/javascript">

	function func(){
		alert("This problem has been submitted. Select other problem and write its details if any.");
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




						<form method="post">

						<div class="page-header">
							<h1 class="center">
								<b>PHQ-9 Score</b>
							</h1>
						</div>
						<div>
							<?php

								echo $strTable;

							?>
						</div>
						<br><br><br>
						<div class="page-header">
							<h1 class="center">
								<b>PSYCHOSOCIAL BENEFICIARY FORM</b>
							</h1>
						</div><!-- /.page-header -->

            <div align="right">

                 <b>Session Number:</b> <input type="text" name="sessNum" value="<?php echo $sessNum; ?>">

            </div>
            <div class="hr  hr-bold hr18"></div>

            <div class="center">
              <h4><i>Individual Forms</i></h4>
            </div>

            <font size="3">
                <table border="2" width="90%" height="150" align="center" >

                  <tr>
                    <th colspan="4" style="text-align:center"><mark style="background-color:pink;">Child Specification</mark></th>
                  </tr>

                  <tr>

                    <th style="text-align:center">Counselor</th>
                    <th style="text-align:center">Registration</th>
                    <th style="text-align:center">Name</th>
                    <th style="text-align:center">Father Name</th>

                  </tr>

                  <tr>
                    <td style="text-align:center"><?php echo "$counselor";?></td>
                    <td style="text-align:center"><?php echo "$rdate";?></td>
                    <td style="text-align:center"><?php echo "$name1";?></td>
                    <td style="text-align:center"><?php echo "$fatname";?></td>
                  </tr>

                  </table>
                  </font>

                  <br><br>

                  <font size="3">
                      <table border="2" width="90%" height="150" align="center">

                      <tr>
                        <td>
                          &nbsp;
                          <mark style="background-color:pink;"> Education:</mark>
                          &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                        <input type="checkbox" name="lit" value="lit" <?php if($edu == 'Literate') echo 'checked="checked"'; ?>>Literate
                        &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                          <input type="checkbox" name="ill" value="ill" <?php if($edu == 'Illiterate') echo 'checked="checked"'; ?>>Illiterate
                        </td>
                      </tr>


                    <tr>
                      <td>
                        &nbsp;
                        <mark style="background-color:pink;">Qualification:</mark>
                        &emsp; &emsp; &emsp; &emsp; &emsp;
                        <input type="checkbox" name="ps" value="ss" <?php if($qua == 'Primary') echo 'checked="checked"'; ?>>Primary
                      &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                        <input type="checkbox" name="ss" value="ss" <?php if($qua == 'Secondary') echo 'checked="checked"'; ?>>Secondary
                        &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                          <input type="checkbox" name="hs" value="hs" <?php if($qua == 'High School') echo 'checked="checked"'; ?>>High School
                      </td>
                    </tr>


                      </table>
                  </font>

                  <br><br>


						<!--	<form method="post">-->
                  <font size="3">
                      <table border="2" width="90%" height="180" align="center">
                        <tr>
                        <th style="text-align:center">
                            <mark style="background-color:pink;">Psychological and physical problems</mark>
                        </th>
                      </tr>

                    <tr>
                      <td>
                      	<br>
														<div align="center">
		                        <select name="phyprob">
															<option value="family problem">Family problem</option>
															<option value="ethical or moral problem">Ethical or Moral problem</option>
															<option value="behaviour problem">Behaviour problem</option>
															<option value="addiction">Addiction</option>
															<option value="sleep problem">Sleep problem</option>
															<option value="disability">Disability</option>
															<option value="sickness">Sickness</option>
															<option value="conflict with law">Conflict with law</option>
															<option value="other problem">Other problem</option>

														</select>
														<br><br>

														<h3><b>Enter Problem details:<br></h3>
														<textarea rows="5" cols="50" name="description">  </textarea>
														<br><br>

														&emsp;&emsp;

														<input type="submit" name="Submit" class="btn btn-xs btn-danger" value="Submit"
														style="font-size: 15px;" onclick="func()">


														<br><br>
													<!--	<?php //	echo $info ?>-->
														<br><br>
														<h3><b>Enter child situation and details for this session:</b></h3>

														<textarea rows="5" cols="50" name="description1">  </textarea>

														<br><br>
														<br><br>
														<h3><b>Does this child needs next treatment session:</b></h3>
														<div>
															<?php
																echo $info33;
															?>
														</div>
														&emsp;
														<input type="radio" name="nextSess" value="yes">yes
														&emsp;&emsp;
														<input type="radio" name="nextSess" value="no">No
														<br><br>




													</div>

                      </td>
                    </tr>


                      </table>
                  </font>
<br><br>

                  <div>
									<input type="submit" name="Submit1" class="btn btn-xs btn-danger" value="Submit"
									style="font-size: 15px;margin-left:540px;">
                  </div>



          </form>







									<div class="vspace-6-sm"></div>
									<div class="hr hr-double hr-dotted hr18"></div>
								</div>







<?php
include_once("psyOfficerFooter.php");
?>

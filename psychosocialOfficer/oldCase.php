<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
			$cnn = mysqli_connect("localhost","root","","rar");
			$arr12 = [];
			$arr13 = [];
			$arr14 = [];
			$arr15 = [];
			$noCase = "";
			$str = "";
			$flag = 0;
			$qr = "select ChildId from childcase where statusId='1'";
			$result99 = $cnn->query($qr);
			while($row99 = $result99->fetch_assoc()){

					$chiid = $row99["ChildId"];
					$qqry9 = "select max(statusId) as statusId from childcase where ChildId='$chiid'";
					$result090 = $cnn->query($qqry9);
					$row090 = $result090->fetch_assoc();
					if($row090["statusId"]!=12&&$row090["statusId"]!=1)
					{

						$flag=1;
						break;

					}

			}

			if($flag==0){

				$noCase = "<font color='blue'><h2>There are no old cases.</h2></font>";

			}
			else{
					$qryy1 = "select ChildId from childcase where statusId='12'";
					$resultt1 = $cnn->query($qryy1);
					while($roww1 = $resultt1->fetch_assoc()){
						array_push($arr12,$roww1["ChildId"]);
					}



					$qryy2 = "select ChildId from childcase where statusId='1'";
					$resultt2 = $cnn->query($qryy2);
					while($roww2 = $resultt2->fetch_assoc()){
						$cid = $roww2["ChildId"];

						$qr = "select * from childcase where ChildId='$cid'";
						$res = $cnn->query($qr);
						$ro = mysqli_num_rows($res);
						//echo "cid=$cid, ro=$ro.... ";

						if($ro==1){
							array_push($arr13,$cid);

						}
						else{
							//echo $cid;

							$qrr = "select max(statusId) as statusId from childcase where ChildId='$cid'";
							$re = $cnn->query($qrr);
							$rws = $re->fetch_assoc();
							if($rws["statusId"]!=12){
							array_push($arr15,$cid);
							array_push($arr14,$rws["statusId"]);
							}
						}
					}
				//print_r($arr14);


					$qry="select *,childcase.ChildId from child inner join childcase on child.ChildId=childcase.ChildId where (";

					foreach($arr12 as $v1){

						$qry.="childcase.ChildId!='".$v1."' or ";

					}

					foreach($arr13 as $v2){

						$qry.="childcase.ChildId!='".$v2."' or ";

					}
					$qry = rtrim($qry,' or');

					$qry.=") and (";

					$count = count($arr14);


					for($i=0;$i<$count;$i++){

						$qry.="(childcase.statusId='".$arr14[$i]."' and childcase.ChildId='".$arr15[$i]."') or ";

					}
					$qry = rtrim($qry,' or');
					$qry.=")";





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
								Old Case

							</h1>
						</div><!-- /.page-header -->


							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php

									echo $noCase;
									echo $str;

								?>


							</div><!-- /.col -->
						<!-- /.row -->
					</div>


<?php
	include_once("psyOfficerFooter.php");
?>


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
    	$infooo="<h4><font color='green' style='align: center'>Details of previous page has been inserted!</font></h4>";


 			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from childtransportcase ctc inner join childaddress ca on ctc.ChildId=ca.ChildId where ctsId='3'";
			$result = $cnn->query($qry);
      $c = mysqli_num_rows($result);


      if($c >= 1){

        $str = "<table id='simple-table' class='table  table-bordered table-hover'><tr><th>Add kid</th><th class='detail-col'>Photo</th><th>Full Name</th><th>Area</th><th>City</th></tr>";
        while ($row=$result->fetch_assoc()) {
              $cnn = mysqli_connect("localhost","root","","rar");
              $childid = $row["ChildId"];
              $qryy="select * from child where ChildId='$childid'";
              $resultt=$cnn->query($qryy);
              $roww=$resultt->fetch_assoc();
              //echo $mpid;
              	$q="select max(ctsId) as ctsId from childtransportcase where ChildId='$childid'";

              	$r = $cnn->query($q);
                $ro = $r->fetch_assoc();

              $ctsid1=$ro["ctsId"];


              if($ctsid1 == 3){
              $str.="<tr><td><a href='addChildLink.php?Id=".$childid."&mpid=".$mpid."'>ADD</a></td><td class='center'>
							<img src='../pics/".$roww["Photo"]."' height='140' width='180'></td><td class='center'>".$roww["FirstName"]."
							".$roww["LastName"]."</td><td class='center'>".$row["area"]."</td><td class='center'>".$row["city"]."</td></tr>";
           }else{
              $str.="";
            }

        }

        $str.="</table>";
      }else{

        $info="<font color='red'>No Kid at recent found for moving plan!</font>";

      }

			if(isset($_POST["print"])){
				header("location: printPageMovingPlan.php");
			}

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
							<h1>
                Add kids for the moving plan
							</h1>
						</div><!-- /.page-header -->
              <div><?php echo "$infooo"; ?></div>

              <?php echo "$str"; ?>
							<br>
							<form method="post">
								<div style="text-align: center;">
							<input type="submit" class="btn btn-info" name="print" value="Go to printing page of added kids" >
						</div>
							</form>
									<div class="hr hr-24"></div>
								</div>
							</div>


<?php
include_once("socialFooter.php");
?>

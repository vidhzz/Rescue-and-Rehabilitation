<?php

session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
    $cnn = mysqli_connect("localhost","root","","rar");
    $ccid = $_REQUEST["ccid"];
    $qry = "select *,treatmentques.TqName from treatmentans inner join treatmentques
    on treatmentques.TqId=treatmentans.Tqid where ChildCaseId='$ccid' and treatmentques.TqId!='10'";
    $result = $cnn->query($qry);
    $str = "<table id='simple-table' class='table  table-bordered table-hover'>
    <tr> <th class='detail-col'> Sr. No. </th><th class='detail-col'>
     Questions </th><th class='detail-col'> Answers </th></tr>";
    while($row=$result->fetch_assoc()){
        $str.="<tr><td> ".$row["TqId"]." </td><td> ".$row["TqName"]." </td><td> ".$row["Ans"]." </td></tr>";
    }
    $str.="</table>";

    $qry1 = "select *,treatmentques.TqName from treatmentans inner join treatmentques
    on treatmentques.TqId=treatmentans.Tqid where ChildCaseId='$ccid' and treatmentques.TqId='10'";
    $result1 = $cnn->query($qry1);
    $row1 = $result1->fetch_assoc();
    $str1 = "<table id='simple-table' class='table  table-bordered table-hover' >
    <tr><td><font color='red'>".$row1["TqName"]."</font></td><td><font color='red'>".$row1["Ans"]."</font></td></tr></table>";



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


						<form method="post">

                        <div class="page-header">
							<h1 class="center">
								<b>PHQ-9 Answers</b>
							</h1>
						</div>

                            <div>
                                <?php

                                    echo "$str\n \n\n$str1";

                                ?>

                            </div>


                        </form>



                        <div class="vspace-6-sm"></div>



										</div>








<?php
include_once("psyOfficerFooter.php");
?>

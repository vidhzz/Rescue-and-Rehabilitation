<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$childid = $_REQUEST["Id"];

$cnn = mysqli_connect("localhost","root","","rar");
$qry="select * from child where ChildId='$childid'";
$result=$cnn->query($qry);

    $str="<table id='simple-table' class='table  table-bordered table-hover'>";
      while($row=$result->fetch_assoc()){
        $str.="<tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Student Details</mark></th></tr>
          <tr>
            <td><img src=pics/".$row["Photo"]." height='120' width='110'/></td>
            <td>".$row["FirstName"]." ".$row["LastName"]."</td>
          </tr>

          <tr>
            <td>IOM</td>
            <td>".$row["IOM"]."</td>

          </tr>

          <tr>
            <td>UAM</td>
            <td>".$row["UAM"]."</td>

          </tr>

          <tr>
            <td>Father name</td>
            <td>".$row["FatherName"]."</td>

          </tr>

          <tr>
            <td>Mother Name</td>
            <td>".$row["MotherName"]."</td>

          </tr>

          <tr>
            <td>Date of Birth</td>
            <td>".$row["DOB"]."</td>

          </tr>

          <tr>
            <td>Age</td>
            <td>".$row["Age"]."</td>
          </tr>

          <tr>
            <td>Gender</td>
            <td>".$row["Gender"]."</td>
          </tr>

          <tr>
            <td>Locality</td>
            <td>".$row["Locality"]."</td>
          </tr>

          <tr>
            <td>Pickup date</td>
            <td>".$row["DoScreener"]."</td>
          </tr>

          <tr>
            <td>Rehab center entry date </td>
            <td>".$row["DoSupervisor"]."</td>
          </tr>

          <tr>
            <td>Education</td>
            <td>".$row["Education"]."</td>
          </tr>

          <tr>
            <td>Qualification</td>
            <td>".$row["Qualification"]."</td>
          </tr>

        ";
      }
    $str.="</table>";


    $qry1="select * from childcase where ChildId='$childid' and statusId='2'";

    $result1=$cnn->query($qry1);
    $c1 = mysqli_num_rows($result1);

    $str1="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 1 Details</mark></th></tr>
    <tr>
      <th>Questions</td>
      <th>Answers</td>
    </tr>";
    if($c1 == 0){$str1="";}
    while($row1=$result1->fetch_assoc()){

      $caseid = $row1["ChildCaseId"];
        $qry11="select Ans, TqName from treatmentans inner join treatmentques on treatmentans.TqId=treatmentques.TqId where ChildCaseId='$caseid'";
      $result11=$cnn->query($qry11);

      while($row11=$result11->fetch_assoc()){

        $str1.="

          <tr>
            <td>".$row11["TqName"]."</td>
            <td>".$row11["Ans"]."</td>
          </tr>


        ";


      }



    }
    $str1.="</table>";

    #session 1 problem Details
    $qry1p="select * from childcase where ChildId='$childid' and statusId='2'";

    $result1p=$cnn->query($qry1p);
    $c1p = mysqli_num_rows($result1p);

    $str1p="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'>
    <mark style='background-color:pink;'>Psychological and Physical Problems in Session 1</mark></th></tr>
    <tr>
      <th>Problems</td>
      <th>Problem Details</td>
    </tr>";
    if($c1p == 0){$str1p="";}
    while($row1p=$result1p->fetch_assoc()){

      $caseid = $row1p["ChildCaseId"];
        $qry11p="select PhyProbTitle, Description from treatmentproblem
        inner join phyproblems on treatmentproblem.PhyId=phyproblems.PhyId where ChildCaseId='$caseid'";
      $result11p=$cnn->query($qry11p);
      $c1p = mysqli_num_rows($result11p);
      if($c1p == 0){$str1p="";}

      while($row11p=$result11p->fetch_assoc()){

        $str1p.="

          <tr>
            <td>".$row11p["PhyProbTitle"]."</td>
            <td>".$row11p["Description"]."</td>
          </tr>


        ";


      }



    }
    $str1p.="</table>";


    #session 1 session comments
    $qry1s="select * from childcase where ChildId='$childid' and statusId='2'";

    $result1s=$cnn->query($qry1s);
    $c1s = mysqli_num_rows($result1s);

    $str1s="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2'
    style='text-align:center'><mark style='background-color:pink;'>Session 1 Notes and Comments</mark></th></tr>
    <tr>
      <th>Details and Comments</td>
      <th>Date</td>
    </tr>";
    if($c1s == 0){$str1s="";}
    while($row1s=$result1s->fetch_assoc()){

      $caseid = $row1s["ChildCaseId"];
        $qry11s="select * from treatmentdetails where ChildCaseId='$caseid'";
      $result11s=$cnn->query($qry11s);
      $c1s = mysqli_num_rows($result11s);
      if($c1s == 0){$str1s="";}

      while($row11s=$result11s->fetch_assoc()){

        $str1s.="

          <tr>
            <td>".$row11s["Notes"]."</td>
            <td>".$row11s["Dons"]."</td>
          </tr>


        ";


      }



    }
    $str1s.="</table>";




    /*$qry1="select * from childcase inner join treatmentans on childcase.ChildCaseId=treatmentans.ChildCaseId ";
    $result1=$cnn->query($qry1);
    $count = mysqli_num_rows($result1);
    echo $count;
    while($row1=$result1->fetch_assoc()){

    }*/

    #session 2
    $qry2="select * from childcase where ChildId='$childid' and statusId='4'";

    $result2=$cnn->query($qry2);
    $c2 = mysqli_num_rows($result2);

    $str2="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2'
     style='text-align:center'><mark style='background-color:pink;'>Session 2 Details</mark></th></tr>
    <tr>
      <th>Questions</td>
      <th>Answers</td>
    </tr>";
    if($c2 == 0){$str2="";}
    while($row2=$result2->fetch_assoc()){

      $caseid = $row2["ChildCaseId"];
        $qry22="select Ans, TqName from treatmentans inner join treatmentques on
        treatmentans.TqId=treatmentques.TqId where ChildCaseId='$caseid'";
      $result22=$cnn->query($qry22);

      while($row22=$result22->fetch_assoc()){

        $str2.="

          <tr>
            <td>".$row22["TqName"]."</td>
            <td>".$row22["Ans"]."</td>
          </tr>


        ";


      }



    }
    $str2.="</table>";

    #session 2 problem Details
    $qry2p="select * from childcase where ChildId='$childid' and statusId='4'";

    $result2p=$cnn->query($qry2p);
    $c2p = mysqli_num_rows($result2p);

    $str2p="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2'
    style='text-align:center'><mark style='background-color:pink;'>Psychological and Physical Problems in Session 2</mark></th></tr>
    <tr>
      <th>Problems</td>
      <th>Problem Details</td>
    </tr>";
    if($c2p == 0){$str2p="";}
    while($row2p=$result2p->fetch_assoc()){

      $caseid = $row2p["ChildCaseId"];
        $qry22p="select PhyProbTitle, Description from treatmentproblem inner join phyproblems on
         treatmentproblem.PhyId=phyproblems.PhyId where ChildCaseId='$caseid'";
      $result22p=$cnn->query($qry22p);
      $c2p = mysqli_num_rows($result22p);
      if($c2p == 0){$str2p="";}

      while($row22p=$result22p->fetch_assoc()){

        $str2p.="

          <tr>
            <td>".$row22p["PhyProbTitle"]."</td>
            <td>".$row22p["Description"]."</td>
          </tr>


        ";


      }



    }
    $str2p.="</table>";


    #session 2 session comments
    $qry2s="select * from childcase where ChildId='$childid' and statusId='4'";

    $result2s=$cnn->query($qry2s);
    $c2s = mysqli_num_rows($result2s);

    $str2s="<table id='simple-table' class='table  table-bordered table-hover'>
    <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 2 Notes and Comments</mark></th></tr>
    <tr>
      <th>Details and Comments</td>
      <th>Date</td>
    </tr>";
    if($c2s == 0){$str2s="";}
    while($row2s=$result2s->fetch_assoc()){

      $caseid = $row2s["ChildCaseId"];
        $qry22s="select * from treatmentdetails where ChildCaseId='$caseid'";
      $result22s=$cnn->query($qry22s);
      $c2s = mysqli_num_rows($result22s);
      if($c2s == 0){$str2s="";}

      while($row22s=$result22s->fetch_assoc()){

        $str2s.="

          <tr>
            <td>".$row22s["Notes"]."</td>
            <td>".$row22s["Dons"]."</td>
          </tr>


        ";


      }



    }
    $str2s.="</table>";




    #session 3

    $qry3="select * from childcase where ChildId='$childid' and statusId='6'";

    $result3=$cnn->query($qry3);
    $c3 = mysqli_num_rows($result3);

    $str3="<table id='simple-table' class='table  table-bordered table-hover'>
     <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 3 Details</mark></th></tr>
    <tr>
      <th>Questions</td>
      <th>Answers</td>
    </tr>";
    if($c3 == 0){$str3="";}
    while($row3=$result3->fetch_assoc()){

      $caseid = $row3["ChildCaseId"];
        $qry33="select Ans, TqName from treatmentans inner join treatmentques on treatmentans.TqId=treatmentques.TqId where ChildCaseId='$caseid'";
      $result33=$cnn->query($qry33);


      while($row33=$result33->fetch_assoc()){

        $str3.="

          <tr>
            <td>".$row33["TqName"]."</td>
            <td>".$row33["Ans"]."</td>
          </tr>


        ";


      }



    }
    $str3.="</table>";

    #session 3 problem Details
    $qry3p="select * from childcase where ChildId='$childid' and statusId='6'";

    $result3p=$cnn->query($qry3p);
    $c3p = mysqli_num_rows($result3p);

    $str3p="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Psychological and Physical Problems in Session 3</mark></th></tr>
    <tr>
      <th>Problems</td>
      <th>Problem Details</td>
    </tr>";
    if($c3p == 0){$str3p="";}
    while($row3p=$result3p->fetch_assoc()){

      $caseid = $row3p["ChildCaseId"];
        $qry33p="select PhyProbTitle, Description from treatmentproblem inner join phyproblems on treatmentproblem.PhyId=phyproblems.PhyId where ChildCaseId='$caseid'";
      $result33p=$cnn->query($qry33p);
      $c3p = mysqli_num_rows($result33p);
      if($c3p == 0){$str3p="";}

      while($row33p=$result33p->fetch_assoc()){

        $str3p.="

          <tr>
            <td>".$row33p["PhyProbTitle"]."</td>
            <td>".$row33p["Description"]."</td>
          </tr>


        ";


      }



    }
    $str3p.="</table>";

    #session 3 session comments
    $qry3s="select * from childcase where ChildId='$childid' and statusId='6'";

    $result3s=$cnn->query($qry3s);
    $c3s = mysqli_num_rows($result3s);

    $str3s="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 3 Notes and Comments</mark></th></tr>
    <tr>
      <th>Details and Comments</td>
      <th>Date</td>
    </tr>";
    if($c3s == 0){$str3s="";}
    while($row3s=$result3s->fetch_assoc()){

      $caseid = $row3s["ChildCaseId"];
        $qry33s="select * from treatmentdetails where ChildCaseId='$caseid'";
      $result33s=$cnn->query($qry33s);
      $c3s = mysqli_num_rows($result33s);
      if($c3s == 0){$str3s="";}

      while($row33s=$result33s->fetch_assoc()){

        $str3s.="

          <tr>
            <td>".$row33s["Notes"]."</td>
            <td>".$row33s["Dons"]."</td>
          </tr>


        ";


      }



    }
    $str3s.="</table>";



    #session 4

    $qry4="select * from childcase where ChildId='$childid' and statusId='8'";

    $result4=$cnn->query($qry4);
    $c4 = mysqli_num_rows($result4);

    $str4="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 4 Details</mark></th></tr>
    <tr>
      <th>Questions</td>
      <th>Answers</td>
    </tr>";
    if($c4 == 0){$str4="";}
    while($row4=$result4->fetch_assoc()){

      $caseid = $row4["ChildCaseId"];
        $qry44="select Ans, TqName from treatmentans inner join treatmentques on treatmentans.TqId=treatmentques.TqId where ChildCaseId='$caseid'";
      $result44=$cnn->query($qry44);

      while($row44=$result44->fetch_assoc()){

        $str4.="

          <tr>
            <td>".$row44["TqName"]."</td>
            <td>".$row44["Ans"]."</td>
          </tr>


        ";


      }



    }
    $str4.="</table>";


    #session 4 problem Details
    $qry4p="select * from childcase where ChildId='$childid' and statusId='8'";

    $result4p=$cnn->query($qry4p);
    $c4p = mysqli_num_rows($result4p);

    $str4p="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Psychological and Physical Problems in Session 4</mark></th></tr>
    <tr>
      <th>Problems</td>
      <th>Problem Details</td>
    </tr>";
    if($c4p == 0){$str4p="";}
    while($row4p=$result4p->fetch_assoc()){

      $caseid = $row4p["ChildCaseId"];
        $qry44p="select PhyProbTitle, Description from treatmentproblem inner join phyproblems on treatmentproblem.PhyId=phyproblems.PhyId where ChildCaseId='$caseid'";
      $result44p=$cnn->query($qry44p);
      $c4p = mysqli_num_rows($result44p);
      if($c4p == 0){$str4p="";}

      while($row44p=$result44p->fetch_assoc()){

        $str4p.="

          <tr>
            <td>".$row44p["PhyProbTitle"]."</td>
            <td>".$row44p["Description"]."</td>
          </tr>


        ";


      }



    }
    $str4p.="</table>";

    #session 4 session comments
    $qry4s="select * from childcase where ChildId='$childid' and statusId='8'";

    $result4s=$cnn->query($qry4s);
    $c4s = mysqli_num_rows($result4s);

    $str4s="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 4 Notes and Comments</mark></th></tr>
    <tr>
      <th>Details and Comments</td>
      <th>Date</td>
    </tr>";
    if($c4s == 0){$str4s="";}
    while($row4s=$result4s->fetch_assoc()){

      $caseid = $row4s["ChildCaseId"];
        $qry44s="select * from treatmentdetails where ChildCaseId='$caseid'";
      $result44s=$cnn->query($qry44s);
      $c4s = mysqli_num_rows($result44s);
      if($c4s == 0){$str4s="";}

      while($row44s=$result44s->fetch_assoc()){

        $str4s.="

          <tr>
            <td>".$row44s["Notes"]."</td>
            <td>".$row44s["Dons"]."</td>
          </tr>


        ";


      }



    }
    $str4s.="</table>";


    #session 5

    $qry5="select * from childcase where ChildId='$childid' and statusId='10'";

    $result5=$cnn->query($qry5);
    $c5 = mysqli_num_rows($result5);

    $str5="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 5 Details</mark></th></tr>
    <tr>
      <th>Questions</td>
      <th>Answers</td>
    </tr>";
    if($c5 == 0){$str5="";}
    while($row5=$result5->fetch_assoc()){

      $caseid = $row5["ChildCaseId"];
        $qry55="select Ans, TqName from treatmentans inner join treatmentques on treatmentans.TqId=treatmentques.TqId where ChildCaseId='$caseid'";
      $result55=$cnn->query($qry55);

      while($row55=$result55->fetch_assoc()){

        $str5.="

          <tr>
            <td>".$row55["TqName"]."</td>
            <td>".$row55["Ans"]."</td>
          </tr>


        ";


      }



    }
    $str5.="</table>";


        #session 5 problem Details
        $qry5p="select * from childcase where ChildId='$childid' and statusId='10'";

        $result5p=$cnn->query($qry5p);
        $c5p = mysqli_num_rows($result5p);

        $str5p="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Psychological and Physical Problems in Session 5</mark></th></tr>
        <tr>
          <th>Problems</td>
          <th>Problem Details</td>
        </tr>";
        if($c5p == 0){$str5p="";}
        while($row5p=$result5p->fetch_assoc()){

          $caseid = $row5p["ChildCaseId"];
            $qry55p="select PhyProbTitle, Description from treatmentproblem inner join phyproblems on treatmentproblem.PhyId=phyproblems.PhyId where ChildCaseId='$caseid'";
          $result55p=$cnn->query($qry55p);
          $c5p = mysqli_num_rows($result55p);
          if($c5p == 0){$str5p="";}

          while($row55p=$result55p->fetch_assoc()){

            $str5p.="

              <tr>
                <td>".$row55p["PhyProbTitle"]."</td>
                <td>".$row55p["Description"]."</td>
              </tr>


            ";


          }



        }
        $str5p.="</table>";

        #session 5 session comments
        $qry5s="select * from childcase where ChildId='$childid' and statusId='10'";

        $result5s=$cnn->query($qry5s);
        $c5s = mysqli_num_rows($result5s);

        $str5s="<table id='simple-table' class='table  table-bordered table-hover'> <tr><th colspan='2' style='text-align:center'><mark style='background-color:pink;'>Session 5 Notes and Comments</mark></th></tr>
        <tr>
          <th>Details and Comments</td>
          <th>Date</td>
        </tr>";
        if($c5s == 0){$str5s="";}
        while($row5s=$result5s->fetch_assoc()){

          $caseid = $row5s["ChildCaseId"];
            $qry55s="select * from treatmentdetails where ChildCaseId='$caseid'";
          $result55s=$cnn->query($qry55s);
          $c5s = mysqli_num_rows($result55s);
          if($c5s == 0){$str5s="";}

          while($row55s=$result55s->fetch_assoc()){

            $str5s.="

              <tr>
                <td>".$row55s["Notes"]."</td>
                <td>".$row55s["Dons"]."</td>
              </tr>


            ";


          }



        }
        $str5s.="</table>";




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
								Session Details

							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php echo $str; ?>
                <?php echo $str1; ?>
                <?php echo $str1p; ?>
                <?php echo $str1s; ?>
                <?php echo $str2; ?>
                <?php echo $str2p; ?>
                <?php echo $str2s; ?>
                <?php echo $str3; ?>
                <?php echo $str3p; ?>
                <?php echo $str3s; ?>
                <?php echo $str4; ?>
                <?php echo $str4p; ?>
                <?php echo $str4s; ?>
                <?php echo $str5; ?>
                <?php echo $str5p; ?>
                <?php echo $str5s; ?>




									<div class="hr hr-24"></div>
								</div>
							</div>
						</div>


<?php
include_once("psyOfficerFooter.php");
?>

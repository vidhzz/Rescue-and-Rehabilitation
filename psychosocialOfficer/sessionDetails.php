<?php
      session_start();
      if($_SESSION["logged_in"]==False){
   	 	header("location: ../loginUser.php");
   	 }
      $fn="";
      $ln="";
      $childid=$_REQUEST['Id'];
      $count = $_REQUEST['Count'];
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from Child where ChildId='$childid'";
			$result = $cnn->query($qry);
      $row1=$result->fetch_assoc();
      $fn = $row1["FirstName"];
      $ln = $row1["LastName"];
      //$roww=$result->fetch_assoc();
      //$childid = $row["ChildId"]


			/*$qry5="select * from Child where FirstName='$fn' and LastName='$ln'";
			//	echo $qry;
			$result5 = $cnn->query($qry5);
			$row5 = $result->fetch_assoc();
      $childid = $row5["ChildId"];*/

    $str = "<table id='simple-table' class='table  table-bordered table-hover'>";
    $qry66 = "select max(statusId) as statusId from childcase where ChildId='$childid'";
    $result66 = $cnn->query($qry66);
    $row66 = $result66->fetch_assoc();
    $stid = $row66["statusId"];
    if($stid%2==0){
      if($stid!=12){
        $i = 2;
        while($i<=$stid){


          $ccQry = "select ChildCaseId from childcase where statusId='$i'";
          $ccRes = $cnn->query($ccRes);
          $ccRow = $ccRes->fetch_assoc();
          $ccid = $ccRow["ChildCaseId"];
          $count1 = $i/2;

          $qry67 = "select *,phyproblems.PhyProbTitle from treatmentproblem inner join phyproblems on phyproblems.PhyId=treatmentproblem.PhyId where ChildCaseId='$ccid'";
          $result67 = $cnn->query($qry67);
          $str.="<br><tr><th class='detail-col' colspan='3'>Session-".$count1."</th></tr>
          <tr><th class='detail-col'> Problems </th><th class='detail-col'> Description </th></tr>";
          while($row67=$result67->fetch_assoc()){
              $str.="<tr><td> ".$row67["PhyProbTitle"]." </td><td> ".$row67["Description"]." </td></tr>";
          }
          $i = $i + 2;
        }

      }
      else{
        $rQry = "select * from childcase where ChildId='$childid'";
        $rRes = $cnn->query($rQry);
        $rRows = mysqli_num_rows($rRes);
        if($rRows==12){
          $i = 2;
          while($i<=10){

            $ccQry = "select ChildCaseId from childcase where statusId='$i'";
            $ccRes = $cnn->query($ccQry);
            $ccRow = $ccRes->fetch_assoc();
            $ccid = $ccRow["ChildCaseId"];
            $count1 = $i/2;

            $qry67 = "select *,phyproblems.PhyProbTitle from treatmentproblem inner join phyproblems on phyproblems.PhyId=treatmentproblem.PhyId where ChildCaseId='$ccid'";
            $result67 = $cnn->query($qry67);
            $str.="<br><tr><th class='detail-col' colspan='3'>Session-".$count1."</th></tr>
            <tr><th class='detail-col'> Problems </th><th class='detail-col'> Description </th></tr>";
            while($row67=$result67->fetch_assoc()){
              $str.="<tr><td> ".$row67["PhyProbTitle"]." </td><td> ".$row67["Description"]." </td></tr>";
            }
            $i = $i + 2;
          }
      }
      else{
        $i = 2;
          while($i<=$stid){

            $ccQry = "select ChildCaseId from childcase where statusId='$i'";
            $ccRes = $cnn->query($ccQry);
            $ccRow = $ccRes->fetch_assoc();
            $ccid = $ccRow["ChildCaseId"];
            $count1 = $i/2;

            $qry67 = "select *,phyproblems.PhyProbTitle from treatmentproblem inner join phyproblems on phyproblems.PhyId=treatmentproblem.PhyId where ChildCaseId='$ccid'";
            $result67 = $cnn->query($qry67);
            $str.="<br><tr><th class='detail-col' colspan='3'>Session-".$count1."</th></tr>
            <tr><th class='detail-col'> Problems </th><th class='detail-col'> Description </th></tr>";
            while($row67=$result67->fetch_assoc()){
              $str.="<tr><td> ".$row67["PhyProbTitle"]." </td><td> ".$row67["Description"]." </td></tr>";
            }
            $i = $i + 2;
          }

      }
    }
   }
    else{
      $stid--;
        $i = 2;
        while($i<=$stid){

          $ccQry = "select ChildCaseId from childcase where statusId='$i'";
          $ccRes = $cnn->query($ccRes);
          $ccRow = $ccRes->fetch_assoc();
          $ccid = $ccRow["ChildCaseId"];
          $count1 = $i/2;

          $qry67 = "select *,phyproblems.PhyProbTitle from treatmentproblem inner join phyproblems on phyproblems.PhyId=treatmentproblem.PhyId where ChildCaseId='$ccid'";
          $result67 = $cnn->query($qry67);
          $str.="<br><tr><th class='detail-col' colspan='3'>Session-".$count1."</th></tr>
          <tr><th class='detail-col'> Problems </th><th class='detail-col'> Description </th></tr>";
          while($row67=$result67->fetch_assoc()){
            $str.="<tr><td> ".$row67["PhyProbTitle"]." </td><td> ".$row67["Description"]." </td></tr>";
          }
          $i = $i + 2;
        }



    }
    $str.="</table><br>";

















?>



<?php
include_once("psyOfficerHeader.php");
?>

						<div class="page-header">
							<h1>
								Session Details of <?php echo "$fn $ln"; ?>

							</h1>
						</div><!-- /.page-header -->


							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<?php

									echo $str;

								?>


							</div><!-- /.col -->
						<!-- /.row -->


<?php
	include_once("psyOfficerFooter.php");
?>

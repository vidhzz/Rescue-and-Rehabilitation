
<?php

		session_start();

		if($_SESSION["logged_in"]==False){
		 header("location: ../loginUser.php");
		}
		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];

		$dd = date("Y-m-d");
		$info="";
		$info1="";
    $ctsid="";
    $str="";
    $num=1;




 			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select * from childtransportcase where ctsId='5'";
			$result = $cnn->query($qry);
      $c = mysqli_num_rows($result);
			$str = "<table id='simple-table' class='table  table-bordered table-hover'><th colspan='9' style='text-align:center;'>Date=".$dd."</th><tr><th>Number</th><th>Name</th><th>FatherName</th><th>Age</th><th>IOM</th><th>Area</th><th>City</th><th>State</th><th>Arrival Date</th></tr>";
      if($c >= 1){
				while($row=$result->fetch_assoc()){
					$childid= $row["ChildId"];
					$qry1="select max(ctsId) as ctsId from childtransportcase where ChildId='$childid' ";
					$result1 = $cnn->query($qry1);
					$row1=$result1->fetch_assoc();
					$ctsid=$row1["ctsId"];
					if($ctsid == 5){
						$qry2="select *, childaddress.area, childaddress.city, childaddress.state from child inner join childaddress on
						 child.ChildId=childaddress.ChildId where child.ChildId='$childid'";
						 $result2 = $cnn->query($qry2);
	 					$row2=$result2->fetch_assoc();
						$str.='<tr><td>'."$num".'</td><td>'.$row2["FirstName"].' '.$row2["LastName"].'</td><td>'.$row2["FatherName"].'</td><td>'.$row2["Age"].'</td><td>'.$row2["IOM"].'</td>
						<td>'.$row2["area"].'</td><td>'.$row2["city"].'</td><td>'.$row2["state"].'</td><td>'.$row2["DoSupervisor"].'</td></tr>';
						$num=$num+1;
					}else{
						$str.="";
					}

				}

        $str.="</table>";
      }else{
        $info="<font color='red'>No Kid at recent found transporting!</font>";

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


          <small>  <button onclick="myFunction()" style="float: right;">Print this page</button></small>
            <br>
						<div class="page-header">
							<h1>
                List of UAMSC who are reintegrating to their families by social workers from GTC
							</h1>
						</div><!-- /.page-header -->

              <?php echo "$str"; ?>
			  <a href="previousToUploadDocPage.php" style="float:right;"><h4>next to upload documents</h4></a>


									<div class="hr hr-24"></div>
								</div>
							</div>

<?php
include_once("socialFooter.php");
?>

<?php
session_start();

if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
$userid = $_SESSION["uid"];
$childid = $_REQUEST["id"];
$dd = DATE("Y-m-d");
$cnn = mysqli_connect("localhost","root","","rar");
$ans = "";
$qry1 = "select * from deliverymethod where ChildId=$childid";
$result = $cnn->query($qry1);
$rows = mysqli_num_rows($result);
if($rows==1){
   $row = $result->fetch_assoc();
   if($row["submit"]=='yes'){
      header("location:socialWorker.php");
   }
   $ans = $row["ttid"];
}
if(isset($_POST["btn1"])){
    if($rows==1){
        $rd = $_POST["btn"];
        $qry3 = "update deliverymethod set ttid='$rd',submit='yes'";
        $cnn->query($qry3);
        $qry33 = "update childcase set ctsId='3' where ChildId=$childid and statusId='12'";
        $qry44 = "insert into childtransportcase (ChildId,UserId,ctsId,Dosc) values ('$childid','$userid','3','$dd')";
        $cnn->query($qry33);
        $cnn->query($qry44);
        header("location:socialWorker.php");
    }
    else{
        $rd = $_POST["btn"];
        if($rd=='1'){
            $qry  = "insert into deliverymethod (ChildId,ttid,submit) values ('$childid','1','yes')";

        }
        else{
            $qry  = "insert into deliverymethod (ChildId,ttid,submit) values ('$childid','2','yes')";
        }
        $qry33 = "update childcase set ctsId='3' where ChildId=$childid and statusId='12'";
        $qry44 = "insert into childtransportcase (ChildId,UserId,ctsId,Dosc) values ('$childid','$userid','3','$dd')";
        $cnn->query($qry33);
        $cnn->query($qry44);
        $cnn->query($qry);
        header("location:socialWorker.php");
    }
}

if(isset($_POST["btn2"])){
    $rd1 = $_POST["btn"];
    if($rows=='1'){
        $qry2 = "update deliverymethod set ttid='$rd1',submit='no'";
    }
else{
    if(isset($rd1)){
    $qry2 = "insert into deliverymethod (ChildId,ttid,submit) values ('$childid','$rd1','no')";
    }
    else{
        header("location:socialWorker.php");
    }
}
$cnn->query($qry2);
header("location:socialWorker.php");
}

?>
<?php
include_once("socialHeader.php");
?>
<br><br>
<form method="post" name="address">
    <div class="widget-box" style="width:500px; margin:auto;">
        <div class="widget-header">
            <h4 class="smaller">
                Select Delivery Method
            </h4>
        </div>

            <div class="well" >


                <tr><input  type="radio" id="submit" name="btn" value="1" <?php if($ans=='1') echo'checked'; ?>> Direct to Family Member</tr> <br><br>
                <tr><input  type="radio" id="submit" name="btn"  value="2" <?php if($ans=='2') echo'checked'; ?>> Child Protection Action Network</tr>
               <br><br>
               <input  class="btn btn-info" type="submit" name="btn1" value="Submit" style="float:left;">
               <input class="btn btn-info" type="submit" name="btn2" value="Save and Exit" style="float:right;">

            </div>
    </div>

</form>
<?php
include_once("socialFooter.php");
?>

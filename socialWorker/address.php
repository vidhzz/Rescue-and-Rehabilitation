<?php
session_start();
if($_SESSION["logged_in"]==False){
 header("location: ../loginUser.php");
}
$name = $_SESSION["name"];
$pic = $_SESSION["pic"];
    $childid = $_REQUEST["id"];
    $cnn = mysqli_connect("localhost","root","","rar");
   // session_start();
    $houseNum = "";
    $area = "";
    $pinCode = "";
    $city = "";
    $state = "";
    $country = "";
    $qry1 = "select * from childaddress where ChildId=$childid and
     caid=(select max(caid) from childaddress where ChildId=$childid)";
    $result = $cnn->query($qry1);
    $count = mysqli_num_rows($result);
    $row = $result->fetch_assoc();

    if($count>0){

        if($row["submit"]=='yes'){
            header("location: DeliveryMethod.php?id=$childid");
        }
        else{
            $houseNum = $row["aptNum"];
            $area = $row["area"];
           // echo $area;
            $pinCode = $row["pinCode"];
            $city = $row["city"];
            $state = $row["state"];
            $country = $row["country"];
        }

    }
    if(isset($_POST["btn"])){

        $houseNum = $_POST["houseNum"];
        $area = $_POST["area"];
        $pinCode = $_POST["pinCode"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];

            $qry = "insert into childaddress (ChildId,aptNum,area,pinCode,city,state,country,submit)
            values ('$childid','$houseNum','$area','$pinCode','$city','$state','$country','yes')";



             $cnn->query($qry);
             header("location: address.php?id=$childid");

    }
    if(isset($_POST["btn1"])){
        $houseNum = $_POST["houseNum"];
        $area = $_POST["area"];
       // echo $area;
        $pinCode = $_POST["pinCode"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        if($count==0){
            if(empty($houseNum) and empty($area) and empty($pinCode) and empty($city) and
            empty($state) and empty($country)){
                header("location: socialWorker.php");
            }
            else{
                //echo "hi2";
                 $qry = "insert into childaddress (ChildId,aptNum,area,pinCode,city,state,country,submit)
                values ('$childid','$houseNum','$area','$pinCode','$city','$state','$country','no')";

            }
        }
        else{

            $qry = "update childaddress set aptNum='$houseNum', area='$area', pinCode='$pinCode', city='$city',
            state='$state', country='$country', submit='no' where ChildId=$childid";
        }
        $cnn->query($qry);
        header("location: socialWorker.php");


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
                Child's Address Details
            </h4>
        </div>

            <div class="well">

                House Number: <input type='text' name='houseNum' value='<?php echo $houseNum; ?>'><br><br>
                Area: <textarea rows='4' cols='50' name='area'><?php echo $area; ?></textarea><br><br>
                City: <input type='text' name='city' value='<?php echo $city; ?>'><br><br>
                Pin Code: <input type='number' name='pinCode' value='<?php echo $pinCode ?>'><br><br>
                State: <input type='text' name='state' value='<?php echo $state; ?>'><br><br>
                Country: <input type='text' name='country' value='<?php echo $country; ?>'><br><br>
                <input class="btn btn-info" type="submit" id="submit" name="btn" value="Submit and Next" style="float:left;">
                <input class="btn btn-info" type="submit" id="submit" name="btn1" value="Save and Exit" style="float:right;">




             </div>
    </div>

</form>


<?php
include_once("socialFooter.php");
?>

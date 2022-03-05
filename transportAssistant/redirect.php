<?php
  session_start();
  if($_SESSION["logged_in"]==False){
	 header("location: ../loginUser.php");
	}
  $name = $_SESSION["name"];
  $pic = $_SESSION["pic"];
  $alert="";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  $userid=$_SESSION["uid"];
  $mpid=$_REQUEST["mpid"];
  $cnn = mysqli_connect("localhost","root","","rar");
  $qry="update movingplan set status='executed' where mpid='$mpid'";
  $cnn->query($qry);
  $num=1;

  /*$qry2="select * from user where UserId='$userid'";
  $result2=$cnn->query($qry2);
  $row2=$result2->fetch_assoc();
  $senderid=$row2["Email"];*/


  $qry1="select * from movingplan inner join user on movingplan.UserId=user.UserId where mpid='$mpid' ";
  $result1=$cnn->query($qry1);
  $row1=$result1->fetch_assoc();
  $mailid=$row1["Email"];
  $name=$row1["FirstName"];
  $dd=date("Y-m-d");


  $qry3="select * from movingplankids inner join childcase on movingplankids.ChildId=childcase.ChildId inner join child on childcase.ChildId=child.ChildId
  inner join childaddress on child.ChildId=childaddress.ChildId where mpid='$mpid' and childcase.ctsId='6' and childcase.statusId='12'";
  $result3=$cnn->query($qry3);
  $c=mysqli_num_rows($result3);
  $str = "<table border='1' ><th colspan='9' style='text-align:center;'>Date :".$dd."<br>Start Location :".$row1["fromplace"]."<br>Destination Location :".$row1["toplace"]."
  <br>Start date :".$row1["fromdate"]."<br> Destination date :".$row1["todate"]."<br>Driver name :".$row1["driver"]."</th><tr><th>Sr. No.</th><th>IOM</th><th>Name</th><th>FatherName</th><th>Age</th><th>Area</th><th>city</th><th>state</th></tr>";
  if($c >= 1){
    while($row3=$result3->fetch_assoc()){
        $str.='<tr><td>'."$num".'</td><td>'.$row3["IOM"].'</td><td>'.$row3["FirstName"].' '.$row3["LastName"].'</td><td>'.$row3["FatherName"].'</td><td>'.$row3["Age"].'</td>
        <td>'.$row3["area"].'</td><td>'.$row3["city"].'</td><td>'.$row3["state"].'</td></tr>';
        $num=$num+1;
      }

    }else{
      $info="<font color='red'>No records found!</font>";

    }

    $str.="</table>";




  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "shivangsoni1998@gmail.com";
  $mail->Password   = "shivaum@321";

  $mail->IsHTML(true);
  $mail->AddAddress("$mailid", "$name");
  $mail->SetFrom("vidhipatel6899@gmail.com", "vidhi");//transporter assistant email details
  //$mail->AddReplyTo("reply-to-email", "reply-to-name");
  //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
  $mail->Subject = "Details on verified children for transportation";
  $content = "$str";

  $mail->MsgHTML($content);
  if(!$mail->Send()) {
    $alert= '<script>alert("Error while sending email!")</script>';
    var_dump($mail);
  } else {
    $alert= '<script>alert("Email sent successfully to the social worker!")</script>';
  }







  //header("location: listOfMovingPlan.php");
?>
<?php
include_once("TAheader.php");
?>
<br>
<a href="listOfMovingPlan.php"><h3 style='text-align: center;'>Click here for next verification</h3></a>
<div>
<?php echo "$alert"; ?>
</div>

								<?php
								include_once("TAfooter.php");
								?>

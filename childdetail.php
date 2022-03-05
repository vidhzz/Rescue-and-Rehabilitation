<?php


 include 'DatabaseConfig.php';

 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $Photo = $_POST['Photo'];
 $IOM = $_POST['IOM'];
 $UAM = $_POST['UAM'];
 $response = array();
 $RegistrationName = $_POST['RegistrationName'];
 $FirstName = $_POST['FirstName'];
 $LastName = $_POST['LastName'];
 $FatherName = $_POST['FatherName'];
 $MotherName = $_POST['MotherName'];
 $DOB = $_POST['DOB'];
 $Age = $_POST['Age'];
 $Gender = $_POST['Gender'];
 $Locality = $_POST['Locality'];
 $DoScreener = $_POST['DoScreener'];
 $ScUserId = $_POST["ScUserId"];
 $Education = $_POST['Education'];
 $Qualification = $_POST['Qualification'];

 $Image = $_POST['Image'];

 $target_dir = "/xampp/htdocs/RAR/pics/";


 $upload_image=$_FILES["Image"]["name"];



 $ServerURL = "http://192.168.43.22$target_dir$upload_image";

 move_uploaded_file($_FILES["Image"]["tmp_name"], "$target_dir".$_FILES["Image"]["name"]);
 $Sql_Query = "insert into child (Photo,IOM,UAM,RegistrationName,FirstName,LastName,FatherName,MotherName,DOB,Age,Gender,Locality,DoScreener,ScUserId,Education,Qualification) values
 ('$ServerURL','$IOM','$UAM','$RegistrationName','$FirstName','$LastName','$FatherName','$MotherName','$DOB','$Age','$Gender','$Locality','$DoScreener','$ScUserId','$Education','$Qualification')";

  if(mysqli_query($con,$Sql_Query))
{

 $response['message'] = 'Insertion Successful';
 echo json_encode($response);
}
else
{
 $response['message'] = 'Error '.$Sql_Query;
 echo json_encode($response);
 }

mysqli_close($con);
?>

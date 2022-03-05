<?php


 include 'DatabaseConfig.php';

 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $Image = $_POST['Image'];
 $RegistrationName = $_POST['RegistrationName'];
 $Gender = $_POST['Gender'];
 $response = array();
 $Dos = $_POST['Dos'];
 $ScUserId = $_POST["ScUserId"];


 $target_dir = "/xampp/htdocs/RAR/pics/";


 $upload_image=$_FILES["Image"][ "name" ];



 $ServerURL = "http://192.168.43.22$target_dir$upload_image";

 move_uploaded_file($_FILES["Image"]["tmp_name"], "$target_dir".$_FILES["Image"]["name"]);
 //file_put_contents($ServerURL, base64_decode($Image));
  //$move_uploaded_file = ftp_put($conn_id, $upload_image, $target_dir, FTP_BINARY);

 $Sql_Query = "insert into child (Photo,RegistrationName,Gender,DoScreener,ScUserId) values
 ('$ServerURL','$RegistrationName','$Gender','$Dos','$ScUserId')";

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

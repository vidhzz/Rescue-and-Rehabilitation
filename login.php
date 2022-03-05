<?php
 include 'DatabaseConfig.php';

 if($_SERVER['REQUEST_METHOD']=='POST'){

 //session_start();
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
 $username = $_POST['username'];
 $password = $_POST['password'];
 
 //$_SESSION["userName"] = $username;
 //$_SESSION["pass"] = $password;
 
 $Sql_Query = "select * from user where UserName = '$username' and Password = '$password' and UTypeId = 1";	
 
 $check = mysqli_fetch_assoc(mysqli_query($con,$Sql_Query));
 $_SESSION["userId"]=$check["UserId"];
 
 if(isset($check)){
 
 echo $check["UserId"];	
 }
 else{
 echo "Invalid";
 }
 
 }else{
 echo "Check Again";
 }
mysqli_close($con);

?>
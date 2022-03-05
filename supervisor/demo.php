<?php 
    $date="2019-12-11";

			$cnn = mysqli_connect("localhost","root","","rar");
				$query23 = "insert into ttt(tname,tkname,id2) values ('a','b',11)";
				echo $query23;
	
				$cnn->query($query23);
	
?>
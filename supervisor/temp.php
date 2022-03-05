<?php 
    $cnn = mysqli_connect("localhost", "root", "", "rar");
    $qry = "insert into temp (Num) values('1')";
    $cnn -> query($qry);
?>
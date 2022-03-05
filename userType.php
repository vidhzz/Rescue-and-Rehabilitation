<?php
include_once("header.php");
?>
<h4 class="pink">
									<i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
									<a href="#modal-table" role="button" class="green" data-toggle="modal"> Table Inside a Modal Box </a>
								</h4>
	<?php
		$cnn = mysqli_connect("localhost","root","","rar");
		$result = $cnn->query("select * from usertype");
		$str="<table class='table  table-bordered table-hover'><tr><th>User Id</th><th>User Type</th></tr>";
		while($row = $result->fetch_assoc()){
			$str.= "<tr><td>".$row["UTypeId"]."</td><td>".$row["UTypeName"]."</td></tr>";
		}
		$str.="</table>"
	?>
<div>
	
	<?php 
			echo $str;
	?>
<?php
include_once("footer.php");
?>
<html>
	<body>
	<?php 
		$eno = "";
		$ename = "";
		$g = "";
		$s = "";
		$dep = "";
		$str="";
		if(isset($_POST["insert"])){
			$eno = $_POST["eno"];
			$ename = $_POST["ename"];
			$g = $_POST["gender"];
			$s = $_POST["salary"];
			$dep = $_POST["dname"];

		$qry="insert into emp (eno, ename, salary, gender, dname) values ('$eno', '$ename', '$s', '$g', '$dep')";

			$cnn = mysqli_connect("localhost","root","","dbdemo");
			if($cnn->query($qry) == true){
				echo "inserted successfully";	
			}
			else{
				echo "try again";
			}
			
			/*$str="<table border='2'><tr><th>Fname </th><th>Lname</th></tr>";
			$rows = mysqli_num_rows($result);
			//echo "$rows";
			if($rows == 1){
				while($row = $result->fetch_assoc()){
					$str.="<tr><Td>". $row["fname"]."</td><td>".$row["lname"]."</td></tr>";
				}
			}
			$str.="</table>";*/

	}

		if(isset($_POST["delete"])){
			$eno = $_POST["eno"];

			$qry="delete from emp where eno='$eno' ";

			$cnn = mysqli_connect("localhost","root","","dbdemo");
			if($cnn->query($qry) == true){
				echo "deleted successfully";	
			}
			else{
				echo "try again";
			}

		}
		if(isset($_POST["update"])){
			$eno = $_POST["eno"];
			$ename = $_POST["ename"];
			$g = $_POST["gender"];
			$s = $_POST["salary"];
			$dep = $_POST["dname"];

		$qry="update emp set ename='$ename', gender='$g', salary='$s', dname='dep' where eno='$eno' ";

			$cnn = mysqli_connect("localhost","root","","dbdemo");
			if($cnn->query($qry) == true){
				echo "updated successfully";	
			}
			else{
				echo "try again";
			}
			

		}


	?>
	<form name="fun1" method="post">

		eno:
		<input type="text" name="eno" value="<?php echo "$eno";?>"><br><br>
		ename:
		<input type="text" name="ename" value="<?php echo "$ename";?>"><br><br>
		salary:
		<input type="text" name="salary" value="<?php echo "$s";?>"><br><br>
		gender:
		<input type="text" name="gender" value="<?php echo "$g";?>"><br><br>
		dname:
		<input type="text" name="dname" value="<?php echo "$dep";?>"><br><br>
		<input type="submit" name="insert" value="insert"><br><br>
		<input type="submit" name="update" value="update"><br><br>
		<input type="submit" name="delete" value="delete">
		
	</form>
	<div>
	<?php
	//	echo $str;
	?>
</div>

	</body>
</html>
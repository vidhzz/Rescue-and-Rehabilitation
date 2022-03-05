<html>
<body>
	<?php 
		$userName = "";
		
		if(isset($_POST["btn"])){
			$userName = $_POST["UserName"];
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="insert into usertype (UTypeName) values ('$userName')";

			if($cnn){
				echo "database connected";

			}
			else{
				echo "not connected";
			}
			if($cnn->query($qry) == true){
				echo "inserted successfully";	
			}
			else{
				echo "try again";
			}
		}
	?>
<form>			
<input type="text" name="UserName" value="<?php echo "$userName";?>">
<input type="submit" name="btn" value="submit">	
</form>		
</body>
</html>
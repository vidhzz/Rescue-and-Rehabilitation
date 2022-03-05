<?php
		session_start();
		if($_SESSION["logged_in"]==False){
 	 	header("location: ../loginUser.php");
 	 }
		$name = $_SESSION["name"];
		$pic = $_SESSION["pic"];
		$id = $_SESSION["uid"];

		$fn="";
		$ln="";
		$un="";
		$si="";
		$cn="";
		$pic="";

		if(isset($_POST["submit"])){
			$fn = $_POST["fn"];
			$ln=$_POST["ln"];
			$cn=$_POST["cn"];
			$un=$_POST["un"];
			$si=$_POST["si"];

			$cnn = mysqli_connect("localhost","root","","rar");

			$cnn->query("update user set FirstName='$fn', LastName='$ln', UserName='$un', ContactNo2='$cn', SkypeId='$si' where UserId='$id' ");
		}
		if(isset($_POST["rst"])){

			$fn="";
			$ln="";
			$un="";
			$si="";
			$cn="";
		}
?>
<?php
	include_once("psyOfficerHeader.php");
?>
<form class="form-horizontal" role="form" method="post" >																			<br><br>															<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> FirstName </label>								<div class="col-sm-9">
		<input type="text"  name="fn" class="col-xs-10 col-sm-5" value="<?php echo "$fn";?>" />
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> LastName </label>
<div class="col-sm-9">
<input type="text"  name="ln" class="col-xs-10 col-sm-5" value="<?php echo "$ln";?>" />
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> UserName </label>
<div class="col-sm-9">
<input type="text"  name="un" class="col-xs-10 col-sm-5" value="<?php echo "$un";?>" />
</div>
							<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact Number </label>
<div class="col-sm-9">
<input type="text"  name="cn" class="col-xs-10 col-sm-5" value="<?php echo "$cn";?>" />
</div>
<br><br>
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Skype Id </label>
<div class="col-sm-9">
<input type="text"  name="si" class="col-xs-10 col-sm-5" value="<?php echo "$si";?>" />
</div>
<br><br>
</div>
<div class="clearfix form-actions">

<div class="col-md-offset-3 col-md-9">

<input class="btn btn-info" type="submit" name="submit" value="submit">
&nbsp; &nbsp; &nbsp;
<input class="btn" type="submit" value="Reset" name="rst">
&nbsp; &nbsp; &nbsp;

</div>
				</div>
<div class="hr hr-24"></div>

<?php
	include_once("psyOfficerFooter.php");
?>

<?php
include_once("header.php");
?>

	<?php 
		$userName = "";
		
		if(isset($_POST["btn"])){
			$userName = $_POST["UserName"];

		$qry="insert into usertype (UTypeName) values ('$userName')";

			$cnn = mysqli_connect("localhost","root","","rar");
			if($cnn->query($qry) == true){
				echo "inserted successfully";	
			}
			else{
				echo "try again";
			}
		}
	?>
			

<div class="page-header">
							<h1>
								Insert UserType
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Type </label>

										<div class="col-sm-9">
											<input type="text" name="UserName" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" value="<?php echo "$userName";?>" />
										</div>
									</div>

									
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input  class="btn btn-info" type="submit" name="btn" value="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
										

											&nbsp; &nbsp; &nbsp;
											
										</div>
									</div>
<?php
include_once("footer.php");
?>
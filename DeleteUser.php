<?php
include_once("header.php");
?>

	<?php 
		$userId = "";
		
		if(isset($_POST["btn"])){
			$userId = $_POST["UserId"];

		$qry="delete from usertype where UTypeId='$userId'";

			$cnn = mysqli_connect("localhost","root","","rar");
			if($cnn->query($qry) == true){
				echo "Deleted successfully";	
			}
			else{
				echo "try again";
			}
		}
	?>
			

<div class="page-header">
							<h1>
								Insert UserId
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Id </label>

										<div class="col-sm-9">
											<input type="text" name="UserId" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" value="<?php echo "$userId";?>" />
										</div>
									</div>

									
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input  class="btn btn-info" type="submit" name="btn" value="delete">
												<i class="ace-icon fa fa-check bigger-110"></i>
										

											&nbsp; &nbsp; &nbsp;
											
										</div>
									</div>
<?php
include_once("footer.php");
?>
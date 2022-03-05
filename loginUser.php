<?php
		session_start();
		$_SESSION["logged_in"] = False;
		$username="";
		$password="";
		$info = "";
		$emmsg = "";
		//echo $aa;
		if(isset($_POST["btn"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			//$password = md5($password);
			$cnn = mysqli_connect("localhost","root","","rar");
			$qry="select *,usertype.UTypeName from user inner join usertype on user.UTypeId=usertype.UTypeId where UserName='$username' and Password='$password'";
			$result = $cnn->query($qry);
			$row=$result->fetch_assoc();
			//$fn=$row["FirstName"];
			//$ln=$row["LastName"];

			//echo $userTypeName;
			$cnt = mysqli_num_rows($result);
			if($cnt==0){
				$info = "<font color='red'>Either Username or Password is invalid!</font>";
			}
			else{
				$userTypeId = $row["UTypeId"];
				if(isset($_POST["remBtn"])){
				//$rem = "yes"
				setcookie('username',$_POST["username"],time()+60*60*24*365);
				setcookie('password',$_POST["password"],time()+60*60*24*365);
				setcookie('check',"yes",time()+60*60*24*365);
				}
				else{
					setcookie('username',"",time()+60*60*24*365);
					setcookie('password',"",time()+60*60*24*365);
					setcookie('check',"",time()+60*60*24*365);
				}
			//	session_start();
				$_SESSION["uid"] = $row["UserId"];
				$_SESSION["utypeid"] = $row["UTypeId"];
				$_SESSION["utypename"] = $row["UTypeName"];
				$_SESSION["name"] = $row["FirstName"]." ".$row["LastName"];
				$_SESSION["fname"] = $row["FirstName"];
				$_SESSION["lname"] = $row["LastName"];
				$_SESSION["pic"] = $row["Photo"];
				$_SESSION["logged_in"] = True;

			if($userTypeId == 7){
				header("location:admin/admin.php");
			}
			elseif($userTypeId == 1){
				header("location:screener/Screener.php");
			}
			elseif($userTypeId == 2){
				header("location:supervisor/supervisor.php");
			}
			elseif($userTypeId == 3){
				header("location:transportAssistant/transporter.php");
			}
			elseif($userTypeId == 4){
				header("location:psychosocialOfficer/psychosocialOfficer.php");
			}
			elseif($userTypeId == 5){
				header("location:socialWorker/socialWorker.php");
			}
			else{
				header("location:securityOfficer/securityOfficer.php");
			}

		}

	}

	//forgot password query



	?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<script type = "text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>

								</h1>
								<h4 class="blue" id="id-company-text">&copy; Rescue and Rehabilitation</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>

											<form method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" name="username"
															value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"];} ?>" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="password"
															value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"];} ?>" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

												<?php
													echo $info;
												?>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" name="remBtn"
															<?php if(isset($_COOKIE["check"])){if($_COOKIE["check"]=='yes'){echo 'checked';}} ?> />
															<span class="lbl"> Remember Me</span>
														</label>
														&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
														<i class="ace-icon fa fa-key"></i>
														<input type="submit" class="bigger-110" value="Login" name="btn">



													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>


											<div class="space-6"></div>


										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="forgotUser.php" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													I forgot my password
												</a>
											</div>


										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->



							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});



			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');

				e.preventDefault();
			 });

			});
		</script>
	</body>
</html>

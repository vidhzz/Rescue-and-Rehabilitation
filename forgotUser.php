<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
		$emmsg = "";
		$email ="";



	//forgot password query
	if(isset($_POST["emailbtn"])){
		$email = $_POST["email"];
    $cnn = mysqli_connect("localhost","root","","rar");
    $qry1="select * from user where Email = '$email'";
    $result1 = $cnn->query($qry1);
    $count = mysqli_num_rows($result1);
    $row=$result1->fetch_assoc();
    $userid=$row["UserId"];
    if($count > 0 ){


		  require 'PHPMailer-master/src/Exception.php';
		  require 'PHPMailer-master/src/PHPMailer.php';
		  require 'PHPMailer-master/src/SMTP.php';

		  $mail = new PHPMailer();
		  $mail->IsSMTP();

		  $mail->SMTPDebug  = 0;
		  $mail->SMTPAuth   = TRUE;
		  $mail->SMTPSecure = "tls";
		  $mail->Port       = 587;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Username   = "vidhipatel6899@gmail.com";
		  $mail->Password   = "hextrihelloworld";

		  $mail->IsHTML(true);
		  $mail->AddAddress("$email", "vansh");
		  $mail->SetFrom("vidhipatel6899@gmail.com", "vidhi");
		  //$mail->AddReplyTo("reply-to-email", "reply-to-name");
		  //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
		  $mail->Subject = "Regarding Resetting The Password";
		  $content = "<b>To reset your password please<a href='http://localhost/rar/resetPassword.php?userId=$userid'>click the link here</a>.</b>";

		  $mail->MsgHTML($content);
		  if(!$mail->Send()) {
		    $emmsg= "<font color='red'>Error while sending Email.</font>";
		    var_dump($mail);
		  } else {
		    $emmsg="<font color='green'>Please check your e-mail, we have sent the password reset link to your registered email.</font>";
		  }




    }else{
      $emmsg="<font color='red'>Given email is not associated with any account.</font>";
    }
}

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



              <div id="forgot-box" class="forgot-box widget-box no-border visible">
                <div class="widget-body">
                  <div class="widget-main">
                    <h4 class="header red lighter bigger">
                      <i class="ace-icon fa fa-key"></i>
                      Retrieve Password
                    </h4>

                    <div class="space-6"></div>
                    <p>
                      Enter your email and to receive instructions
                    </p>

                    <form method="post">
                      <fieldset>
                        <label class="block clearfix">
                          <span class="block input-icon input-icon-right">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo "$email"; ?>">
                            <i class="ace-icon fa fa-envelope"></i>
                          </span>
                        </label>
                        <?php echo $emmsg;?>
                        <div class="clearfix">
                          <input type="submit" name="emailbtn" value="Send Me!" class="width-35 pull-right btn btn-sm btn-danger">
                        </div>
                      </fieldset>
                    </form>
                  </div><!-- /.widget-main -->

                  <div class="toolbar center">
                    <a href="loginUser.php" class="back-to-login-link">
                      Back to login
                      <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                  </div>
                </div><!-- /.widget-body -->
              </div>


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

<?php
  $userid = $_REQUEST["userId"];
  $emmsg = "";
  $pass="";
  $conpass="";

  if(isset($_POST["btn"])){

    $pass = $_POST["pass"];
    $conpass = $_POST["conpass"];
    if($pass == $conpass){
        $cnn = mysqli_connect("localhost","root","","rar");
        $qry1="update user set Password='$conpass' where UserId = '$userid'";
        $result1 = $cnn->query($qry1);
        //header("Location: loginUser.php");
        $emmsg="<font color='green'>password has been changed, login with your new password!</font>";
    }
    else{
      $emmsg="<font color='red'>password doesn't match!</font>";
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
    <script>
    function myFunction() {
  var x = document.getElementById("c1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
  function myFunction1() {
  var x = document.getElementById("c2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

    </script>
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
                        Change Password
                      </h4>

                      <div class="space-6"></div>
                      <p>
                        Enter new password and confirm it.
                      </p>

                      <form method="post">
                        <fieldset>
                          <table height="50" width="315">
                            <tr>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">

                              <td><input type="password" class="form-control" placeholder="PASSWORD" name="pass" id="c1" value="<?php echo "$pass"; ?>"></td>
                            <td>  <i class="fa fa-fw fa-eye field-icon toggle-password" onclick="myFunction()"></i></td>
                            </span>
                          </label>
                        </tr>
                            <tr>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <td><input type="password" class="form-control" placeholder="CONFIRM PASSWORD" name="conpass" id="c2" value="<?php echo "$conpass"; ?>"></td>
                            <td>  <i class="fa fa-fw fa-eye field-icon toggle-password" onclick="myFunction1()"></i></td>
                            </span>
                          </label>
                        </tr>
                        </table>
                        <br>

                          <?php echo $emmsg;?>
                          <div class="clearfix">
                            <input type="submit" name="btn" value="Reset Password" class="width-32 pull-right btn btn-sm btn-danger">
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

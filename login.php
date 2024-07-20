<?php
session_start();
include ("config.php");
$error = "";
$msg = "";
if (isset($_REQUEST['login'])) {
	$email = $_REQUEST['email'];
	$pass = $_REQUEST['pass'];
	// $pass = sha1($pass);

	if (!empty($email) && !empty($pass)) {
		$sql = "SELECT * FROM user where uemail='$email' && upass='$pass'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		if ($row) {

			$_SESSION['uid'] = $row['uid'];
			$_SESSION['uemail'] = $email;
			header("location:index.php");

		} else {
			$error = "<p class='alert alert-warning'>Email or Password doesnot match!</p> ";
		}
	} else {
		$error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta Tags -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="images/favicon.ico">

	<!--	Fonts
	========================================================-->
	<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

	<!--	Css Link
	========================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/layerslider.css">
	<link rel="stylesheet" type="text/css" href="css/color.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<!--	Title
	=========================================================-->
	<title>welthome</title>
</head>

<body>

	<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
-->

	<?php
	require_once 'vendor/autoload.php';

	// init configuration
	$clientID = '127421054762-i6v3ciq5r1uaiuo97anupgklcn27u70j.apps.googleusercontent.com';
	$clientSecret = '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';
	$redirectUri = 'http://localhost/project/welthome/login.php';

	// create Client Request to access Google API
	$client = new Google_Client();
	$client->setClientId($clientID);
	$client->setClientSecret($clientSecret);
	$client->setRedirectUri($redirectUri);
	$client->addScope("email");
	$client->addScope("profile");

	// authenticate code from Google OAuth Flow
	if (isset($_GET['code'])) {
		$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		$client->setAccessToken($token['access_token']);

		// get profile info
		$google_oauth = new Google_Service_Oauth2($client);
		$google_account_info = $google_oauth->userinfo->get();
		$email = $google_account_info->email;
		$name = $google_account_info->name;

		?>
		<div class="container">
			<div class="box">
				<div class="form-group">
					<label for="email">Email <?php echo $email; ?></label>
					<label for="name">Name <?php echo $name; ?></label>
				</div>
			</div>
		</div>
		<?php
	} else {
		?>


		<div id="page-wrapper">
			<div class="row">
				<!--	Header start  -->
				<?php include ("include/header.php"); ?>
				<!--	Header end  -->

				<!--	Banner   --->
			<!-- <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Login</b></h2>
					</div>
					<div class="col-md-6">
						<nav aria-label="breadcrumb" class="float-left float-md-right">
							<ol class="breadcrumb bg-transparent m-0 p-0">
								<li class="breadcrumb-item text-white"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Login</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div> -->
				<!--	Banner   --->


			<div class="page-wrappers login-body full-row bg-gray">
				<div class="login-wrapper">
					<div class="container">
						<div class="loginbox">
							<div class="login-right">
								<div class="login-right-wrap">
									<h1>LOGIN</h1>
									<p class="account-subtitle">Access to our dashboard</p>
									<?php echo $error; ?>
									<?php echo $msg; ?>
									<!-- Form -->
										<form method="post">
											<div class="form-group">
												<input type="email" name="email" class="form-control"
													placeholder="Your Email">
											</div>
											<div class="form-group">
												<input type="password" name="pass" class="form-control"
													placeholder="Your Password">
											</div>
											<div class="d-flex justify-content-between">
												<div class="form-group">
													<input type="checkbox"><span class=""> Remember me</span>
												</div>
												<div class="form-group">
													<a href="forgotpass.php">Forgot Password?</a>
												</div>
											</div>

											<button class="btn btn-success form-control" name="login" value="Login"
												type="submit">Login</button>
										</form>


										<div class="login-or">
											<span class="or-line"></span>
											<span class="span-or">or</span>
										</div>
										<!-- Social Login -->
										<div class="social-login d-flex justify-content-around px-5">
											<!-- <span>Login with</span> -->
											<a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
											<a href="<?php echo $client->createAuthUrl() ?>" class="google"><i
													class="fab fa-google"></i></a>
											<a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
											<!-- <a href="#" class="google"><i class="fab fa-instagram"></i></a> -->
										</div>
										<!-- /Social Login -->

										<div class="text-center dont-have">Don't have an account? <a
												href="register.php">Register</a></div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--	login  -->


				<!--	Footer   start-->
				<?php include ("include/footer.php"); ?>
				<!--	Footer   start-->

				<!-- Scroll to top -->
				<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i
						class="fas fa-angle-up"></i></a>
				<!-- End Scroll To top -->
			</div>
		</div>

	<?php } ?>
	<!-- Wrapper End -->

	<!--	Js Link
============================================================-->
	<script src="js/jquery.min.js"></script>
	<!--jQuery Layer Slider -->
	<script src="js/greensock.js"></script>
	<script src="js/layerslider.transitions.js"></script>
	<script src="js/layerslider.kreaturamedia.jquery.js"></script>
	<!--jQuery Layer Slider -->
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/tmpl.js"></script>
	<script src="js/jquery.dependClass-0.1.js"></script>
	<script src="js/draggable-0.1.js"></script>
	<script src="js/jquery.slider.js"></script>
	<script src="js/wow.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>
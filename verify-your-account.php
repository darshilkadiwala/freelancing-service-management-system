<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
if (!(isset($_SESSION['needVerify']) && $_SESSION['needVerify'] === true)) {
	header('Location: /FSMS/Login.php');
} else if (isset($_SESSION['needVerify']) && $_SESSION['needVerify'] === true) {
	unset($_SESSION['isLoggedIn']);

	$tempError = true;
	if (!(isset($_SESSION['OTP']) && !empty($_SESSION['OTP']))) {
		require_once './php/functions.php';
		require_once './php/phpmailer/Exception.php';
		require_once './php/phpmailer/PHPMailer.php';
		require_once './php/phpmailer/SMTP.php';

		$email = $_SESSION['Email'];
		$username = $_SESSION['Username'];
		$sqlSelectEmail = "SELECT `FirstName`, `LastName` FROM `tbluserpersonaldetails` WHERE `Email`= '{$email}' AND `Username`='{$username}'";
		$query = mysqli_query($dbConn, $sqlSelectEmail);
		if (mysqli_num_rows($query) == 1) {
			$row = mysqli_fetch_assoc($query);
			$subject = "OTP for Verifying your Account !!!";
			$otp = genrateOTP();
			$messageBody = "<h3>Hello Dear " . ucwords("{$row['FirstName']} {$row['LastName']}", " ") . ", please verify your email address</h3>
		<h3>OTP for Verifying your Account : <b style=\"color:blue\">$otp</b></h3>";
			$sendMail = new PHPMailer();
			if (sendEmail($subject, $messageBody, $email, ucwords("{$row['FirstName']} {$row['LastName']}", " "), $sendMail)) {
				$_SESSION['OTP'] = (int) $otp;
				$tempError = false;
			}
		}
	} else {
		$tempError = false;
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Verify Your Account | FSMS</title>
		<meta charset='utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
		<script src='/FSMS/assets/js/popup-msg.js'></script>
		<?php
		require_once './widgets/head-link.php';
		?>
	</head>

	<body class='bg-color-12192C'>
		<?php
		require_once './widgets/header.php';
		if (!$tempError) {
		?>
			<div class='main-wrapper mx-5 py-5'>
				<div class='container col-lg-6'>
					<div class='row bg-white rd-30 no-gutters justify-content-md-center shadow-lg'>
						<div id='popup-div' style='display: none;'></div>
						<div class='px-5 col-lg-12 justify-content-center align-content-center align-items-center row pr-3 py-4'>
							<h1 class='font-weight-bold align-items-center ml-4 h3'>
								Verify your account</h1>
							<hr class='col-lg-11 bg-light' />
							<form class='col-9' id='frmVerifyAccount' action='#'>
								<div class='mx-2 pb-2'>
									<div class='form-row'>
										<label ID='lblOTP' for='txtOTP' class='ml-1 mt-3 color-12192C font-weight-bold'>OTP :<small> (Sent to your registerd email id)</small></label>
										<input type='number' ID='txtOTP' name='txtOTP' class='form-control mt-0 p-4' placeholder='Enter OTP here' tabindex='2' max='999999' min='100000' required />
									</div>
								</div>
								<div class='form-row'>
									<div class='col-lg-4'>
										<div class='loadingButton'>
											<input type='submit' ID='btnVerify' name='btnVerify' class='btn Btn-large mt-2' value='Verify OTP' tabindex='3' />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php
		} else { ?>
			<div class='main-wrapper mx-5 py-5'>
				<div class='container col-lg-6'>
					<div class='row bg-white rd-30 no-gutters justify-content-md-center shadow-lg'>
						<div id='popup-div' style='display: none;'></div>
						<div class='px-5 col-lg-12 justify-content-center align-content-center align-items-center row pr-3 py-4'>
							<h1 class='font-weight-bold align-items-center ml-4 h2'>
								Verify your account</h1>
							<hr class='col-lg-11 bg-light' />
							<h1 class='font-weight-bold align-items-center ml-4 h5'>
								Something went wrong please try later...</h1>
						</div>
					</div>
				</div>
			</div>
			<script>
				showPopUp("Something went wrong please try later... !!!", 'bg-danger', 10000);
			</script>
		<?php
		}
		require_once './widgets/footer.php';
		?>
		<script src='/FSMS/assets/js/scroll.js'></script>
		<script src='/FSMS/assets/js/verify-your-account.js'></script>
	</body>

	</html>
<?php
}
?>
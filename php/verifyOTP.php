<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once './config.php';
	require_once './constants.php';
	require_once './functions.php';
	require_once "./phpmailer/Exception.php";
	require_once "./phpmailer/PHPMailer.php";
	require_once "./phpmailer/SMTP.php";
	session_start();

	// check OTP
	$result = array(); //this
	// if (empty($_POST["txtOTP"])) {
	// 	$result[] = array("error" => "OTP is Required<br/>");
	// } else {
	// 	$otp = test_input($_POST["txtOTP"]);
	// 	if (!preg_match(MATCHPINCODE, $otp)) {
	// 		$result[] = array("error" => "Invalid OTP format<br/>");
	// 	}
	// }
	// // check new password
	// if (empty($_POST["txtNewPasswd"])) {
	// 	$result[] = array("error" => "New Password is Required<br/>");
	// } else {
	// 	$newpassword = test_input($_POST["txtNewPasswd"]);
	// 	if (!preg_match(MATCHPASSWORD, $newpassword)) {
	// 		$result[] = array("error" => ERRORPASSWORD . "<br/>");
	// 	}
	// }

	// // check confirm new password
	// if (empty($_POST["txtConfirmNewPasswd"])) {
	// 	$result[] = array("error" => "Confirm Password is Required<br/>");
	// } else {
	// 	$confnewpassword = test_input($_POST["txtConfirmNewPasswd"]);
	// 	if (!preg_match(MATCHPASSWORD, $confnewpassword)) {
	// 		$result[] = array("error" => ERRORPASSWORD . "<br/>");
	// 	}
	// }

	// // check both password & confirm password are same
	// if (!(empty($_POST["txtNewPasswd"]) && empty($_POST["txtConfirmNewPasswd"]))) {
	// 	$newpassword = test_input($_POST["txtNewPasswd"]);
	// 	$confnewpassword = test_input($_POST["txtConfirmNewPasswd"]);
	// 	if (!$newpassword === $confnewpassword) {
	// 		$result[] = array("error" => "Password are not matching. Both password must be same<br/>");
	// 	}
	// }

	if (isset($_POST['txtOTP']) && isset($_POST['txtNewPasswd'])  && isset($_POST['txtConfirmNewPasswd']) && (!(empty($_POST['txtOTP']) && empty($_POST['txtNewPasswd'])  && empty($_POST['txtConfirmNewPasswd'])))) {
		$emailId = $_SESSION['EmailId'];
		$userid = (int) $_SESSION['UserID'];
		$role = (int)$_SESSION['RoleID'];
		$table = "";
		$otp = test_input($_POST['txtOTP']);
		$table = ($role == 1) ? "tbladmin" : (($role == 2 || $role == 3) ? "tbluserpersonaldetails" : "");

		if ($otp == $_SESSION['OTP'] && $_POST['txtNewPasswd'] == $_POST['txtConfirmNewPasswd']) {
			$newpass = test_input($_POST['txtNewPasswd']);
			$sqlUpdatePass = "UPDATE `$table` SET `Password`=MD5('{$newpass}') WHERE `UserID`={$userid} AND `RoleID`={$role} AND `Email`='{$emailId}'";
			$passUpdate = mysqli_query($dbConn, $sqlUpdatePass);
			if ($passUpdate) {
				$subject = "Your Password changed Successfully 👍👍!!!";
				$messageBody = "<h1>You have recently changed password of your FSMS account : {$_SESSION['Username']} </h1><br/><h3><b style=\"color:red\">If you had not done this 🤷🏼‍♂️🤷🏼‍♂️ try to change password or contact us or mail us</b></h3><br/>If you done this ignore it.👍👍";
				// if (isset($_SESSION['isLoginMailSent']) && $_SESSION['isLoginMailSent'] === true) {
				$sendMail = new PHPMailer();
				sendEmail($subject, $messageBody, $emailId, $emailId, $sendMail);
				session_unset();
				$_SESSION['passchange'] = true;
				$result[] = array("error" => "PASSCHANGE");
			} else {
				$result[] = array("error" => "ERROR");
			}
		} else {
			$result[] = array("error" => "INVALIDOTP");
		}
	}
	header("content-type: application/json"); //this
	echo json_encode($result); //this}
}

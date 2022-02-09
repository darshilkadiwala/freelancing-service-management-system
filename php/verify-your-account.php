<?php
session_start();
require_once './config.php';
require_once './constants.php';
require_once './functions.php';
require_once "./phpmailer/Exception.php";
require_once "./phpmailer/PHPMailer.php";
require_once "./phpmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = array(); //this
	$email = $username = "";
	$emailErr = $usernameErr = true;
	// check old password
	if (empty($_POST["txtEmail"])) {
		$result[] = array("error" => REQEMAIL);
	} else {
		$email = test_input($_POST["txtEmail"]);
		if (!preg_match(MATCHEMAIL, $email)) {
			$result[] = array("error" => INVALIDEMAIL);
		} else {
			$emailErr = false;
		}
	}
	if (empty($_POST["txtUsername"])) {
		$result[] = array("error" => REQUSERNAME);
	} else {
		$username = test_input($_POST["txtUsername"]);
		if (!preg_match(MATCHUSERNAME, $username)) {
			$result[] = array("error" => INVALIDUSERNAME);
		} else {
			$usernameErr = false;
		}
	}
	if (!$emailErr && !$usernameErr) {
		if (isset($_POST['txtEmail']) && isset($_POST['txtUsername'])  && (!(empty($_POST['txtEmail']) && empty($_POST['txtUsername'])))) {
			$sqlSelectEmail = "SELECT `FirstName`, `LastName` FROM `tbluserpersonaldetails` WHERE `Email`= '{$email}' AND `Username`='{$username}'";
			$query = mysqli_query($dbConn, $sqlSelectEmail);
			if (mysqli_num_rows($query) == 1) {
				$row = mysqli_fetch_assoc($query);
				$subject = "OTP for Verifying your Account !!!";
				$otp = genrateOTP();
				$messageBody = "<h3>Hello Dear {$row['FirstName']} {$row['LastName']} please verify your email address</h3>
				<h3>OTP for Verifying your Account : <b style=\"color:blue\">$otp</b></h3>";
				$sendMail = new PHPMailer();
				if (sendEmail($subject, $messageBody, $email, "{$row['FirstName']} {$row['LastName']}", $sendMail)) {
					$_SESSION['OTP'] = (int) $otp;
					$result[] = array("error" => "OTPSENT");
				} else {
					$result[] = array("error" => "OTP can\'t sent :  Internal Server Error Please try later...");
					session_unset();
				}
			} else {
				$result[] = array("error" => "Invalid Email id or Username");
			}
		}
	}
	header("content-type: application/json"); //this
	echo json_encode($result); //this
}

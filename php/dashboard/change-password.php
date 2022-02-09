<?php
session_start();
require_once '../config.php';
require_once '../constants.php';
require_once '../functions.php';
require_once "../phpmailer/Exception.php";
require_once "../phpmailer/PHPMailer.php";
require_once "../phpmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = array();
	if (isset($_POST['txtConfirmNewPasswd'])) {
		$oldpassword =  $newpassword =  $confnewpassword = "";
		$oldpasswordErr = $newpasswordErr = $confnewpasswordErr = true;
		// check old password
		if (empty($_POST["txtOldPasswd"])) {
			$result[] = array("error" => "Old Password is Required");
		} else {
			$oldpassword = test_input($_POST["txtOldPasswd"]);
			if (!preg_match(MATCHPASSWORD, $oldpassword)) {
				$result[] = array("error" => ERRORPASSWORD);
				$oldpasswordErr = true;
			} else {
				$oldpasswordErr = false;
			}
		}

		// check new password
		if (empty($_POST["txtNewPasswd"])) {
			$result[] = array("error" => "New Password is Required");
		} else {
			$newpassword = test_input($_POST["txtNewPasswd"]);
			if (!preg_match(MATCHPASSWORD, $newpassword)) {
				$result[] = array("error" => ERRORPASSWORD);
				$newpasswordErr = true;
			} else {
				$newpasswordErr = false;
			}
		}

		// check confirm new password
		if (empty($_POST["txtConfirmNewPasswd"])) {
			$result[] = array("error" => "Confirm Password is Required");
		} else {
			$confnewpassword = test_input($_POST["txtConfirmNewPasswd"]);
			if (!preg_match(MATCHPASSWORD, $confnewpassword)) {
				$result[] = array("error" => ERRORPASSWORD);
				$confnewpasswordErr = true;
			} else {
				$confnewpasswordErr = false;
			}
		}

		// check both password & confirm password are same
		if (!(empty($_POST["txtNewPasswd"]) && empty($_POST["txtConfirmNewPasswd"]))) {
			$newpassword = test_input($_POST["txtNewPasswd"]);
			$confnewpassword = test_input($_POST["txtConfirmNewPasswd"]);
			if ($newpassword !== $confnewpassword) {
				$result[] = array("error" => "Password are not matching. Both password must be same");
				$newpasswordErr = true;
				$confnewpasswordErr = true;
			} else {
				$newpasswordErr = false;
				$confnewpasswordErr = false;
			}
		}
		if (!$confnewpasswordErr && !$newpasswordErr && !$oldpasswordErr) {
			if (isset($_POST['txtOldPasswd']) && isset($_POST['txtNewPasswd'])  && isset($_POST['txtConfirmNewPasswd']) && (!(empty($_POST['txtOldPasswd']) && empty($_POST['txtNewPasswd'])  && empty($_POST['txtConfirmNewPasswd'])))) {
				$user = $_SESSION['Username'];
				$userId = $_SESSION['UserID'];
				$role = $_SESSION['RoleID'];
				$table = "";
				if ($role === 1) {
					$table = "tbladmin";
				} else if ($role > 1 && $role < 4) {
					$table = "tbluserpersonaldetails";
				}
				$sqlSelect = "SELECT `Username`, `Email` FROM `$table` WHERE `Username`= '$user' AND `UserID`= '$userId' AND `Password`=MD5('$oldpassword')";
				$query = mysqli_query($dbConn, $sqlSelect);
				if (mysqli_num_rows($query) == 1) {
					$sqlChangePass = "UPDATE `$table` SET `Password`=MD5('$newpassword') WHERE `UserID`='$userId' AND `Username`='$user' AND `Password`=MD5('$oldpassword')";
					$passUpdate = mysqli_query($dbConn, $sqlChangePass);
					if ($passUpdate) {
						$row = mysqli_fetch_assoc($query);
						$emailId = $row['Email'];
						$subject = "Your Password changed Successfully !!!";
						$messageBody = "<h1>You have recently changed password of your FSMS account : {$_SESSION['Username']} </h1><br/><h3><b style=\"color:red\">If you had not done this 🤷🏼‍♂️🤷🏼‍♂️ try to change password or contact us or mail us</b></h3><br/>If you done this ignore it.👍👍";
						$sendMail = new PHPMailer();
						sendEmail($subject, $messageBody, $emailId, $emailId, $sendMail);
						session_unset();
						$result[] = array("error" => "PASSCHANGE");
						$_SESSION['passchange'] = true;
					} else {
						$result[] = array("error" => "ERROR");
						// echo 'Sorry, You can\'t change password at now.<br/>Please try later...';
					}
				} else {
					// echo 'Invalid password';
					$result[] = array("error" => "INVALIDPASS");
				}
			} else {
				$result[] = array("error" => REQALL);
			}
		}
	}
	header("content-type:application/json");
	echo json_encode($result);
}

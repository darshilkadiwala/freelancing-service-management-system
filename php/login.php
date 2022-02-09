<?php
require_once "./config.php";
require_once './constants.php';
require_once './functions.php';
require_once "./phpmailer/Exception.php";
require_once "./phpmailer/PHPMailer.php";
require_once "./phpmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
session_unset();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$result = array(); //this
	if (isset($_POST['txtUsername']) && isset($_POST['txtPasswd']) && (!empty($_POST['txtUsername'])) && (!empty($_POST['txtPasswd']))) {
		$Username = test_input($_POST['txtUsername']);
		$Password = test_password_input($_POST['txtPasswd']);
		$table = "tbluserpersonaldetails";
		$sqlSelect = "SELECT `UserID`, `Username`, `RoleID`, `AccountStatus`, `isEmailVerified`,`Email` FROM `$table` WHERE `Username`= '$Username' AND `Password`= MD5('$Password')";
		$query = mysqli_query($dbConn, $sqlSelect);
		if ($query) {
			if (mysqli_num_rows($query) > 0) {
				$row = mysqli_fetch_array($query);
				if ($row['AccountStatus'] == 'B') {
					$result[] = array("error" => "blocked");
				} else if ($row['AccountStatus'] == 'R') {
					$result[] = array("error" => "rejected");
				} else if ($row['isEmailVerified'] == 'N') {
					$result[] = array("error" => "notVerified");
					$_SESSION['UserID'] = (int) $row['UserID'];
					$_SESSION['Username'] = $row['Username'];
					$_SESSION['RoleID'] = (int) $row['RoleID'];
					$_SESSION['Email'] = $row['Email'];
					$_SESSION['needVerify'] = true;
				} else if ($row['AccountStatus'] == 'A' && $row['isEmailVerified'] == 'Y') {
					$_SESSION['UserID'] = (int) $row['UserID'];
					$_SESSION['Username'] = $row['Username'];
					$_SESSION['RoleID'] = (int) $row['RoleID'];
					$_SESSION['Email'] = $row['Email'];
					$_SESSION['isLoggedIn'] = true;
				} else if ($row['AccountStatus'] == 'P') {
					$result[] = array("error" => "pending");
				}
			} else {
				global $table;
				$table = "tbladmin";
				$sqlSelect = "SELECT `UserID`, `Username`,`RoleID`,`Email` FROM `$table` WHERE `Username`= '$Username' AND `Password`= MD5('$Password')";
				$query = mysqli_query($dbConn, $sqlSelect);
				if ($query) {
					if (mysqli_num_rows($query) > 0) {
						$row = mysqli_fetch_array($query);
						$_SESSION['UserID'] = (int)  $row['UserID'];
						$_SESSION['Username'] = $row['Username'];
						$_SESSION['RoleID'] = (int) $row['RoleID'];
						$_SESSION['Email'] = $row['Email'];
						$_SESSION['isLoggedIn'] = true;
					} else {
						$result[] = array("error" => ERRORUSERNAMEPASSWORD);
					}
				} else {
					// echo ERRORUSERNAMEPASSWORD;
					$result[] = array("error" => ERRORUSERNAMEPASSWORD);
				}
			}
			if (!(isset($_SESSION['needVerify']) && $_SESSION['needVerify'] === true)) {
				if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
					$sqlUpdateStatus = "UPDATE `$table` SET `UserStatus`='1' WHERE `UserID`='{$_SESSION['UserID']}' AND `Username`= '{$_SESSION['Username']}'";
					$query = mysqli_query($dbConn, $sqlUpdateStatus);
					if ($query) {
						$subject = "New Login Found !!!";
						$messageBody = "<h1>Welcome {$_SESSION['Username']} to FSMS</h1><br/>You have successfully Login to system.<br/>If you had not do this please contact us or change password.";
						$emailID = $_SESSION['Email'];
						$sendMail = new PHPMailer();
						if (!sendEmail($subject, $messageBody, $emailID, $emailID, $sendMail)) {
							$_SESSION['isLoggedIn'] = false;
							$result[] = array("error" => "Internal Server error please try later... 111 {$_SESSION['UserID']}");
							session_unset();
						} else {
							$result[] = array(
								"id" => "error",
								"value" => "1"
							);
							$result[] = array(
								"id" => "link",
								"value" => $_SESSION['RoleID']
							);
						}
					} else {
						session_unset();
						$result[] = array("error" => "Internal Server error please try later...");
					}
				}
			}
		} else {
			$result[] = array(
				"error" => ERRORUSERNAMEPASSWORD
			);
		}
	} else {
		$result[] = array(
			"error" => REQALL
		);
	}
	header("content-type: application/json"); //this
	echo json_encode($result); //this
}

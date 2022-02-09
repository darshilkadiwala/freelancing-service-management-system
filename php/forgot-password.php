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
    if (empty($_POST["txtEmail"])) {
        // echo REQEMAIL;
        $result[] = array("error" => REQEMAIL);
    } else {
        $email = test_input($_POST["txtEmail"]);
        // check if e-mail address is well-formed
        if (!preg_match(MATCHEMAIL, $email)) {
            // echo ERROREMAIL;
            $result[] = array("error" => ERROREMAIL);
        } else {
            $sqlSelectEmail = "SELECT `UserID`, `Username`, `Password`, `RoleID`, `Email` FROM `tbluserpersonaldetails` WHERE `Email`= '$email'";
            $query = mysqli_query($dbConn, $sqlSelectEmail);
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_array($query);
                $_SESSION['UserID'] = (int)  $row['UserID'];
                // $_SESSION['Email'] = $email;
                $_SESSION['RoleID'] = $row['RoleID'];
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['sendOTP'] = true;
                $_SESSION['EmailId'] = $email;
            } else {
                $sqlSelectEmail = "SELECT `UserID`, `Username`, `RoleID`, `Email` FROM `tbladmin` WHERE `Email`= '$email'";
                $query = mysqli_query($dbConn, $sqlSelectEmail);
                if (mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_array($query);
                    $_SESSION['UserID'] = (int)  $row['UserID'];
                    $_SESSION['Username'] = $row['Username'];
                    $_SESSION['RoleID'] = (int) $row['RoleID'];
                    // $_SESSION['Email'] = $row['Email'];
                    $_SESSION['sendOTP'] = true;
                    $_SESSION['EmailId'] = $email;
                } else {
                    session_unset();
                    $result[] = array("error" => INVALIDEMAIL);
                }
            }
        }
    }
    if (isset($_SESSION['sendOTP']) && $_SESSION['sendOTP'] == true) {
        $subject = "OTP for Reset your password!!!";
        $otp = genrateOTP();
        $messageBody = "<h1>OTP for change/reset your password for : " . $_SESSION['Username'] . " </h1><br/><h3>Your OTP for reset our password : <b style=\"color:blue\">$otp</b></h3><br/>If you had not do this ignore it.";
        $emailID = $_SESSION['EmailId'];
        // if (isset($_SESSION['isLoginMailSent']) && $_SESSION['isLoginMailSent'] === true) {
        $sendMail = new PHPMailer();
        if (sendEmail($subject, $messageBody, $emailID, $emailID, $sendMail)) {
            $_SESSION['isEmailVerify'] = true;
            $_SESSION['isResetPassOTPSent'] = true;
            $_SESSION['OTP'] = (int) $otp;
            $result[] = array("error" => "OTPsent");
        } else {
            $result[] = array("error" => "Email can\'t sent :  Internal Server Error Please try later...");
            session_unset();
        }
    }
    header("content-type: application/json"); //this
    echo json_encode($result); //this
}

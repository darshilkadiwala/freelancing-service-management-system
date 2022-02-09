<?php
require_once "./config.php";
require_once "./functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $object = array();
    $requestType = $_POST['requestType'];
    // echo $requestType;
    if ($requestType == "checkEmail") {
        if (isset($_POST['email'])) {
            $emailId = $_POST['email'];
            $result = mysqli_query($dbConn, "SELECT `Email` FROM `tbluserpersonaldetails` WHERE `tbluserpersonaldetails`.`Email`='{$emailId}'");
            if (mysqli_num_rows($result) > 0) {
                $object[] = array("error" =>  "This email id is already registered use another email id!!!");
            } else {
                $result = mysqli_query($dbConn, "SELECT `Email` FROM `tbladmin` WHERE `tbladmin`.`Email`='{$emailId}'");
                if (mysqli_num_rows($result) > 0) {
                    $object[] = array("error" =>  "This email id is already registered use another email id!!!");
                } else {
                    $object = array("error" => "0");
                }
            }
        }
    }
    if ($requestType == "checkUsername") {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $result = mysqli_query($dbConn, "SELECT `Username` FROM `tbluserpersonaldetails` WHERE `tbluserpersonaldetails`.`Username`='{$username}'");
            if (mysqli_num_rows($result) > 0) {
                $object[] = array("error" =>  "This Username is already registered use another Username");
            } else {
                $result = mysqli_query($dbConn, "SELECT `Username` FROM `tbladmin` WHERE `tbladmin`.`Username`='{$username}'");
                if (mysqli_num_rows($result) > 0) {
                    $object[] = array("error" =>  "This Username is already registered use another email id!!!");
                } else {
                    $object = array("error" => "0");
                }
            }
        }
    }
    if ($requestType == "checkContactNo") {
        if (isset($_POST['contactno'])) {
            $contactno = test_input($_POST['contactno']);
            $sqlSelectContactNo = "SELECT `ContactNo` FROM `tbluserpersonaldetails` WHERE `tbluserpersonaldetails`.`ContactNo`='{$contactno}'";
            if (isset($_POST['exceptID'])) {
                $exceptID = test_input($_POST['exceptID']);
                $sqlSelectContactNo .= " AND `UserID` NOT IN ({$exceptID})";
            }
            $result = mysqli_query($dbConn, $sqlSelectContactNo);
            if (mysqli_num_rows($result) > 0) {
                $object[] = array("error" =>  "This Contact number is already registered use another Contact number");
            } else {
                $object[] = array("error" => "0");
            }
        }
    }
    header("content-type: application/json");
    echo json_encode($object);
}

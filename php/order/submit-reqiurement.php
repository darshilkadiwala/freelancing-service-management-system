<?php
require_once '../config.php';
$result = array();
if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['OrderID']) && isset($_POST['txtAboutOrder']) && isset($_POST['txtRequirement'])) {
		$sqlInsertReq = "INSERT INTO `tblorderrequirement`(`OrderID`, `AboutOrder`, `Requirement`) VALUES ({$_POST['OrderID']},'{$_POST['txtAboutOrder']}','{$_POST['txtRequirement']}')";
		if (isset($_FILES['ReqImg']['name'])) {
			$ReqImg = $_FILES['ReqImg']['tmp_name'];
			$ReqImg = addslashes(file_get_contents($ReqImg));
			$sqlInsertReq = "INSERT INTO `tblorderrequirement`(`OrderID`, `AboutOrder`, `Requirement`, `ReqFile`) VALUES ({$_POST['OrderID']},'{$_POST['txtAboutOrder']}','{$_POST['txtRequirement']}','$ReqImg')";
		}
		$queryInsertReq = mysqli_query($dbConn, $sqlInsertReq);
		if ($queryInsertReq) {
			$sqlUpdateReqStatus = "UPDATE `tblorderdetails` SET `RequirementStatus`='S' WHERE `OrderID`= {$_POST['OrderID']}";
			$queryUpdateReqStatus = mysqli_query($dbConn, $sqlUpdateReqStatus);
			$result[] = array("error" => "1");
		}
		header("content-type: application/json"); //this
		echo json_encode($result); //this
	}
}

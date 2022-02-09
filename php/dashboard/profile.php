<?php
session_start();
require_once "../config.php";
require_once "../functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$result = array();
	$requestType = "";
	if (isset($_POST['requestType'])) {
		$requestType = $_POST['requestType'];
		// echo $requestType;
	}
	if ($requestType == 'FetchAll') {
		$sqlSelectDetails = "SELECT `tbluserpersonaldetails`.*, `tblcity`.*, `tblstate`.*, `tblfreelancerprofessionaldetails`.* FROM `tbluserpersonaldetails` LEFT JOIN `tblcity` ON `tbluserpersonaldetails`.`CityID` = `tblcity`.`CityID` LEFT JOIN `tblstate` ON `tblcity`.`StateID` = `tblstate`.`StateID` LEFT JOIN `tblfreelancerprofessionaldetails` ON `tblfreelancerprofessionaldetails`.`FreelancerID` = `tbluserpersonaldetails`.`UserID` WHERE `tbluserpersonaldetails`.`UserID`={$_SESSION['UserID']};";
		$resultSelectDetails = mysqli_query($dbConn, $sqlSelectDetails);
		if ($resultSelectDetails) {
			while ($row = mysqli_fetch_assoc($resultSelectDetails)) {
				$result[] = array(
					"id" => "UserID",
					"value" => $row['UserID']
				);
				$result[] = array(
					"id" => "FirstName",
					"value" => $row['FirstName']
				);
				$result[] = array(
					"id" => "LastName",
					"value" => $row['LastName']
				);
				$result[] = array(
					"id" => "Username",
					"value" => $row['Username']
				);
				$result[] = array(
					"id" => "Email",
					"value" => $row['Email']
				);
				$result[] = array(
					"id" => "ContactNo",
					"value" => $row['ContactNo']
				);
				$result[] = array(
					"id" => "Gender",
					"value" => $row['Gender']
				);
				$result[] = array(
					"id" => "DateOfBirth",
					"value" => $row['DateOfBirth']
				);
				$result[] = array(
					"id" => "Address",
					"value" => $row['Address']
				);
				$result[] = array(
					"id" => "Pincode",
					"value" => $row['Pincode']
				);
				$result[] = array(
					"id" => "DateOfJoining",
					"value" => $row['DateOfJoining']
				);
				$result[] = array(
					"id" => "ProfilePicture",
					"value" => base64_encode($row['ProfilePicture'])
				);
				$result[] = array(
					"id" => "AccountStatus",
					"value" => $row['AccountStatus']
				);
				$result[] = array(
					"id" => "CityID",
					"value" => $row['CityID']
				);
				$result[] = array(
					"id" => "StateID",
					"value" => $row['StateID']
				);
				$result[] = array(
					"id" => "CityName",
					"value" => $row['CityName']
				);
				$result[] = array(
					"id" => "StateName",
					"value" => $row['StateName']
				);
				$result[] = array(
					"id" => "UserStatus",
					"value" => $row['UserStatus']
				);
			}
		} else {
			$result[] = array("error" => "No record found");
		}
	} else if ($requestType == 'update-user-info') {
		if ((isset($_POST['txtFname']) && !empty($_POST['txtFname'])) && (isset($_POST['txtLname']) && !empty($_POST['txtLname'])) && (isset($_POST['rbtnlistGender']) && !empty($_POST['rbtnlistGender'])) && (isset($_POST['txtDob']) && !empty($_POST['txtDob']))) {
			$FirstName = test_input(ucwords($_POST['txtFname']));
			$LastName = test_input(ucwords($_POST['txtLname']));
			$Gender = test_input($_POST['rbtnlistGender']);
			if ($Gender == "Male") {
				$Gender = "M";
			} else if ($Gender == "Female") {
				$Gender = "F";
			}
			$DateOfBirth = test_input($_POST['txtDob']);
			$sqlUpdate = "UPDATE `tbluserpersonaldetails` SET `FirstName`='{$FirstName}',`LastName`='{$LastName}',`Gender`='{$Gender}',`DateOfBirth`='{$DateOfBirth}' WHERE `UserID`={$_SESSION['UserID']}";
			$queryUpdate = mysqli_query($dbConn, $sqlUpdate);
			if ($queryUpdate) {
				$result[] = array("error" => "1");
			} else {
				$result[] = array("error" => $sqlUpdate);
			}
		} else {
			$result[] = array("error" => "No record found");
		}
	} else {
		$result[] = array("error" => "No record found");
	}
	header("content-type: application/json");
	echo json_encode($result);
}

<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
	header("Location: /FSMS/Login.php");
} else {
	require '../../php/config.php';
	require '../../php/constants.php';
	require '../../php/functions.php';
	// $result = array(); //this
	if (isset($_GET['cid']) && (!empty($_GET['cid']))) {
		$categoryId = test_input($_GET['cid']);
		$role = $_SESSION['RoleID'];
		if ($role === 1) {
			$sqlUpdateCat = "UPDATE `tblservicecategories` SET `CategoryStatus`='A'  WHERE `ServiceCategoryID`='{$categoryId}'";
			$query = mysqli_query($dbConn, $sqlUpdateCat);
			if ($query) {
				echo "1";
			} else {
				echo $sqlUpdateCat;
			}
		}
	} else {
		echo "All fields are required";
	}
	header("Location:./"); //this
}

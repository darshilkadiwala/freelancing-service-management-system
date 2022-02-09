<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$result = array();
	if (isset($_POST['requestType']) && $_POST['requestType'] == "getCustomerID") {
		$result[] = array(
			"id" => "CUSTID",
			"value" => $_SESSION['UserID']
		);
	}
	header("content-type: application/json"); //this
	echo json_encode($result); //this
} else {
	header("Location:/FSMS/");
}

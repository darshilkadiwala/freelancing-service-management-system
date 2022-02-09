<?php
require '../../config.php';
require '../../constants.php';
require '../../functions.php';
$result = array(); //this
$uid = "";
$requestType = "";
$accountStatus = '';
if (isset($_POST['uid']) && (!empty($_POST['uid']))) {
    if (isset($_POST['requestType']) && (!empty($_POST['requestType']))) {
        $requestType = test_input($_POST['requestType']);
        $uid = test_input($_POST['uid']);
    }
    $accountStatus= $requestType == "B" ? "Block" : ($requestType == "A" ? "Active" : ($requestType == "R" ? "Rejected" : ($requestType == "C" ? "Closed" : ($requestType == "P" ? "Pending" : "")))); 
    if ($accountStatus != '') {
        $sqlUpdateAccontStatus = "UPDATE `tbluserpersonaldetails` SET `AccountStatus`='{$accountStatus}' WHERE (`AccountStatus`='P' OR `AccountStatus`='A') AND `UserID`={$uid}";
        $query = mysqli_query($dbConn, $sqlUpdateAccontStatus);
        if ($query) {
            $result[] = array("error" => "1");
        } else {
            $result[] = array("error" => "Internal Server error...");
        }
    } else {
        $result[] = array("error" => "Internal Server error...");
    }
} else {
    $result[] = array("error" => "No user selected..");
}
header("content-type: application/json"); //this
echo json_encode($result); //this
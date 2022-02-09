<?php
require_once "./config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $requestType = $_POST['requestType'];
    // echo $requestType;
    if ($requestType == "getStates") {
        $result = mysqli_query($dbConn, "SELECT * FROM `tblState` ORDER BY `tblState`.`StateName`");
        $object = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $object[] = array(
                "id" =>  $row["StateID"],
                "state" => $row["StateName"]
            );
        }
        header("content-type: application/json");
        echo json_encode($object);
    } else if ($requestType == "getCities") {
        $result = mysqli_query($dbConn, "SELECT * FROM `tblCity` WHERE `tblCity`.`StateID`={$_POST["id"]} ORDER BY `tblCity`.`CityName` ");
        $object = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $object[] = array(
                "id" =>  $row["CityID"],
                "city" => $row["CityName"]
            );
        }
        header("content-type: application/json");
        echo json_encode($object);
    }
}

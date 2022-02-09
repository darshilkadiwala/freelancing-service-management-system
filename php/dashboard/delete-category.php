<?php
session_start();
require '../config.php';
require '../constants.php';
require '../functions.php';
$result = array(); //this
if (isset($_POST['categoryId']) && (!empty($_POST['categoryId']))) {
    $categoryId = test_input($_POST['categoryId']);
    $role = $_SESSION['RoleID'];
    if ($role === 1) {
        $sqlUpdateCat = "UPDATE `tblservicecategories` SET `CategoryStatus`='D'  WHERE `ServiceCategoryID`='{$categoryId}'";
        $query = mysqli_query($dbConn, $sqlUpdateCat);
        if ($query) {
            $result[] = array("error" => "1");
        } else {
            $result[] = array("error" => $sqlUpdateCat);
        }
    }
} else {
    $result[] = array("error" => "All fields are required");
}
header("content-type: application/json"); //this
echo json_encode($result); //this
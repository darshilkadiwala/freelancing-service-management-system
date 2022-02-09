<?php
session_start();
require '../config.php';
require '../constants.php';
require '../functions.php';

$result = array(); //this
if (isset($_POST['categoryName']) && isset($_POST['categoryDesc']) && isset($_POST['categoryId']) && (!(empty($_POST['categoryName']) && empty($_POST['categoryDesc']) && empty($_POST['categoryId'])))) {
    $categoryName = test_input($_POST['categoryName']);
    $categoryDesc = test_input($_POST['categoryDesc']);
    $categoryId = test_input($_POST['categoryId']);
    $role = $_SESSION['RoleID'];
    if ($role === 1) {
        $sqlFindCategory = "SELECT * FROM `tblservicecategories` WHERE `ServiceCategoryName` LIKE '$categoryName'";
        $query = mysqli_query($dbConn, $sqlFindCategory);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $result[] = array("error" => "This category already exists: <b><i> {$row['ServiceCategoryName']}</i></b>");
                }
            } else {
                $sqlUpdateCat = "UPDATE `tblservicecategories` SET `ServiceCategoryName`='{$categoryName}',`ShortDescription`='{$categoryDesc}' WHERE `ServiceCategoryID`='{$categoryId}'";
                $query = mysqli_query($dbConn, $sqlUpdateCat);
                if ($query) {
                    $result[] = array("error" => "1");
                } else {
                    $result[] = array("error" => $sqlUpdateCat);
                }
            }
        }
    }
} else {
    $result[] = array("error" => "All fields are required");
}
header("content-type: application/json"); //this
echo json_encode($result); //this
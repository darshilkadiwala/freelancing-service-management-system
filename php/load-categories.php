<?php
require_once "./config.php";
require_once "./functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $requestType = $_POST['requestType'];
    // echo $requestType;
    if ($requestType == "getCategories") {
        $result = mysqli_query($dbConn, "SELECT * FROM `tblservicecategories` ORDER BY `tblservicecategories`.`ServiceCategoryName`");
        $object = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $object[] = array(
                "id" =>  $row["ServiceCategoryID"],
                "category" => $row["ServiceCategoryName"]
            );
        }
        header("content-type: application/json");
        echo json_encode($object);
    } else if ($requestType == "getSubCategories") {
        $result = mysqli_query($dbConn, "SELECT * FROM `tblservicesubcategories` WHERE `tblservicesubcategories`.`ServiceCategoryID`='" . $_POST["id"] . "' ORDER BY `tblservicesubcategories`.`SubcategoryName` ");
        $object = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $object[] = array(
                "id" =>  $row["ServiceSubcategoryID"],
                "subCategory" => $row["SubcategoryName"]
            );
        }
        header("content-type: application/json");
        echo json_encode($object);
    }
}

<?php
session_start();
require './config.php';
require './constants.php';
require './functions.php';

$firstnameErr = $lastnameErr = $usernameErr = $passwordErr = $emailErr = $contactnumErr = $genderErr = $dateofbirthErr = $addressErr = $pincodeErr = $profilepicErr = $confpasswordErr = "";
$firstname = $lastname = $username = $confpassword = $password = $email = $contactnum = $gender = $dateofbirth = $address = $pincode = $profilepic = "";
$errorMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = array();
    $RoleId = 3;
    $userid=$_SESSION['UserID'];
    $Servicetitle = test_input($_POST['txtServicetitle']);
    $ShortDescription = test_input($_POST['txtShortDescription']);
    $AboutService = test_input($_POST['txtAboutService']);
    $ServiceSubcategoryID = (int)test_input($_POST['drpdlistSubCategory']);
    $ServiceType = test_input($_POST['drpdlistServiceType']);
    $txtDeliveryDays = (int) test_input($_POST['txtDeliveryDays']);
    if (isset($_FILES['imgServiceImg']['name'])) {
        $imgService = $_FILES['imgServiceImg']['tmp_name'];
        $imgServiceImg = addslashes(file_get_contents($imgService));
        $sqlAddService = "INSERT INTO `tblservicedetail` (`FreelancerID`, `ServiceSubcategoryID`, `ServiceType`, `ServiceTitle`, `ShortDescription`, `About`, `FileFormats`, `DeliveryDays`, `ServiceImage`) VALUES ('{$userid}', '{$ServiceSubcategoryID}', '{$ServiceType}', '{$Servicetitle}', '{$ShortDescription}', '{$AboutService}', 'zip', '{$txtDeliveryDays}','{$imgServiceImg}')";
        $queryAddService = mysqli_query($dbConn, $sqlAddService);
        if ($queryAddService) {
            // $sqlSelectServiceID = "SELECT `ServiceID` FROM `tblservicedetail` WHERE `FreelancerID`={$_SESSION['UserID']} ORDER BY `ServiceID` DESC LIMIT 1";
            // $querySelectServiceID = mysqli_query($dbConn, $sqlSelectServiceID);
            // if ($querySelectServiceID) {
            //     while ($row = mysqli_fetch_array($querySelectServiceID)) {
            //         $sqlAddServiceImg = "INSERT INTO `tblserviceimages` (`ServieID`, `ServieImage`) VALUES ({$row['ServieID']},'$imgServiceImg'";
            //         $queryAddServiceImg = mysqli_query($dbConn, $sqlAddServiceImg);
            //         if ($queryAddServiceImg) {
            $result[] = array("error" => "1");
            //         }
            //     }
            // }
        } else {
            $result[] = array("error" => $sqlAddService);
        }
        // }
    } else {
        $result[] = array("error" => "Please select service image...");
    }
    header("content-type: application/json"); //this
    echo json_encode($result); //this

}

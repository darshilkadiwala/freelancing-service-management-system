<?php session_start();
require './php/config.php';
if (isset($_SESSION['UserID']) && isset($_SESSION['Username']) && isset($_SESSION['RoleID'])) {
    $userid = $_SESSION['UserID'];
    $username = $_SESSION['Username'];
    $role = $_SESSION['RoleID'];
    $table = "";
    if ($role == 1) {
        $table = "tbladmin";
    } else if ($role > 1 && $role < 4) {
        $table = "tbluserpersonaldetails";
    }
    if ($table != "") {
        $sqlUpdateStatus = "UPDATE `$table` SET `UserStatus`='0' WHERE `UserID`='$userid' AND `Username`= '$username' AND `RoleID`='$role'";
        $query = mysqli_query($dbConn, $sqlUpdateStatus);
    }
}
session_unset();
session_destroy();
header("Location: /FSMS/");

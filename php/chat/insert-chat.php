<?php
session_start();
if (isset($_SESSION['UserID'])) {
    require_once '../config.php';
    $outgoing_id = $_SESSION['UserID'];
    $incoming_id = mysqli_real_escape_string($dbConn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($dbConn, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($dbConn, "INSERT INTO `tblmessage` (`ReceiveID`, `SenderID`, `Message`) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die("Internal Error");
    }
} else {
    header("location: /FSMS/Login.php");
}

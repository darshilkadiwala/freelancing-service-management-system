<?php
session_start();
require_once "../config.php";

$output = "";
$sessionUserID = $_SESSION['UserID'];
$sqlGetChatUserList = "SELECT `tblmessage`.`SenderID`,`tblmessage`.`ReceiveID` FROM `tblmessage` WHERE `SenderID`={$sessionUserID} OR `ReceiveID`={$sessionUserID} ORDER BY MessageID DESC";
$queryGetChatUserList = mysqli_query($dbConn, $sqlGetChatUserList);

if ($queryGetChatUserList) {
    $chatUserList = array();
    while ($row = mysqli_fetch_assoc($queryGetChatUserList)) {
        if (!in_array($row['SenderID'], $chatUserList)) {
            if (!in_array($row['ReceiveID'], $chatUserList)) {

                if ($row['SenderID'] != $sessionUserID) {
                    array_push($chatUserList, $row['SenderID']);
                } else if ($row['ReceiveID'] != $sessionUserID) {
                    array_push($chatUserList, $row['ReceiveID']);
                }

                $sqlGetUserData = "SELECT `UserID`, `FirstName`, `LastName`, `Username`, `ProfilePicture`, `UserStatus` FROM `tbluserpersonaldetails` WHERE ";

                if ($row['SenderID'] == $sessionUserID) {
                    $sqlGetUserData .= "`UserID`=" . $row['ReceiveID'];
                } else if ($row['ReceiveID'] == $sessionUserID) {
                    $sqlGetUserData .= "`UserID`=" . $row['SenderID'];
                }
                $queryGetChatUserData = mysqli_query($dbConn, $sqlGetUserData);

                if ($queryGetChatUserData && mysqli_num_rows($queryGetChatUserData) > 0) {
                    $rowGetChatUserData = mysqli_fetch_assoc($queryGetChatUserData);

                    $sqlGetLastMsg = "SELECT `tblmessage`.`Message` FROM `tblmessage` WHERE (`SenderID`={$rowGetChatUserData['UserID']} AND `ReceiveID`={$sessionUserID}) OR (`SenderID`={$sessionUserID} AND `ReceiveID`={$rowGetChatUserData['UserID']}) ORDER BY MessageID DESC LIMIT 1";
                    $queryGetLastMsg = mysqli_query($dbConn, $sqlGetLastMsg);

                    if ($queryGetLastMsg && mysqli_num_rows($queryGetLastMsg) > 0) {
                        $rowGetLastMsg = mysqli_fetch_assoc($queryGetLastMsg);

                        $msg = $rowGetLastMsg['Message'];
                        $msg = strlen($msg) > 23 ?  substr($msg, 0, 23) . '...' :  $msg;
                        $msg = ($row['SenderID'] == $sessionUserID) ? "You: " . $msg : $msg;
                        $status = ($rowGetChatUserData['UserStatus'] == 0) ? "offline" : "";
                        $output .= '<a href="users.php?rname=' . $rowGetChatUserData['Username'] . '">
                                        <div class="content">
                                            <img src="data:image;base64,' . base64_encode($rowGetChatUserData['ProfilePicture']) . '" width="50px" alt="Profile">
                                            <div class="details">
                                                <span>' . $rowGetChatUserData['FirstName'] . " " . $rowGetChatUserData['LastName'] . '</span>
                                                <p>' . $msg . '</p>
                                            </div>
                                        </div>
                                        <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
                                    </a>';
                    }
                }
            }
        }
    }
}
if ($output == "")
    $output = $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
echo $output;

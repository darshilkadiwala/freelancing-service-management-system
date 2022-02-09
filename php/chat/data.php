<?php


while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM `tblmessage` WHERE `SenderID` = {$row['UserID']} ORDER BY MessageID DESC LIMIT 1";
    $query2 = mysqli_query($dbConn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['Message'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['ReceiveID'])) {
        ($outgoing_id == $row2['ReceiveID']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    $offline = ($row['UserStatus'] == 0) ? "offline" : "";
    ($outgoing_id == $row['UserID']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="users.php?rname=' . $row['Username'] . '">
                    <div class="content">
                    <img src="data:image;base64,' . base64_encode($row['ProfilePicture']) . '" width="50px" alt="Profile">
                    <div class="details">
                        <span>' . $row['FirstName'] . " " . $row['LastName'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}

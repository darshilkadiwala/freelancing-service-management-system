<?php
// session_start();
// if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['UserID'])) {
//     require_once '../config.php';
//     $outgoing_id = $_SESSION['UserID'];
//     $incoming_id = mysqli_real_escape_string($dbConn, $_POST['incoming_id']);
//     $result = array();
//     $sql = "SELECT * FROM `tblmessage` LEFT JOIN `tbluserpersonaldetails` ON `tblmessage`.`ReceiveID`=`tbluserpersonaldetails`.`UserID` WHERE (`ReceiveID` = {$outgoing_id} AND `SenderID` = {$incoming_id}) OR (`ReceiveID` = {$incoming_id} AND `SenderID` = {$outgoing_id}) ORDER BY `MessageID`";
//     $query = mysqli_query($dbConn, $sql);
//     if (mysqli_num_rows($query) > 0) {
//         while ($row = mysqli_fetch_assoc($query)) {
//             if ($row['ReceiveID'] === $outgoing_id) {
//                 $result[] = array(
//                     "id" => "outgoing",
//                     "message" => '<div class="chat outgoing">
//                                     <div class="details">
//                                         <p>' . $row['Message'] . '</p>
//                                     </div>
//                                 </div>'
//                 );
//             } else {
//                 $result[] = array(
//                     "id" => "incoming",
//                     "message" => '<div class="chat incoming">
//                                     <div class="details">
//                                         <p>' . $row['Message'] . '</p>
//                                     </div>
//                                 </div>',
//                     "profile" => base64_encode($row['ProfilePicture'])
//                 );
//             }
//         }
//     } else {
//         $result[] = array(
//             "id" => "0",
//             "message" => '<div class="text">No messages are available. Once you send message they will appear here.</div>'
//         );
//     }
//     header("content-type: application/json"); //this
//     echo json_encode($result); //this

// } else {
//     header("location: /FSMS/login.php");
//}
?>
<?php
session_start();
if (isset($_SESSION['UserID'])) {
    require_once '../config.php';
    $outgoing_id = $_SESSION['UserID'];
    $incoming_id = mysqli_real_escape_string($dbConn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM `tblmessage` LEFT JOIN `tbluserpersonaldetails` 
    ON `tblmessage`.`ReceiveID`=`tbluserpersonaldetails`.`UserID` 
    WHERE (`ReceiveID` = {$outgoing_id} AND `SenderID` = {$incoming_id}) OR (`ReceiveID` = {$incoming_id} AND `SenderID` = {$outgoing_id}) ORDER BY `MessageID`";
    $query = mysqli_query($dbConn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['ReceiveID'] === $incoming_id) {
                $output .= "<div class='chat outgoing'>
                                <div class='details'>
                               <!-- <img src='data:image;base64," . base64_encode($row['ProfilePicture']) . "' alt='Profile'>-->
                                    <p>" . $row['Message'] . "</p>
                                </div>
                                </div>";
            } else {
                $output .= "<div class='chat incoming'>
                                <div class='details'>
                                    <p>" . $row['Message'] . "</p>
                                </div>
                                </div>";
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: /FSMS/login.php");
}

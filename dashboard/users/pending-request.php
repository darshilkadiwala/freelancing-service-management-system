<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
    header("Location: /FSMS/Login.php");
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile | FSMS</title>
        <?php
        require_once "../../widgets/head-link-with-profile.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/table.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
    </head>

    <body>
        <?php
        require_once '../../php/config.php';
        require_once '../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="wrap-table100">
                    <div class="table100">
                        <div class="row">
                            <div class="row justify-content-between w-100 d-flex ">
                                <h1><b>Approve freelancer request</b></h1>
                                <h2 class="pendingrequest"></h2>
                                <a href="./" class="btn Btn mx-2">Back</a>
                            </div>
                            <table class="content-table">
                                <thead>
                                    <th style="width:auto;">Sr No.</th>
                                    <th style="width:auto;">User Id</th>
                                    <th style="width:auto;">First Name</th>
                                    <th style="width:auto;">Last Name</th>
                                    <th style="width:auto;">Username</th>
                                    <th style="width:auto;">Email</th>
                                    <th style="width:auto;">ContactNo</th>
                                    <th style="width:auto;">Gender</th>
                                    <th style="width:auto;">View Data</th>
                                </thead>
                                <?php

                                $selectquery = "SELECT * from `tbluserpersonaldetails` WHERE `RoleID`=2 And `AccountStatus`='p'";
                                $query = mysqli_query($dbConn, $selectquery);
                                $pendingrequest = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $pendingrequest++;
                                ?>
                                    <tr>
                                        <td><?php echo $pendingrequest; ?></td>
                                        <td><?php echo $row['UserID']; ?></td>
                                        <td><?php echo $row['FirstName']; ?></td>
                                        <td><?php echo $row['LastName']; ?></td>
                                        <td><?php echo $row['Username']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['ContactNo']; ?></td>
                                        <td><?php echo $row['Gender'] == "M" ? "Male" : "Female"; ?></td>
                                        <td class='edit'>
                                            <a href='process-request.php?uid=<?php echo $row['UserID']; ?>'><i class="fa fa-eye rd-0 rd-tr-10"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                echo "<script>$('.pendingrequest').html('Total pending request: '+$pendingrequest)</script>";
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../../widgets/footer.php';
        ?>
         <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php
}
?>
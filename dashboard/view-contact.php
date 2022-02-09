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
        require_once "../widgets/head-link-with-profile.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/table.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
    </head>

    <body>
        <?php
        require_once '../php/config.php';
        require_once '../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="wrap-table100">
                    <div class="table100">
                        <div class="row mx-5">
                            <div class="row justify-content-between w-100 d-flex mx-5">
                                <h1><b><a href="./"><i class="bx bx-arrow-back font-weight-lighter color-12192C "></i></a> Contact Inquiry</b></h1>
                            </div>
                            <table class="content-table">
                                <thead>
                                    <th style="width:auto;">First Name</th>
                                    <th style="width:auto;">Last Name</th>
                                    <th style="width:auto;">Contact No</th>
                                    <th style="width:auto;">Email</th>
                                    <th style="width:auto;">Message</th>
                                </thead>
                                <?php
                                $selectquery = "SELECT * from `tblcontactinfo`";
                                $query = mysqli_query($dbConn, $selectquery);
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['FirstName']; ?></td>
                                        <td><?php echo $row['LastName']; ?></td>
                                        <td><?php echo $row['ContactNo']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['Message']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php
}
?>
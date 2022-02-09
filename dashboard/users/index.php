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
                            <div class="row justify-content-between w-75 d-flex ">
                                <a href="./pending-request.php" class="Link3">
                                    <h1><b>Approve freelancer request</b></h1>
                                </a>
                                <h2 class="pendingrequest"></h2>
                            </div>
                            <?php

                            $selectquery = "select * from tbluserpersonaldetails where RoleID=2 and AccountStatus='p'";
                            $query = mysqli_query($dbConn, $selectquery);
                            $pendingrequest = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $pendingrequest++;
                            }
                            echo "<script>$('.pendingrequest').html('Total pending request: '+$pendingrequest)</script>";
                            ?>
                            <hr class="col-md-11 bg-light" />
                            <div class="row justify-content-between w-75 d-flex ">
                                <a href="./users.php" class="Link3">
                                    <h1><b>All User</b></h1>
                                </a>
                                <h2 class="alluser"></h2>
                            </div>
                            <?php
                            $selectquery = "select * from tbluserpersonaldetails where AccountStatus='A'";
                            $query = mysqli_query($dbConn, $selectquery);
                            $alluser = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $alluser++;
                            }
                            echo "<script>$('.alluser').html('Total Users: '+$alluser)</script>";
                            ?>
                            <hr class="col-md-11 bg-light" />
                            <div class="row justify-content-between w-75 d-flex ">
                                <a href="./active-customer.php" class="Link3">
                                    <h1><b>Active Customers</b></h1>
                                </a>
                                <h1><b></b></h1>
                                <h2 class="allcust"></h2>
                            </div>
                            <?php
                            $selectquery = "select * from tbluserpersonaldetails where RoleID=3 and AccountStatus='A'";
                            $query = mysqli_query($dbConn, $selectquery);
                            $i = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $i++;
                            }
                            echo "<script>$('.allcust').html('Total Customer: '+$i)</script>";
                            ?>
                            <hr class="col-md-11 bg-light" />
                            <div class="row justify-content-between w-75 d-flex ">
                                <a href="./active-freelancer.php" class="Link3">
                                    <h1><b>Active Freelancers</b></h1>
                                </a>
                                <h1><b></b></h1>
                                <h2 class="allfreelancer"></h2>
                            </div>
                            <?php
                            $selectquery = "select * from tbluserpersonaldetails where RoleID=2 and AccountStatus='A'";
                            $query = mysqli_query($dbConn, $selectquery);
                            $allfreelancer = 0;
                            while ($row = mysqli_fetch_array($query)) {
                                $allfreelancer++;
                            }
                            echo "<script>$('.allfreelancer').html('Total active Freelancers: '+$allfreelancer)</script>";
                            ?>
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
<?php } ?>
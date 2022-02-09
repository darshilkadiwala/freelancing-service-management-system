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
        require_once '../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">

                <div class="row justify-content-between w-75 d-flex ">
                    <h1><b>All Users</b></h1>
                    <h2 class="alluser"></h2><a href="./" class="btn Btn mx-2">Back</a>
                </div>
                <div class="wrap-table100">
                    <div class="table100">
                        <table class="content-table">
                            <thead>
                                <th style="width:auto;">Sr No.</th>
                                <th style="width:auto;">First Name</th>
                                <th style="width:auto;">Last Name</th>
                                <th style="width:auto;">Username</th>
                                <th style="width:auto;">Email</th>
                                <th style="width:auto;">ContactNo</th>
                                <th style="width:auto;">Gender</th>
                                <th style="width:auto;">User type</th>
                                <th style="width:auto;">Account Status</th>
                            </thead>
                            <?php
                            require_once '../../php/config.php';
                            $selectquery = "select * from `tbluserpersonaldetails`";
                            $query = mysqli_query($dbConn, $selectquery);
                            $nums = mysqli_num_rows($query);
                            $alluser = 0;
                            while ($res = mysqli_fetch_array($query)) {
                                $alluser++;
                            ?>
                                <tr>
                                    <td><?php echo $alluser; ?></td>
                                    <td><?php echo ucfirst(strtolower($res['FirstName'])); ?></td>
                                    <td><?php echo ucfirst(strtolower($res['LastName'])); ?></td>
                                    <td><?php echo $res['Username']; ?></td>
                                    <td><?php echo $res['Email']; ?></td>
                                    <td><?php echo $res['ContactNo']; ?></td>
                                    <td><?php echo $res['Gender'] == "M" ? "Male" : "Female"; ?></td>
                                    <td><?php echo $res['RoleID'] == 3 ? "Customer" : "Freelancer"; ?></td>
                                    <td><?php echo $res['AccountStatus'] == "B" ? "Blocked" : ($res['AccountStatus'] == "A" ? "Active" : ($res['AccountStatus'] == "D" ? "Deleted" : ($res['AccountStatus'] == "R" ? "Rejected" : ($res['AccountStatus'] == "P" ? "Pending" : "")))); ?></td>
                                </tr>
                            <?php
                            }
                            echo "<script>$('.alluser').html('Total Users: '+$alluser)</script>";
                            ?>
                        </table>
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
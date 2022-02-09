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
        require_once '../../php/functions.php';
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
                            <div class="col-md-11 ml-5 mt-2">
                                <?php
                                if (isset($_GET['uid']) && (!empty($_GET['uid']))) {
                                    $uid = (int) test_input($_GET['uid']);
                                    $sqlSelectByUID = "SELECT * FROM tbluserpersonaldetails WHERE `UserID`={$uid}";
                                    $querySelectByUID = mysqli_query($dbConn, $sqlSelectByUID);
                                    if ($querySelectByUID) {
                                        if (mysqli_num_rows($querySelectByUID) > 0) {
                                            while ($row = mysqli_fetch_array($querySelectByUID)) { ?>
                                                <div class="row justify-content-between">
                                                    <h1><b>Approve request of : <u><?php echo $row['FirstName'] . " " . $row['LastName']; ?></u></b></h1>
                                                    <form action="#" id="frmProcessRequest" autocomplete="off" class="d-flex">
                                                        <input type="hidden" name="uid" id="userid" value="<?php echo $uid; ?>">
                                                        <div class="loadingButton loadingButton1">
                                                        <input type="submit" name="btnApprove" id="btnApprove" value="Approve" class="btn Btn1 mx-2">
                                                        </div>
                                                        <div class="loadingButton loadingButton2">
                                                        <input type="submit" name="btnReject" id="btnReject" value="Reject" class="btn Btn mx-2">
                                                        </div>
                                                        <a href="./pending-request.php"class="btn Btn mx-2">Back</a>
                                                    </form>
                                                </div>
                                                <h4 class="m-1"><b id="error-msg"></b></h4>
                                                <table class="content-table">
                                                    <thead>
                                                        <th>User Id</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>ContactNo</th>
                                                        <th>Gender</th>
                                                    </thead>

                                                    <tr>
                                                        <td><?php echo $row['UserID']; ?></td>
                                                        <td><?php echo $row['FirstName']; ?></td>
                                                        <td><?php echo $row['LastName']; ?></td>
                                                        <td><?php echo $row['Username']; ?></td>
                                                        <td><?php echo $row['Email']; ?></td>
                                                        <td><?php echo $row['ContactNo']; ?></td>
                                                        <td><?php echo $row['Gender'] == "M" ? "Male" : "Female"; ?></td>
                                                    </tr>
                                                </table>
                                                <?php
                                                $sqlprofessionaldetails = "SELECT * FROM tblfreelancerprofessionaldetails WHERE `FreelancerID`={$uid}";
                                                $professionaldetails = mysqli_query($dbConn, $sqlprofessionaldetails);
                                                if ($professionaldetails) {
                                                    if (mysqli_num_rows($professionaldetails) > 0) {
                                                        while ($row = mysqli_fetch_array($professionaldetails)) { ?>
                                                            <table class="content-table">
                                                                <thead>
                                                                    <th style="width:auto;">Graduation</th>
                                                                    <th style="width:auto;">Graduation Year</th>
                                                                    <th style="width:auto;">Occupation</th>
                                                                    <th style="width:auto;">Working Experience</th>
                                                                    <th style="width:auto;">Last Worked At</th>
                                                                    <th style="width:auto;">About</th>
                                                                </thead>

                                                                <tr>
                                                                    <td><?php echo $row['Graduation']; ?></td>
                                                                    <td><?php echo $row['GraduationYear']; ?></td>
                                                                    <td><?php echo $row['Occupation']; ?></td>
                                                                    <td><?php echo $row['WorkingExperience']; ?></td>
                                                                    <td><?php echo $row['LastWorkedAt']; ?></td>
                                                                    <td><?php echo $row['About']; ?></td>
                                                                </tr>
                                                            </table>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                $sqlSkill = "SELECT * FROM tblskill WHERE `FreelancerID`=$uid";
                                                $querySkill = mysqli_query($dbConn, $sqlSkill);
                                                if ($querySkill) {
                                                    if (mysqli_num_rows($querySkill) > 0) {
                                                        while ($row = mysqli_fetch_array($querySkill)) { ?>
                                                            <table class="content-table w-25">
                                                                <thead>
                                                                    <th style="width:auto;">Skills</th>
                                                                    <th style="width:auto;">Skill Level</th>
                                                                </thead>

                                                                <tr>
                                                                    <td><?php echo $row['SkillName']; ?></td>
                                                                    <td><?php echo $row['SkillLevel'] == "B" ? "Beginner" : ($row['SkillLevel'] == "M" ? "Medium" : ($row['SkillLevel'] == "A" ? "Advanced" : "")); ?></td>
                                                                </tr>
                                                            </table>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                $sqltblservicetype = "SELECT * FROM tblservicetype WHERE `FreelancerID`=$uid";
                                                $queryservicetype = mysqli_query($dbConn, $sqltblservicetype);
                                                if ($queryservicetype) {
                                                    if (mysqli_num_rows($queryservicetype) > 0) {
                                                        while ($row = mysqli_fetch_array($queryservicetype)) { ?>
                                                            <table class="content-table w-25">
                                                                <thead>
                                                                    <th style="width:auto;">Service Name</th>
                                                                </thead>

                                                                <tr>
                                                                    <td><?php echo $row['ServiceName']; ?></td>
                                                                </tr>
                                                            </table>
                                                <?php
                                                        }
                                                    }
                                                } ?>

                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <label>No user found for user id : </label>
                                            <?php
                                            echo $uid;
                                            ?>
                                            <br /><a href="./index.php" class="btn Btn">Back</a>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <label>No user found for user id : </label>

                                    <br /><a href="./index.php" class="btn Btn">Back</a>
                                <?php
                                } ?>
                            </div>
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
        <script src="/FSMS/assets/js/process-request.js"></script>
    </body>

    </html>
<?php } ?>
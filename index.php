<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home | FSMS</title>
    <?php
    require_once "./widgets/head-link.php";
    ?>
    <link rel="stylesheet" href="/FSMS/assets/css/card.css">

</head>

<body class="bg-color-12192C">
    <?php
    require_once './widgets/header.php';
    require_once './php/config.php';
    require_once './php/functions.php';
    ?>

    <div class="main-wrapper">
        <div class="container">
            <div class="pt-5 text-white">
                <h1 class="display-4">Welcome to FSMS</h1>
                <h2 style="display: flex;width: 100%;justify-content: space-between;">
                    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
                        // echo $_SESSION['isLoggedIn'] . "<br/>";
                        // echo $_SESSION['UserID'] . "<br/>";
                        if ($_SESSION['RoleID'] == 1) {
                            echo "Welcome admin : <br/>";
                        } else if ($_SESSION['RoleID'] == 2) {
                            echo "Welcome Freelancer : <br/>";
                        } else if ($_SESSION['RoleID'] == 3) {
                            echo "Welcome Customer : <br/>";
                        }
                        echo $_SESSION['Username'] . "<br/>";
                        $sqlSelectProfilepic = "SELECT `ProfilePicture` FROM `tbluserpersonaldetails` WHERE `UserID`={$_SESSION['UserID']}";
                        $query = mysqli_query($dbConn, $sqlSelectProfilepic);
                        if ($query) {
                            while ($row = mysqli_fetch_array($query)) {
                    ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ProfilePicture']); ?>" height='200px' style="border-radius: 10px;" />
                    <?php
                            }
                        }
                    }
                    ?>
                </h2>   
            </div>
            <hr class="col-auto bg-light" />
        </div>

        <div class="main-content" id="main-content">
            <div class="mycard-container">
                <?php viewServiceCard() ?>
            </div>
        </div>
    </div>
    <?php
    require_once './widgets/footer.php';
    ?>
    <script src="./assets/js/scroll.js"></script>
    <!-- <script src="/FSMS/assets/js/on-browser-close.js"></script> -->
</body>

</html>

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
        <link rel="stylesheet" href="/FSMS/assets/css/card.css">
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
            <div class="main-content bg-color-F5A623" id="main-content">
                <div class="row px-5">
                    <div class="row justify-content-between w-100 ">
                        <a href="./pending-request.php" class="Link3">
                            <h1><b>Your total services</b></h1>
                        </a>
                        <h2 id="totalServices"></h2>
                        <a href="./add-service.php" class="btn Btn1">Add new service</a>

                    </div>
                </div>
                <hr class="col-auto bg-light" />
                <div class="mycard-container d-flex justify-content-start">
                    <?php viewServiceCard((int)$_SESSION['UserID']); ?>
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
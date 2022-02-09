<?php session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    header("Location: /FSMS/");
} else {
    require_once '../php/config.php';
    require_once '../php/constants.php';
    require_once '../php/functions.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Registration | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "../widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-12192C">
        <?php
        require_once '../widgets/header.php';
        ?>
        <div class="my-5 py-5">
            <div class="container col-lg-10 ">
                <div class="row rd-30 no-gutters bg-color-F5A623 justify-content-md-center shadow-lg">
                    <div class="col-5 px-5 pr-3 py-4">
                        <h1 class="color-12192C font-weight-bold justify-content-center align-items-center pt-3">
                            Become Customer</h1>
                        <a href="/FSMS/Registration/CustomerRegistration.php" class="btn Btn-large bg-color-12192C font-weight-bold">Click to Register as Customer</a>
                    </div>
                    <div class="col-auto br-l-color-12192C"></div>
                    <div class="col-5 px-5 pr-3 py-4">
                        <h1 class="color-12192C font-weight-bold justify-content-center align-items-center pt-3">
                            Become Freelancer</h1>
                        <a href="/FSMS/Registration/FreelancerRegistration.php" class="btn Btn-large bg-color-12192C font-weight-bold">Click to Register as Freelancer</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php } ?>
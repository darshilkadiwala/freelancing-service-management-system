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
        <title>Chats | FSMS</title>
        <?php
        require_once "../widgets/head-link-with-profile.php";
        ?>
        <link href="/FSMS/assets/css/under-construction.css" rel="stylesheet" />
        <link href="//fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="//fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    </head>

    <body>
        <?php
        require_once '../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#12192C;">
                <section class="w3l-coming-soon-page">
                    <div class="coming-page-infohny">
                        <div class="wrapper">
                            <div class="coming-block">
                                <h2>Great Things Are</h2>
                                <h1>Coming Soon</h1>
                                <p class="parahny">This page is currently under maintenance. We Should be back shortly. Thank you for your patience.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php } ?>
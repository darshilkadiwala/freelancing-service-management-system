<?php
session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true && isset($_SESSION['isLoginMailSent']) && $_SESSION['isLoginMailSent'] === true) {
    header("Location:/FSMS/login.php");
} else {
    session_unset();

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Login | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "../widgets/head-link.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/card.css">
    </head>

    <body class="bg-color-12192C h-100">
        <?php
        require_once "../widgets/header.php";
        ?>
        <div class="mycard-container">
            <div class="mycard">
                <div class="mycard-img">
                    <img src="..\user-content\profile\20210221072444Screenshot (7).png" alt="" width="300px">
                </div>
                <div class="mycard-text">
                    <div class="mycard-title"> <a href="./view-service.php">Lorem ipsum dolor</a> </div>
                    <div class="mycard-content">sit amet consectetur adipisicing elit. Placeat eveniet enim commodi molestiae minus voluptates, fugit </div>
                </div>
                <div class="mycard-info">
                    <div class="username">Lorem ipsum</div>
                    <div class="user-profile">
                        <img src="..\user-content\profile\20210321094311pexels-photo-2379004.jpeg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        
    </body>

    </html>
<?php } ?>
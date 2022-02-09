<?php
session_start();
if ((isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
    header("Location: /FSMS/");
} else {
    session_unset();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Forgot Password | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "./widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-12192C">
        <?php
        require_once './widgets/header.php';
        ?>
        <div class="main-wrapper mx-5 py-5">
            <div class="container col-lg-6">
                <div class="row bg-white rd-30 no-gutters justify-content-md-center shadow-lg">
                    <div id="popup-div" style="display: none;"></div>
                    <div class="px-5 col-lg-11 pr-3 py-4">
                        <h1 class="font-weight-bold align-items-center ml-4">
                            Forgot Password?</h1>
                        <hr class="col-lg-11 bg-light" />
                        <fieldset class="px-5 border border-primary col-lg-12 justify-content-md-center shadow mb-4 rd-15 pb-3">
                            <legend class="font-weight-bold border br-color-12192C rd-30 px-4 mb-auto w-auto">Enter Email Below</legend>
                            <section>
                                <form class="form" id="frmForgotPassword" action="#">
                                    <div class="mx-2 pb-2">
                                        <div class="form-row ">
                                            <label ID="lblEmail" for="txtEmail" class="ml-1 mt-3 color-12192C font-weight-bold">Email :</label>
                                            <input type="email" ID="txtEmail" name="txtEmail" class="form-control mt-0 p-4" placeholder="Enter Email here" tabindex="1" required />
                                        </div>
                                    </div>
                                    <div class="form-row ml-1">
                                        <div class="justify-content-md-center">
                                            <div ID="emailErr" class="error-msg"></div>
                                        </div>
                                    </div>
                                    <div class="form-row ">
                                        <div class="col-lg-4">
                                            <div class="loadingButton">
                                                <input type="submit" ID="btnVerifyEmail" name="btnVerifyEmail" class="btn Btn-large mt-2" value="Send OTP" tabindex="2" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </fieldset>
                        <div class="mt-3 ">
                            <a href="Login.php" class="Link ">Have a password?</a>
                            <p>
                                Don't have an account? <a href="/FSMS/Registration/" class="Link ">Create new account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once './widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/scroll.js"></script>
        <script src="/FSMS/assets/js/popup-msg.js"></script>
        <script src="/FSMS/assets/js/forgot-password.js"></script>
    </body>

    </html>
<?php
}
?>
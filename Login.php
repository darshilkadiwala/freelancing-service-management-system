<?php
session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true && isset($_SESSION['isLoginMailSent']) && $_SESSION['isLoginMailSent'] === true) {
    header("Location:index.php");
} else {
    if (isset($_SESSION['passchange']) && $_SESSION['passchange'] == true) {
        $passchange = true;
    }
    session_unset();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Login | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "./widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-12192C h-100">
        <?php
        require_once "./widgets/header.php";
        ?>
        <div class="Form mx-5 pt-3 pb-5">
            <div class="container col-md-7 mt-4">
                <div class="row bg-white rd-30 no-gutters justify-content-center shadow-lg">
                    <div id="popup-div" style="display: none;">
                        <div class="popup-msg" id="popup-msg">
                            <?php if (isset($passchange) &&  $passchange) { ?>
                                <p class='popup-msg-text'>Your Password changed Successfully!!!</p>
                                <i class='bx bx-x icon-suffix popup-msg-icon' id='close-popup'></i>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-11 px-5 pr-3 py-4">
                        <h1 class="font-weight-bold justify-content-center align-items-center pt-3">Welcome back!</h1>
                        <hr class="col-md-11 bg-light" />
                        <div class="mx-5">
                            <fieldset class="border border-primary shadow px-4 py-3 rd-15">
                                <legend class="border shadow-sm font-weight-bold rd-30 m-2 px-3 py-2 w-auto">Sign into your account</legend>
                                <section>
                                    <form class="form" id="frmLogin" action="#" autocomplete="off">
                                        <div class="mx-2">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="txtUsername" ID="lblUsername" class="mb-1 ml-1 color-12192C font-weight-bold">Username :</label>
                                                    <input type="text" ID="txtUsername" name="txtUsername" title="Enter username here" maxlength="16" class="form-control mb-3 p-4" placeholder="Username" tabindex="1" required />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="txtPasswd" ID="lbltxtPasswd" class="mb-0 ml-1 color-12192C font-weight-bold">Password :</label>
                                                    <div class="input-group">
                                                        <input type="password" ID="txtPasswd" name="txtPasswd" class="form-control mb-3 p-4" placeholder="Password" tabindex="2" required />
                                                        <div class="input-group-append">
                                                            <button id="show_password" class="btn border-13eb86 border-left-0 bg-transparent mb-3 " type="button" tabindex="3">
                                                                <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row ">
                                                <div class="col-4">
                                                    <div class="loadingButton">
                                                        <input type="submit" ID="btnLogin" name="Login" class="btn Btn mt-2 shadow" value="Login" tabindex="4" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-auto justify-content-center mt-3">
                                                <div class="error-msg" id="error-msg"></div>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </fieldset>
                            <div class="mt-3 ">
                                <a href="ForgotPassword.php" class="Link ">Forgot password?</a>
                                <p>
                                    Don't have an account? <a href="/FSMS/Registration/" class="Link ">Create new account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once "./widgets/footer.php";
        ?>
        <script src="./assets/js/popup-msg.js" id="popupjs"></script>
        <?php if (isset($passchange) &&  $passchange) { ?>
            <script>
                showPopUp();
            </script>
        <?php } ?>
        <script src="./assets/js/show-password.js"></script>
        <script src="./assets/js/login.js"></script>
        <script src="./assets/js/scroll.js"></script>
    </body>

    </html>
<?php
}
?>
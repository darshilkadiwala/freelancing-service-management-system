<?php
session_start();
if ((isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
    header("Location:/FSMS/");
} else if (isset($_SESSION['OTP'])  && !empty($_SESSION['OTP']) && isset($_SESSION['isResetPassOTPSent']) && $_SESSION['isResetPassOTPSent']) {
    require_once './php/config.php';
    require_once './php/constants.php';
    require_once './php/functions.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Verify OTP | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "./widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-12192C h-100">
        <?php
        require_once './widgets/header.php';
        ?>

        <div class="Form mx-5 py-5">
            <div class="container col-md-8">
                <div class="row bg-white rd-30 no-gutters justify-content-md-center shadow-lg">
                    <div id="popup-div" style="display: none;"></div>
                    <div class="px-5 col-lg-11 pr-3 pt-1 pb-5">
                        <h1 class="font-weight-bold align-items-center pt-3 ml-4">
                            We sent you an email for OTP !!!</h1>
                        <hr class="col-lg-11 bg-light" />
                        <fieldset class="px-5 border rd-15 border-13eb86 shadow pb-3">
                            <legend class="border shadow font-weight-bold rd-30 m-2 px-3 py-2 w-auto">Enter OTP Below</legend>
                            <form method="post" action="#" name="frmVerifyChangePass" id="frmVerifyChangePass">
                                <div class="mx-2 pb-2">
                                    <div class="form-row ">
                                        <label ID="lblOldPassword" for="txtOTP" class="mt-3  color-12192C font-weight-bold">OTP :</label>
                                        <input type="number" ID="txtOTP" name="txtOTP" class="form-control p-4" placeholder="Enter OTP here" maxlength="6" max="999999" min="111111" pattern="\d{6}" tabindex="1" required />
                                        <span class="error-msg" id="otpErr"></span>
                                    </div>
                                    <div class="form-row ">
                                        <label ID="lblNewPassword" for="txtNewPasswd" class="mt-3  color-12192C font-weight-bold">New Password :</label>
                                        <div class="input-group">
                                            <input type="password" ID="txtNewPasswd" name="txtNewPasswd" class="form-control p-4" placeholder="Enter New password here" tabindex="2" required />
                                            <div class="input-group-append">
                                                <button id="show_new_password" class="btn border-13eb86 border-left-0 bg-transparent" type="button">
                                                    <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="error-msg" id="newpasswordErr"></span>
                                    </div>
                                    <div class="form-row ">
                                        <label ID="lblConfirmNewPassword" for="txtConfirmNewPasswd" class="mt-3 color-12192C font-weight-bold">Confirm New Password :</label>
                                        <div class="input-group">
                                            <input type="password" ID="txtConfirmNewPasswd" name="txtConfirmNewPasswd" class="form-control p-4" placeholder="Confirm New password here" tabindex="3" required />
                                            <div class="input-group-append">
                                                <button id="show_confirm_new_password" class="btn border-13eb86 border-left-0 bg-transparent" type="button">
                                                    <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="error-msg" id="confnewpasswordErr"></span>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-lg-4">
                                            <div class="loadingButton">
                                                <input type="submit" ID="btnVerifyChangePass" name="btnVerifyChangePass" class="btn Btn-large mt-2" value="Verify OTP & Change Password" tabindex="4" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <script src="/FSMS/assets/js/show-password.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
        <script src="/FSMS/assets/js/popup-msg.js"></script>
        <script src="/FSMS/assets/js/verifyOTP.js"></script>
    </body>

    </html>
<?php

} else {
    echo "<script>window.location.href='./ForgotPassword.php'</script>";
}
?>
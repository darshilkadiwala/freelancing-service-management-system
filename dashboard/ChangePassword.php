<?php
session_start();
if (!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true)) {
    header("Location:/FSMS/Login.php");
} else {
    require_once '../php/config.php';
    require_once '../php/constants.php';
    require_once '../php/functions.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Change Password | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "../widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-EDEDED">
        <?php
        require_once '../widgets/header.php';
        // $oldpassword = $oldpasswordErr = $newpassword = $newpasswordErr = $confnewpasswordErr = $confnewpassword = "";
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="container col-lg-7">
                    <div class="row rd-30 no-gutters justify-content-md-center shadow-lg">
                    <div id="popup-div" style="display: none;"></div>
                    <div class="px-5 py-2">
                            <h1 class="font-weight-bold align-items-center pt-3">
                                Change Password</h1>
                            <hr class="col-lg-11 bg-color-12192C" />
                            <div class="justify-content-md-center bg-white row shadow mb-4 pb-4 rd-15">
                                <div class="mx-5">
                                    <form id="frmChangePass" name='frmChangePass' method="post" novalidate>
                                        <div class="mx-2 pb-2">
                                            <div class="form-row">
                                                <label ID="lblOldPassword" for="txtOldPasswd" class="m-0 ml-1 mt-3 color-12192C font-weight-bold">Old Password :</label>
                                                <div class="input-group">
                                                    <input type="password" ID="txtOldPasswd" name="txtOldPasswd" class="form-control my-1 p-4" placeholder="Enter Old password here" tabindex="1" required />
                                                    <div class="input-group-append">
                                                        <button id="show_old_password" class="btn border-13eb86 border-left-0 bg-transparent my-1" type="button" tabindex="2">
                                                            <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="error-msg" id="oldpasswordErr"></div>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblNewPassword" for="txtNewPasswd" class="m-0 ml-1 mt-3 color-12192C font-weight-bold">New Password :</label>
                                                <div class="input-group">
                                                    <input type="password" ID="txtNewPasswd" name="txtNewPasswd" class="form-control my-1 mt-0 p-4" placeholder="Enter New password here" tabindex="3" required />
                                                    <div class="input-group-append">
                                                        <button id="show_new_password" class="btn border-13eb86 border-left-0 bg-transparent my-1" type="button" tabindex="4">
                                                            <i class="fa fa-eye bg-transparent"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="error-msg" id="newpasswordErr"></div>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblConfirmNewPassword" for="txtConfirmNewPasswd" class="m-0 ml-1 mt-3 color-12192C font-weight-bold">Confirm New Password :</label>
                                                <div class="input-group">
                                                    <input type="password" ID="txtConfirmNewPasswd" name="txtConfirmNewPasswd" class="form-control my-1 mt-0 p-4" placeholder="Confirm New password here" tabindex="5" required />
                                                    <div class="input-group-append">
                                                        <button id="show_confirm_new_password" class="btn border-13eb86 border-left-0 bg-transparent my-1" type="button" tabindex="6">
                                                            <i class="fa fa-eye bg-transparent"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="error-msg" id="confnewpasswordErr"></div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <div class="loadingButton">
                                                        <input type="submit" ID="btnVerify" name="btnVerify" class="btn Btn-large mt-2" value="Verify & Change Password" tabindex="7" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/popup-msg.js" id="popupjs"></script>
        <script src="/FSMS/assets/js/show-password.js"></script>
        <script src="/FSMS/assets/js/dashboard/change-password.js"></script>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php
}
?>
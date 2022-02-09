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
        require_once "../widgets/head-link.php";
        ?>
    </head>

    <body>
        <?php
        require_once "../widgets/header.php";
        ?>
        <div class="main-wrapper">
            <div class="main-content ml-0" id="main-content" style="background:#12192C;">
                <ul class="l-nav-list">
                    <?php if (isset($_SESSION['RoleID']) && $_SESSION['RoleID'] != 1) { ?>
                        <a href="/FSMS/dashboard/profile.php" class="l-nav-link">
                            <i class='bx bxs-user nav-icon'></i>
                            <span class="nav-text">Profile</span>
                        </a>
                        <a href="/FSMS/chat/" class="l-nav-link">
                            <i class='bx bxs-message-rounded nav-icon'></i>
                            <span class="nav-text">Chat</span>
                        </a>
                        <a href="/FSMS/order/" class="l-nav-link">
                            <i class='bx bxs-box nav-icon'></i>
                            <span class="nav-text">Order</span>
                        </a>
                    <?php } ?>
                    <?php if (isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 2) { ?>
                        <a href="/FSMS/dashboard/services/" class="l-nav-link">
                            <i class='bx bx-list-ul nav-icon'></i>
                            <span class="nav-text">Service</span>
                        </a>
                    <?php } ?>
                    <?php if (isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 1) { ?>
                        <a href="/FSMS/dashboard/category/" class="l-nav-link">
                            <i class='bx bx-list-ul nav-icon'></i>
                            <span class="nav-text">Category</span>
                        </a>
                        <ul>
                            <li>
                                <a href="/FSMS/dashboard/users/" class="l-nav-link">
                                    <i class='bx bxs-group nav-icon'></i>
                                    <span class="nav-text">Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="/FSMS/dashboard/users/users.php" class="l-nav-link">
                                    <i class='bx bxs-group nav-icon'></i>
                                    <span class="nav-text">All Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="/FSMS/dashboard/users/pending-request.php" class="l-nav-link">
                                    <i class='bx bxs-group nav-icon'></i>
                                    <span class="nav-text"> Pending Request</span>
                                </a>
                            </li>
                            <li>
                                <a href="/FSMS/dashboard/users/active-customer.php" class="l-nav-link">
                                    <i class='bx bxs-group nav-icon'></i>
                                    <span class="nav-text"> Active Customer</span>
                                </a>
                            </li>
                            <li>
                                <a href="/FSMS/dashboard/users/active-freelancer.php" class="l-nav-link">
                                    <i class='bx bxs-group nav-icon'></i>
                                    <span class="nav-text"> Active FreeLancer</span>
                                </a>
                        </ul>
                        <a href="/FSMS/dashboard/view-contact.php" class="l-nav-link">
                            <i class='bx bx-info-circle nav-icon'></i>
                            <span class="nav-text"> Contact Inquiry</span>
                        </a>
                    <?php } ?>

                    <a href="/FSMS/dashboard/ChangePassword.php" class="l-nav-link">
                        <i class='bx bxs-key nav-icon'></i>
                        <span class="nav-text">Change Password</span>
                    </a>
                </ul>
            </div>
        </div>
        <?php
        require_once "../widgets/footer.php";
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php } ?>
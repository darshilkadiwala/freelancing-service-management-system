<!--Header-->
<div id="t-nav-body">
    <div class="t-navbar" id="t-navbar">
        <nav class="t-nav">
            <div class="t-navbar-brand">
                <img src="/FSMS/assets/icon/icon1.png" alt="logo" class="nav-logo-icon">
                <?php
                if (isset($isCheckOut) && $isCheckOut === true) {
                ?>
                    <a class="nav-logo-text Link3" href="/FSMS/">FSMS</a>
                <?php } else { ?>
                    <span class="nav-logo-text">FSMS</span>
                <?php } ?>
            </div>
            <div class="t-nav-toggle nav-toggle" id="t-nav-toggle"><i class='bx bx-menu'></i></div>
            <ul class="t-nav-list">
                <?php
                if (isset($isCheckOut) && $isCheckOut === true) {
                ?>
                    <span class="t-nav-link active">
                        <span class="number-badge">
                            <span class="number">
                                <?php
                                if (isset($orderCheck) && $orderCheck === true) { ?>
                                    <i class="bx bx-check font-weight-bolder"></i>
                                    <?php } else { ?>1<?php } ?>
                            </span>
                        </span>
                        <span class="nav-text text-capitalize">Confirm Order Details</span>
                    </span>
                    <span><i class="bx bxs-chevron-right rounded-circle <?php echo (isset($orderCheck) && $orderCheck === true) ? 'color-EDEDED p-2 bg-color-12192C ' : 'color-EDEDED'; ?>"></i></span>
                    <span class="t-nav-link <?php echo (isset($orderCheck) && $orderCheck === true) ? 'active' : ''; ?>">
                        <span class="number-badge">
                            <span class="number">
                                <?php
                                if (isset($payDone) && $payDone === true) { ?>
                                    <i class="bx <?php echo (isset($paySucess) && $paySucess == true) ? 'bx-check' : 'bx-x'; ?> font-weight-bold"></i>
                                    <?php } else { ?>2<?php } ?>
                            </span>
                        </span>
                        <span class="nav-text text-capitalize">Order Payment</span>
                    </span>
                    <span><i class="bx bxs-chevron-right rounded-circle <?php echo (isset($paySucess) && $paySucess === true) ? 'color-EDEDED p-2 bg-color-12192C ' : 'color-EDEDED'; ?>"></i></span>
                    <span class="t-nav-link <?php echo (isset($paySucess) && $paySucess === true) ? 'active' : ''; ?>">
                        <span class="number-badge">
                            <span class="number">
                                <?php
                                if (isset($getReq) && $getReq === true) { ?>
                                    <i class="bx bx-check font-weight-bolder"></i>
                                    <?php
                                } else { ?>3<?php } ?>
                            </span>
                        </span>
                        <span class="nav-text text-capitalize">Submit requirement</span>
                    </span>
                <?php } else { ?>
                    <a href="/FSMS/" class="t-nav-link">
                        <span class="nav-text text-uppercase">Home</span>
                    </a>
                    <?php if (isset($_SESSION['RoleID']) && $_SESSION['RoleID'] != 1) { ?>
                        <a href="/FSMS/ContactUs.php" class="t-nav-link">
                            <span class="nav-text">Contact Us</span>
                        </a>
                    <?php }
                    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) { ?>

                        <div class="profile nav-text">
                            <span class="profile-name nav-text"><?php echo $_SESSION['Username']; ?>
                                <!-- <span class="profile-type">Admin</span> -->
                            </span>
                            <div class="profile-icon">
                                <img src="/FSMS/assets/icon/profile.png" alt="..." width="40" />
                                <i class="bx bxs-chevron-down"></i>
                            </div>
                            <div class="profile-dropdown">
                                <ul>
                                    <li><a href="/FSMS/dashboard/profile.php"><i class="bx bxs-user"></i>Profile</a></li>
                                    <?php if (isset($_SESSION['RoleID']) && ($_SESSION['RoleID'] == 1 || $_SESSION['RoleID'] == 2)) { ?>
                                        <li><a href="/FSMS/dashboard/"><i class="bx bxs-dashboard"></i>Dashboard</a></li>
                                    <?php }
                                    if (isset($_SESSION['RoleID']) && ($_SESSION['RoleID'] == 3)) { ?>
                                        <li><a href="/FSMS/order/"><i class="bx bx-box"></i>Orders</a></li>
                                        <li><a href="/FSMS/chat/"><i class="bx bxs-message-rounded"></i>Chat</a></li>
                                        <li><a href="/FSMS/chat/"><i class='bx bxs-key'></i>Change Password</a></li>
                                    <?php
                                    } ?>
                                    <li><a href="/FSMS/Logout.php"><i class="bx bx-log-out-circle"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a href="/FSMS/Registration/" class="t-nav-link">
                            <span class="nav-text">Register</span>
                        </a>
                        <a href="/FSMS/Login.php" class="t-nav-link">
                            <span class="nav-text">Login</span>
                        </a>
                <?php }
                } ?>
            </ul>
        </nav>
    </div>
</div>
<!-- Scroll to top -->
<div id="scrolltoTop">
    <i class='bx bxs-chevron-up scrolltoTop'></i>
</div>
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
        <title>Add Promotion | FSMS</title>
        <?php
        require_once "../widgets/head-link-with-profile.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/table.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
    </head>

    <body>
        <?php
        require_once '../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../widgets/sidebar.php";
            require_once "../php/config.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div id="admin-content">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <h1 class="admin-heading"><b>Add Discount</b></h1>
                                <h3 id="error"></h3>
                            </div>
                            <div class="col-md-offset-3 col-md-6">
                                <form action="#" method="POST" autocomplete="off">
                                    <label>Service Id</label>
                                    <select id="drpdlistoffer" name="drpdlistoffer" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                        <option value="none" disabled>-- Select Service Id --</option>

                                        <?php
                                        $result = mysqli_query($dbConn, "SELECT * FROM `tblpromotionoffer`");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option>
                                            <?php
                                            echo "$row[PromotionName]";
                                        } ?></option>
                                    </select>
                                    <div class="form-group">
                                        <label>Discount Rate</label>
                                        <input type="text" ID="txtRate" name="txtRate" class="form-control my-1 p-4" placeholder="Enter Discount Rate" required />
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>promation End Date</label>
                                        <input type="date" ID="txtDobEnd" name="txtDobEnd" class="form-control my-1 p-4" placeholder="yyyy-mm-dd" required />
                                    </div> -->
                            </div>
                            <!-- <input type="number" name="promotionprice" class="form-control" maxlength="100" placeholder="Promotion Price" required> -->
                        </div>
                        <input type="submit" name="save" class="btn Btn1" value="Add" required />
                        <a href="./" class="btn Btn">Back</a>
                        </form>

                        <?php
                        require '../php/config.php';
                        if (isset($_POST['save'])) {
                            $drpdlistoffer = $_POST['drpdlistoffer'];
                            $txtdiscount = $_POST['txtRate'];
                            $status = "A";
                            $txtdiscount = "INSERT INTO `tbldiscountofferdetail`(`ServiceID`,`DiscountRate`,`OfferStatus`)VALUES('$drpdlistoffer','$txtdiscount','$status')";
                            $query = mysqli_query($dbConn, $txtdiscount);
                            if ($query) {

                                echo "<script>window.location.href='viewdiscount.php'</script>";
                        ?>

                        <?php
                                // echo "<script>window.location.href='./'</script>";

                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/scroll.js"></script>
        <!-- <script src="/FSMS/assets/js/load-state-city.js"></script> -->
        <script src="/FSMS/assets/js/main.js"></script>
        <!-- <script src="/FSMS/assets/js/dashboard/profile.js"></script> -->
    </body>

    </html>
<?php
}
?>
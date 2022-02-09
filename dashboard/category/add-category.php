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
        <title>Add new category | FSMS</title>
        <?php
        require_once "../../widgets/head-link-with-profile.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/table.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
    </head>

    <body>
        <?php
        require_once '../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div id="admin-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="admin-heading"><b>Add New Category</b></h1>
                                <h3 id="error"></h3>
                            </div>
                            <div class="col-md-offset-3 col-md-6">
                                <form action="#" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required><br />
                                        <label>Category Short Description</label>
                                        <input type="text" name="catd" class="form-control" maxlength="100" placeholder="Category ShortDescription" required>
                                    </div>
                                    <input type="submit" name="save" class="btn Btn1" value="Add" required />
                                    <a href="./" class="btn Btn">Back</a>
                                    <?php
                                    require '../../php/config.php';
                                    if (isset($_POST['save'])) {
                                        $category = $_POST['cat'];
                                        $categoryDesc = $_POST['catd'];
                                        $sqlFindCategory = "SELECT * FROM `tblservicecategories` WHERE `ServiceCategoryName` LIKE '$category'";
                                        $query = mysqli_query($dbConn, $sqlFindCategory);
                                        if ($query) {
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($row = mysqli_fetch_array($query)) {
                                                    echo "<script>$('#error').html('This category already exists: <b><i> {$row['ServiceCategoryName']}</i></b>');</script>";
                                                }
                                            } else {
                                                $sqlcategory = "INSERT INTO `tblservicecategories`(`ServiceCategoryName`,`ShortDescription`)VALUES('$category','$categoryDesc')";
                                                $query = mysqli_query($dbConn, $sqlcategory);
                                                if ($query) {
                                                    echo "<script>window.location.href='./'</script>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php
        require_once '../../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php } ?>
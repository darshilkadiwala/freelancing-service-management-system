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
        require_once "../../../widgets/head-link-with-profile.php";
        ?>
        <link rel="stylesheet" href="/FSMS/assets/css/table.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
    </head>

    <body>
        <?php
        require_once '../../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../../widgets/sidebar.php";
            require '../../../php/config.php';
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div id="admin-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="admin-heading">Add Sub Category Category</h1>
                            </div>
                            <div class="col-md-offset-3 col-md-6">
                                <form action="#" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <label for="cat" class="mt-3">Subcategory Name</label>
                                        <input type="text" name="cat" id="cat" class="form-control" placeholder="Subcategory Name" required>
                                        <label for="catd" class="mt-3">Category</label>
                                        <select name="catd" id="catd" class="form-control" required>
                                            <option value="" selected disabled>-- Select Category --</option>
                                            <?php
                                            $cate = "select * from tblservicecategories";
                                            $query = mysqli_query($dbConn, $cate);
                                            while ($crow = mysqli_fetch_assoc($query)) {
                                                echo '<option value="' . $crow['ServiceCategoryID'] . '">' . $crow['ServiceCategoryName'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="catde" class="mt-3">Subcategory Short Description</label>
                                        <textarea type="text" name="catde" class="form-control" maxlength="100" placeholder="Subcategory ShortDescription" required></textarea>

                                    </div>
                                    <input type="submit" name="save" class="btn Btn1" value="Add" required />
                                    <a href="./index.php" class="btn Btn">Back</a>
                                    <?php

                                    if (isset($_POST['save'])) {
                                        $category = $_POST['cat'];
                                        $selectcategory = $_POST['catd'];
                                        $decategory = $_POST['catde'];
                                        $sqlcategory = "INSERT INTO `tblservicesubcategories`(`SubcategoryName`,`ServiceCategoryID`,`ShortDescription`) VALUES('{$category}','{$selectcategory}','{$decategory}')";
                                        $query = mysqli_query($dbConn, $sqlcategory);
                                        if ($query) {
                                            echo "<script>window.location.href='./'</script>";
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
        require_once '../../../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
    </body>

    </html>
<?php } ?>
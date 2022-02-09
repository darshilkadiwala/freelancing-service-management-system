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
            require_once '../../../php/config.php';
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="row justify-content-between d-flex ">
                    <h1><b>Active Subcategories</b></h1>
                    <h3 id="totalSubcategory"></h3>
                    <a href="./add-subcategory.php" class="btn Btn1">Add Sub Category</a>
                </div>
                <div class="wrap-table100">
                    <div class="table100">
                        <table class="content-table">
                            <thead>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th class="column1">Short Description</th>
                                <th>Edit</th>
                                <th>Block</th>

                            </thead>
                            <tbody>
                                <?php
                                $selectquery = "SELECT `tblservicesubcategories`.*, `tblservicecategories`.`ServiceCategoryName` FROM `tblservicesubcategories` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` WHERE `tblservicesubcategories`.`SubcategoryStatus` NOT IN ('B')";
                                $query = mysqli_query($dbConn, $selectquery);
                                $totalSubCategory = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $totalSubCategory++;
                                ?>
                                    <tr>
                                        <td><?php echo $row['ServiceCategoryName']; ?></td>
                                        <td><?php echo $row['SubcategoryName']; ?></td>
                                        <td><?php echo $row['ShortDescription']; ?></td>
                                        <td class='edit'>
                                            <a href='update-subcategory.php?scid=<?php echo $row['ServiceSubcategoryID']; ?>'><i class='bx bxs-edit-alt icon'></i></a>
                                        </td>
                                        <td class='delete'><a href='delete-catagory.php?scid=<?php echo $row['ServiceSubcategoryID']; ?>'><i class="bx bx-block icon"></i></a></td>
                                    </tr>
                                <?php
                                }
                                echo "<script>$('#totalSubcategory').html('Total Active Subcategory: '+$totalSubCategory)</script>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-between w-75 d-flex ">
                    <h1><b>Blocked Subcategories</b></h1>
                    <h3 id="totalCategory"></h3>
                </div>
                <div class="wrap-table100">
                    <div class="table100">
                        <table class="content-table">
                            <thead>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th class="column1">Short Description</th>
                                <th>Edit</th>
                                <th>Active</th>

                            </thead>
                            <tbody>
                                <?php
                                $selectquery = "SELECT `tblservicesubcategories`.*, `tblservicecategories`.`ServiceCategoryName` FROM `tblservicesubcategories` LEFT JOIN `tblservicecategories` ON `tblservicesubcategories`.`ServiceCategoryID` = `tblservicecategories`.`ServiceCategoryID` WHERE `tblservicesubcategories`.`SubcategoryStatus`IN ('B')";
                                $query = mysqli_query($dbConn, $selectquery);
                                $totalSubCategory = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $totalSubCategory++;
                                ?>
                                    <tr>
                                        <td><?php echo $row['ServiceCategoryName']; ?></td>
                                        <td><?php echo $row['SubcategoryName']; ?></td>
                                        <td><?php echo $row['ShortDescription']; ?></td>
                                        <td class='edit'>
                                            <a href='update-category.php?cid=<?php echo $row['ServiceSubcategoryID']; ?>'><i class='bx bxs-edit-alt icon'></i></a>
                                        </td>
                                        <td class='delete'><a href='delete-catagory.php?cid=<?php echo $row['ServiceSubcategoryID']; ?>'><i class="bx bxs-check-circle icon"></i></a></td>
                                    </tr>
                                <?php
                                }
                                echo "<script>$('#totalCategory').html('Total Blocked Subcategory: '+$totalSubCategory)</script>";
                                ?>
                            </tbody>
                        </table>
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
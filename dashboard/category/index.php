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
            require_once '../../php/config.php';
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="row justify-content-between w-75 d-flex ">
                    <a href="./subcategory/" class="Link3">
                        <h3><b>Click Here to <u>View Subcategories</u></b></h3>
                    </a>
                </div>

                <div class="wrap-table100">
                    <div class="table100">
                        <div class="row justify-content-between ">
                            <h1><b>Active Categories</b></h1>
                            <h2 id="totalCategory"></h2>
                            <a href="./add-category.php" class="btn Btn1">Add new category</a>
                        </div>
                        <table class="content-table">
                            <thead>
                                <th class="column3">Category</th>
                                <th class="column1">Short Description</th>
                                <th class="column4">Edit</th>
                                <th class="column3">Block</th>
                            </thead>
                            <tbody>
                                <?php
                                $selectquery = "select * from `tblservicecategories` where `CategoryStatus` not in('D')";
                                $query = mysqli_query($dbConn, $selectquery);
                                $totalCategory = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $totalCategory++;
                                ?>
                                    <tr>
                                        <td><?php echo $row['ServiceCategoryName']; ?></td>
                                        <td><?php echo $row['ShortDescription']; ?></td>
                                        <td class='edit'>
                                            <a href='update-category.php?cid=<?php echo $row['ServiceCategoryID']; ?>'><i class='bx bxs-edit-alt icon'></i></a>
                                        </td>
                                        <td class='delete'><a href="./delete-catagory.php?cid=<?php echo $row['ServiceCategoryID']; ?>" value='<?php echo $row['ServiceCategoryID']; ?>' /><i class="bx bx-block icon"></i></td>
                                    </tr>
                                <?php
                                }
                                echo "<script>$('#totalCategory').html('Total active categories: '+$totalCategory)</script>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="wrap-table100">
                    <div class="table100">
                        <div class="row justify-content-between ">
                            <h1><b>Deactive Categories</b></h1>
                            <h2 id="totalDeactiveCategory"></h2>
                        </div>
                        <table class="content-table">
                            <thead>
                                <th class="column3">Category</th>
                                <th class="column1">Short Description</th>
                                <th class="column3">Active</th>
                            </thead>
                            <tbody>
                                <?php
                                $selectquery = "select * from `tblservicecategories` where `CategoryStatus` in('D')";
                                $query = mysqli_query($dbConn, $selectquery);
                                $totalDeactiveCategory = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                    $totalDeactiveCategory++;
                                ?>
                                    <tr>
                                        <td><?php echo $row['ServiceCategoryName']; ?></td>
                                        <td><?php echo $row['ShortDescription']; ?></td>
                                        <td class='active'><a href='active-category.php?cid=<?php echo $row['ServiceCategoryID']; ?>'><i class="bx bxs-check-circle bx-bold icon"></i></td>
                                    </tr>
                                <?php
                                }
                                echo "<script>$('#totalDeactiveCategory').html('Total deactive categories: '+$totalDeactiveCategory)</script>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <?php
        require_once '../../widgets/footer.php';
        ?>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
        <!-- <script src="/FSMS/assets/js/dashboard/category/process-category.js"></script> -->
    </body>

    </html>
<?php } ?>
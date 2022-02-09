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
        include '../../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="limiter">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <div class="table100">
                                <table class="content-table">
                                    <thead>
                                        <th class="column2">SubCategory</th>
                                        <th class="column2">Category</th>
                                        <th class="column1">ShortDescription</th>
                                        <th class="column4">Edit</th>
                                        <th class="column4">Remove</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once '../../../php/config.php';
                                        $selectquery = "select * from tblservicesubcategories";
                                        $query = mysqli_query($dbConn, $selectquery);
                                        $nums = mysqli_num_rows($query);
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['SubcategoryName']; ?></td>
                                                <td><?php echo $row['SubcategoryName']; ?></td>
                                                <td><?php echo $row['ShortDescription']; ?></td>
                                                <td class='edit'>
                                                    <a href='update-category.php?cid=<?php echo $row['ServiceCategoryID']; ?>'><i class='fa fa-edit'></i></a>
                                                </td>
                                                <td class='delete'><a href='#'><i class='fa fa-trash-o'></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
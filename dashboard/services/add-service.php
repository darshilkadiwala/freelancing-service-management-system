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
        <!-- <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/vendor/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/css/util.css">-->
        <!-- <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
        <link rel="stylesheet" type="text/css" href="/FSMS/assets/tables/main.css">
        <link rel="stylesheet" href="/FSMS/assets/css/card.css">
    </head>

    <body>
        <?php
        require_once '../../php/config.php';
        require_once '../../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../../widgets/sidebar.php";
            ?>
            <div class="main-content" id="main-content" style="background:#F5A623;">
                <div class="container col-12 mb-5 pb-5">
                    <div class="row rd-30 no-gutters justify-content-md-center shadow-lg px-2 pt-2 bg-color-12192C">
                        <div class="col-10 align-items-center pt-3 py-4">
                            <h1><label id="lblRegistration" class="h1 text-white font-weight-bold">Add Service</label></h1>
                            <hr class="bg-light" />
                            <!-- <label id="lblmsg" class="error-msg align-content-center">!!! Error while registering you please try later</label> -->
                        </div>
                        <div class="col-9 justify-content-md-center">
                            <form id="frmAddService" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <!-- ---------------------------- Peronal Details ---------------------------- -->
                                <!-- <h2 class="bg-white rd-tl-tr-30 m-0 mb-1 pl-5 p-2 col-4"><label name="lblPersonalDetails" class="h3 font-weight-bold" Style="color: #12192C">Personal Details</label></h2> -->
                                <div class="col-12 px-5 py-4 bg-white rd-30 rd-br-30 rd-tr-30">
                                    <div class="pl-4">
                                        <div class="row">
                                            <div class="col-10 pb-3 pl-5">
                                                <div class="form-row">
                                                    <label id="lblServicetitle" for="txtServicetitle" class="mb-1 ml-1 color-12192C font-weight-bold">Service title :</label>
                                                    <input type="text" id="txtServicetitle" name="txtServicetitle" class="form-control mb-1 p-4" placeholder="Service title" required />
                                                    <span class="error-msg" id="ServicetitleErr"></span>
                                                </div>
                                                <div class="form-row">
                                                    <label for="txtShortDescription" id="lblShortDescription" class=" mb-1 mt-3 ml-1 color-12192C font-weight-bold">Short description :</label>
                                                    <textarea type="text" id="txtShortDescription" name="txtShortDescription" class="form-control mb-1 p-4" placeholder="Short description" required></textarea>
                                                    <span class="error-msg" id="ShortDescriptionErr"></span>
                                                </div>
                                                <div class="form-row">
                                                    <label for="txtAboutService" id="lblAboutService" class=" mb-1 mt-3 ml-1 color-12192C font-weight-bold">About Service :</label>
                                                    <textarea type="text" id="txtAboutService" name="txtAboutService" class="form-control mb-1 p-4" placeholder="About Service" required /></textarea>
                                                    <span class="error-msg" id="AboutServiceErr"></span>
                                                </div>
                                                <div class="row-col">
                                                    <div class="form-row">
                                                        <label id="lblCategory" for="drpdlistCategory" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">Category :</label><br />
                                                    </div>
                                                    <div class="form-row">
                                                        <select id="drpdlistCategory" name="drpdlistCategory" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                                            <option value="none" disabled selected>-- Select Category --</option>
                                                        </select>
                                                        <span class="error-msg" id="categoryErr"></span>
                                                    </div>
                                                </div>
                                                <div class="row-col">
                                                    <div class="form-row">
                                                        <label id="lblSubCategory" for="drpdlistSubCategory" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">Sub Category :</label><br />
                                                    </div>
                                                    <div class="form-row">
                                                        <select id="drpdlistSubCategory" name="drpdlistSubCategory" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                                            <option value="none" disabled selected>-- Select Category first --</option>
                                                        </select>
                                                        <span class="error-msg" id="subcategoryErr"></span>
                                                    </div>
                                                </div>
                                                <div class="row-col">
                                                    <div class="form-row">
                                                        <label id="lblServiceType" for="drpdlistServiceType" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">Service Type :</label><br />
                                                    </div>
                                                    <div class="form-row">
                                                        <select id="drpdlistServiceType" name="drpdlistServiceType" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                                            <option value="none" disabled selected>-- Select Service Type --</option>
                                                            <option value="B">Basic</option>
                                                            <option value="M">Medium</option>
                                                            <option value="A">Advance</option>
                                                        </select>
                                                        <span class="error-msg" id="ServiceTypeErr"></span>
                                                    </div>
                                                </div>
                                                <div class="row-col">
                                                    <div class="form-row">
                                                        <label id="lblDeliveryDays" for="txtDeliveryDays" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">Delivery Days :</label><br />
                                                        <input type="number" id="txtDeliveryDays" name="txtDeliveryDays" class="form-control mb-1 p-4" placeholder="Delivery Days" min="1" max="30" maxlength="2" required />
                                                        <span class="error-msg" id="DeliveryDaysErr"></span>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <label id="lblServiceImg" for="imgServiceImg" class="mt-3 mb-1 ml-1 color-12192C font-weight-bold">Service image :</abel>
                                                </div>
                                                <div class="form-row">
                                                    <input type="file" id="imgServiceImg" name="imgServiceImg" required />
                                                    <span class="error-msg" id="serviceImgErr"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right mt-4 mb-5">
                                    <div class="col-6">
                                        <div class="form-row">
                                            <div class="loadingButton">
                                                <input type="submit" name="btnAdd" id="btnAdd" value="Add Service" class="btn Btn1 bg-color-F5A623 color-12192C font-weight-bolder border-0" />
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
        <?php
        require_once '../../widgets/footer.php';
        ?>
       <script src="/FSMS/assets/js/scroll.js"></script>
        <script src="/FSMS/assets/js/main.js"></script>
        <script src="/FSMS/assets/js/load-categories.js"></script>
        <script src="/FSMS/assets/js/validate-service.js"></script>

    </body>

    </html>
<?php } ?>
<?php
session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === false) {
    header("Location: /FSMS/");
} else {
    require_once '../php/config.php';
    require_once '../php/constants.php';
    require_once '../php/functions.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Update Profile | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "../widgets/head-link-with-profile.php";
        ?>

    </head>

    <body class="bg-color-900c3f">
        <?php
        require_once '../widgets/header.php';
        ?>
        <div class="main-wrapper">
            <?php
            require_once "../widgets/sidebar.php";
            ?>
            <div class="main-content bg-color-900c3f" id="main-content">
                <div class="container col-12">
                    <div class="row rd-30 no-gutters justify-content-md-center shadow-lg px-5 py-5 bg-color-12192C">
                        <div class="col-10 align-items-center pt-3 py-4">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h1><label id="lblRegistration" class="h1 text-white font-weight-bold">Profile</label></h1>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="" class="btn btn-primary btn-lg active">Edit</a>
                                </div>
                            </div>
                            <hr class="bg-light" />
                            <!-- <label id="lblmsg" class="error-msg align-content-center">!!! Error while registering you please try later</label> -->
                            <!-- <div class="col-10 justify-content-md-center"> -->
                                <form id="frmProfile" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <?php
                                    $selectquery = "SELECT * FROM tbluserpersonaldetails WHERE `UserID`={$_SESSION['UserID']}";
                                    $query = mysqli_query($dbConn, $selectquery);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        

                                        <!-- ---------------------------- Peronal Details ---------------------------- -->
                                        <h2 class="bg-white rd-tl-tr-30 m-0 mb-1 pl-5 p-2 col-4"><label name="lblPersonalDetails" class="h3 font-weight-bold" Style="color: #12192C">Personal Details</label></h2>
                                        <div class="col-12 px-5 py-4 bg-white rd-bl-30 rd-br-30 rd-tr-30">
                                            <div class="pl-4">
                                                <div class="row">
                                                    <div class="col-10 pb-3 pl-5">
                                                        <div class="form-row">
                                                            <label id="lblFname" for="txtFname" class="mb-1 ml-1 color-12192C font-weight-bold">First name :</label>
                                                            <input type="text" id="txtFname" value="<?php echo $row['FirstName'] ?>" name="txtFname" class="form-control mb-1 p-4" placeholder="First name" required />
                                                            <span class="error-msg" id="firstnameErr"></span>
                                                        </div>
                                                        <div class="form-row">
                                                            <label for="txtLname" id="lblLname" class=" mb-1 mt-3 ml-1 color-12192C font-weight-bold">Last name :</label>
                                                            <input type="text" id="txtLname" value="<?php echo $row['LastName'] ?>" name="txtLname" class="form-control mb-1 p-4" placeholder="Last name" required />
                                                            <span class="error-msg" id="lastnameErr"></span>
                                                        </div>
                                                        <div class="form-row">
                                                            <label id="lblDob" for="txtDob" class="mb-1 ml-1 mt-3 color-12192C font-weight-bold">Date of Birth :</label>
                                                            <input type="date" id="txtDob" value="<?php echo $row['DateOfBirth'] ?>" name="txtDob" class="form-control my-1 p-4" required />
                                                            <span class="error-msg" id="dateofbirthErr"></span>
                                                        </div>

                                                        <div class="form-row mt-4">
                                                            <div class="form-row w-100">
                                                                <label id="lblGender" for="rbtnlistGender" class="ml-1 mb-1 color-12192C font-weight-bold">Gender : </label>
                                                            </div>
                                                            <div class="form-row w-100">
                                                                <div id="rbtnlistGender">
                                                                    <?php
                                                                    if ($row['Gender'] == 'M') { ?>

                                                                        <input type="radio" id="rbtnlistGenderM" name="rbtnlistGender" class="form-check-inline ml-3" value="Male" required checked />
                                                                        <label for="rbtnlistGenderM" class="form-check-label">Male</label>
                                                                        <input type="radio" id="rbtnlistGenderF" name="rbtnlistGender" class="form-check-inline ml-3" value="Female" required />
                                                                        <label for="rbtnlistGenderF" class="form-check-label">Female</label>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <input type="radio" id="rbtnlistGenderM" name="rbtnlistGender" class="form-check-inline ml-3" value="Male" required />
                                                                        <label for="rbtnlistGenderM" class="form-check-label">Male</label>
                                                                        <input type="radio" id="rbtnlistGenderF" name="rbtnlistGender" class="form-check-inline ml-3" value="Female" required checked />
                                                                        <label for="rbtnlistGenderF" class="form-check-label">Female</label>
                                                                    <?php
                                                                    } ?>
                                                                </div>
                                                                <span class="error-msg" id="genderErr"></span>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-row">
                                                        <div class="">
                                                            <label id="lblProfileImg" for="imgUserProfile" class="mt-3 mb-1 ml-1 color-12192C font-weight-bold">Profile Picture :</label>
                                                            <br/>
                                                            <input type="file" id="imgUserProfile" name="imgUserProfile" required />
                                                            <span class="error-msg" id="profilepicErr"></span>
                                                        </div>
                                                        <div class="form-col m-3">
                                                            <img id="imgUserProfileImg" src="data:image/jpeg;base64,<?php //echo base64_encode($row['ProfilePicture']); 
                                                                                                                    ?>" height='200px' style="border-radius: 10px;" />
                                                        </div>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ---------------------------- Contact Details ---------------------------- -->
                                        <h2 class="bg-white rd-tl-tr-30 mb-1 mt-5 pl-5 p-2 col-4"><label name="lblContactDetails" class="h3 font-weight-bold" Style="color: #12192C">Contact Details</label></h2>
                                        <div class="col-12 px-5 py-4 bg-white rd-bl-30 rd-br-30 rd-tr-30">
                                            <div class="pl-4">
                                                <div class="row">
                                                    <div class="col-10 pb-3 pl-5">
                                                        <div class="row-col">
                                                            <div class="form-row">
                                                                <label id="lblContacNo" for="drpdlistCountryCode" class="mb-1 mt-3 color-12192C font-weight-bold">Contact No : </label>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-2">
                                                                    <select id="drpdlistCountryCode" name="drpdlistCountryCode" class="rd-10 h-100 px-1 py-2 form-control" disabled>
                                                                        <option value="none" disabled>-- Select Country Code --</option>
                                                                        <option value="+91">+91</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input type="text" id="txtContactNo" value="<?php echo $row['ContactNo'] ?>" name="txtContactNo" class="form-control mb-1 ml-1 p-4" placeholder="Contact No" MaxLength="10" pattern="[6-9]{1}[0-9]{9}" required />
                                                                </div>
                                                                <span class="error-msg" id="contactnumErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <label id="lblAddress" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Address :</label>
                                                            <textarea id="txtAddress" name="txtAddress" class="form-control mb-1 p-4" placeholder="Address" type="text" required><?php echo $row['Address'] ?></textarea>
                                                            <span class="error-msg" id="addressErr"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="loadingButton">
                                                    <input type="submit" name="btnRegister" id="btnRegister" value="Update" class="btn Btn1 bg-color-F5A623 color-12192C font-weight-bolder border-0" />
                                                </div>
                                            </div>
                                            <div class="main-wrapper">
                                                <?php
                                                $userid = $_SESSION['UserID'];  //47; //
                                                $username = $_SESSION['Username']; //"kaksh1234";// //
                                                $role = $_SESSION['RoleID']; //3;// //


                                                if (isset($_POST['btnRegister'])) {

                                                    $fname = $_POST['txtFname'];
                                                    $last = $_POST['txtLname'];
                                                    $dob = $_POST['txtDob'];
                                                    $Gender = $_POST['rbtnlistGender'];
                                                    if ($Gender == "Male") {
                                                        $Gender = "M";
                                                    } else if ($Gender == "Female") {
                                                        $Gender = "F";
                                                    }
                                                    $contact = $_POST['txtContactNo'];
                                                    $Address = $_POST['txtAddress'];
                                                    $sqlUpdateStatus = "UPDATE `tbluserpersonaldetails` SET `FirstName`='$fname',`LastName`='$last',`DateOfBirth`='$dob',`Gender`='$Gender',`ContactNo`='$contact',`Address`='$Address',`ContactNo`='$contact' WHERE `UserID`='$userid' AND `Username`= '$username' AND `RoleID`='$role'";
                                                    $query = mysqli_query($dbConn, $sqlUpdateStatus);
                                                    if ($query) {
                                                        echo "updated";
                                                    } else {
                                                        echo "not update";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </form>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php
        require_once '../widgets/footer.php';
        ?>
           <script src="/FSMS/assets/js/scroll.js"></script>
             <script src="/FSMS/assets/js/main.js"></script>
            <script src="/FSMS/assets/js/profile.js"></script>
    </body>

    </html>
<?php
}
?>
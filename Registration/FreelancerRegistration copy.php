<?php session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === TRUE) {
    header("Location: index.php");
} else {
    require_once '../php/config.php';
    require_once '../php/constants.php';
    require_once '../php/functions.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Freelancer Registration | FSMS</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <?php
        require_once "../widgets/head-link.php";
        ?>
    </head>

    <body class="bg-color-12192C">
        <?php
        require_once '../widgets/header.php';
        ?>
        <div><?php $firstnameErr = $lastnameErr = $usernameErr = $passwordErr = $emailErr = $contactnumErr = $genderErr = $dateofbirthErr = $addressErr = $pincodeErr = $profilepicErr = $confpasswordErr = "";
                $firstname = $lastname = $username = $confpassword = $password = $email = $contactnum = $gender = $dateofbirth = $address = $pincode = $profilepic = "";
                $errorMsg = "";
                $GraduationErr = $GraduationYearErr = $OccupationErr = $WorkingExperienceErr = $LastWorkedAtErr = $AboutErr = "";
                $FreelancerID = $Graduation = $GraduationYear = $Occupation = $WorkingExperience = $LastWorkedAt = $About = "";
                $SkillNameErr = $SkillLevelErr =  $ServiceNameErr = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['btnRegister'])) {

                        //check graduation
                        /*if (empty($_POST["txtFname"])) {
                            $firstnameErr = REQFNAME;
                        } else {
                            $firstname = test_input($_POST["txtFname"]);
                            if (!preg_match("MATCHFLNAME", $firstname)) {
                                $firstnameErr = ERRORLETTERALLOWED;
                            }
                        }*/
                        // check first name
                        /*if (empty($_POST["txtFname"])) {
                            $firstnameErr = REQFNAME;
                        } else {
                            $firstname = test_input($_POST["txtFname"]);
                            if (!preg_match("MATCHFLNAME", $firstname)) {
                                $firstnameErr = ERRORLETTERALLOWED;
                            }
                        }
                        // check last name
                        if (empty($_POST["txtLname"])) {
                            $lastnameErr = REQLNAME;
                        } else {
                            $lastname = test_input($_POST["txtLname"]);
                            if (!preg_match("MATCHFLNAME", $lastname)) {
                                $lastnameErr = ERRORLETTERALLOWED;
                            }
                        }*/

                        // check date of birth
                        if (empty($_POST["txtDob"])) {
                            $dateofbirthErr = REQDOB;
                        } else {
                            $dateofbirth = test_input($_POST["txtDob"]);
                            $dateofbirth = DateTime::createFromFormat('Y-m-d', $dateofbirth);
                            if ($dateofbirth) {
                                echo $dateofbirth->format('Y-m-d');
                                $dateofbirth = $dateofbirth->format('Y-m-d');
                            }
                            if (!preg_match(MATCHDOB, $dateofbirth)) {
                                $dateofbirthErr = ERRORDATE;
                            }
                        }

                        // check profile image
                        if (empty($_FILES['imgUserProfile'])) {
                            $profilepicErr = REQPROFILE;
                        } else {
                            $profilepic = $_FILES['imgUserProfile'];
                        }

                        // check gender
                        if (empty($_POST["rbtnlistGender"])) {
                            $genderErr = REQGENDER;
                        } else {
                            $gender = $_POST["rbtnlistGender"];
                            if (!($gender == "Male" || $gender == "Female")) {
                                $genderErr = ERRORGENDER;
                            }
                        }

                        // check email
                        if (empty($_POST["txtEmail"])) {
                            $emailErr = REQEMAIL;
                        } else {
                            $email = test_input($_POST["txtEmail"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $emailErr = ERROREMAIL;
                            }
                        }

                        // check contact no
                        if (empty($_POST["txtContactNo"])) {
                            $contactnumErr = REQCONTACTNO;
                        } else {
                            $contactnum = test_input($_POST["txtContactNo"]);
                            if (!preg_match(MATCHCONTACTNO, $contactnum)) {
                                $contactnumErr = ERRORCONTACTNO;
                            }
                        }

                        // check address
                        if (empty($_POST["txtAddress"])) {
                            $addressErr = REQADDRESS;
                        } else {
                            $address = test_input($_POST["txtAddress"]);
                            if (!preg_match(MATCHADDRESS, $address)) {
                                $addressErr = ERRORADDRESS;
                            }
                        }

                        // check pincode
                        if (empty($_POST["txtPincode"])) {
                            $pincodeErr = ERRORPINCODE;
                        } else {
                            $pincode = test_input($_POST["txtPincode"]);
                            if (!preg_match(MATCHPINCODE, $pincode)) {
                                $$pincodeErr = ERRORPINCODE;
                            }
                        }

                        // check username
                        if (empty($_POST["txtUsername"])) {
                            $usernameErr = REQUSERNAME;
                        } else {
                            $username = test_input($_POST["txtUsername"]);
                            if (!preg_match(MATCHUSERNAME, $username)) {
                                $usernameErr = ERRORUSERNAME;
                            }
                        }

                        // check password
                        if (empty($_POST["txtPasswd"])) {
                            $passwordErr = REQPASSWORD;
                        } else {
                            $password = test_input($_POST["txtPasswd"]);
                            if (!preg_match(MATCHPASSWORD, $password)) {
                                $passwordErr = ERRORPASSWORD;
                            }
                        }

                        // check confirm password
                        if (empty($_POST["txtConfirmPassword"])) {
                            $confpasswordErr = "Confirm " . REQPASSWORD;
                        } else {
                            $confpassword = test_input($_POST["txtConfirmPassword"]);
                            if (!preg_match(MATCHPASSWORD, $confpassword)) {
                                $confpasswordErr = ERRORPASSWORD;
                            }
                        }

                        // check both password & confirm password are same
                        if (!(empty($_POST["txtPasswd"]) && empty($_POST["txtConfirmPassword"]))) {
                            $password = test_input($_POST["txtPasswd"]);
                            $confpassword = test_input($_POST["txtConfirmPassword"]);
                            if (!$password === $confpassword) {
                                $confpasswordErr = MATCHBOTHPASSWORD;
                            }
                        }
                        if ($firstnameErr == "" &&  $lastnameErr == "" &&  $usernameErr == "" && $confpasswordErr == "" && $passwordErr == "" &&  $emailErr == "" &&  $contactnumErr == "" &&  $genderErr == "" &&  $dateofbirthErr == "" &&  $addressErr == "" &&  $pincodeErr == "" && $profilepicErr == "") {
                            require '../php/config.php';
                            if (isset($_POST['btnRegister'])) {
                                $RoleId = 3;
                                $CityID = (int) $_POST['drpdlistCity'];
                                $FirstName = $_POST['txtFname'];
                                $LastName = $_POST['txtLname'];
                                $Username = $_POST['txtUsername'];
                                $Password = $_POST['txtPasswd'];
                                $Email = $_POST['txtEmail'];
                                $ContactNo = $_POST['txtContactNo'];
                                $Gender = $_POST['rbtnlistGender'];
                                if ($Gender == "Male") {
                                    $Gender = "M";
                                } else if ($Gender == "Female") {
                                    $Gender = "F";
                                }
                                $DateOfBirth = $_POST['txtDob'];
                                $Address = $_POST['txtAddress'];
                                $Pincode = $_POST['txtPincode'];

                                $Graduation = $_POST['txtGraduation'];
                                $GraduationYear = $_POST['drpdlistGraduationYear'];
                                $Occupation = $_POST['txtOccupation'];
                                $WorkingExperience = $_POST['txtWorkingExperience'];
                                $About = $_POST['txtAbout'];
                                $LastWorkedAt = $_POST['txtLastWorkedAt'];
                                $SkillName = $_POST['txtSkillName'];
                                $SkillLevel = $_POST['drpdlistSkillLevel'];
                                $ServiceName = $_POST['txtServiceName'];
                                $DateOfJoining = date("Y-m-d h:i:s");
                                $AccountStatus = 'P';
                                $UserStatus = 0;
                                echo $DateOfJoining;
                                $traget_dir = "../user-content/profile/";
                                $ProfilePicturePATH = $traget_dir . date("Ymdhis") . basename($_FILES['imgUserProfile']['name']);
                                if (move_uploaded_file($_FILES["imgUserProfile"]["tmp_name"], $ProfilePicturePATH)) {
                ?>
                                <img src="<?php echo $GLOBALS['ProfilePicturePATH']; ?>" height="200" /><br /><br />
            <?php
                                } else {

                                    echo 'Error in file uploading';
                                }

                                $sqlRegister = "INSERT INTO tbluserpersonaldetails (RoleId, CityID, FirstName, LastName, Username, Password, Email, ContactNo, Gender, DateOfBirth, Address, Pincode,DateOfJoining, ProfilePicture, AccountStatus, UserStatus) VALUES ('$RoleId', '$CityID', '$FirstName', '$LastName', '$Username', '$Password', '$Email', '$ContactNo','$Gender', '$DateOfBirth', '$Address', '$Pincode', '$DateOfJoining', '$ProfilePicturePATH', '$AccountStatus', '$UserStatus')";

                                $queryRegister = mysqli_query($dbConn, $sqlRegister);
                                if ($queryRegister) {
                                    $sqlselectfreelancerid = "SELECT `UserID` FROM tbluserpersonaldetails WHERE Username='$Username' AND Email='$Email'";
                                    $queryselectfreelancerid = mysqli_query($dbConn, $sqlSelect);
                                    if ($queryselectfreelancerid) {
                                        if (mysqli_num_rows($queryselectfreelancerid) > 0) {
                                            $row = mysqli_fetch_array($queryselectfreelancerid);
                                            $UserID = (int)  $row['UserID'];
                                            $sqlprofessionaldetails = "INSERT INTO tblfreelancerprofessionaldetails (FreelancerID,Graduation,GraduationYear,Occupation,WorkingExperience,LastWorkedAt,About) VALUES('$UserID','$Graduation','$GraduationYear','$Occupation','$WorkingExperience','$LastWorkedAt','$About')";

                                            $professionaldetails = mysqli_query($dbConn, $sqlprofessionaldetails);
                                            if ($professionaldetails) {
                                                $sqlSkill = "INSERT INTO tblskill(FreelancerID,SkillName,SkillLevel)VALUES('$UserID','$SkillName','$SkillLevel')";
                                                $querySkill = mysqli_query($dbConn, $sqlSkill);
                                                if ($querySkill) {
                                                    $sqltblservicetype = "INSERT INTO tblservicetype(FreelancerID,ServiceName)VALUES('$UserID','$ServiceName')";
                                                    $queryservicetype = mysqli_query($dbConn, $sqltblservicetype);
                                                    echo "<script>window.location.href='../Login.php'</script>";
                                                } else {
                                                    echo mysqli_error($dbConn);
                                                }
                                            } else {
                                                echo mysqli_error($dbConn);
                                            }
                                        } else {
                                            echo mysqli_error($dbConn);
                                        }
                                    }
                                } else {
                                    echo mysqli_error($dbConn);
                                }
                            }
                        }
                    }
                }

            ?>
        </div>
        <div class="pt-5">
            <div class="container col-10 my-5 pb-5">
                <div class="row rd-30 no-gutters justify-content-md-center shadow-lg px-5 pt-5 bg-color-F5A623">
                    <div class="col-10 align-items-center pt-3 py-4">
                        <h1><label ID="lblRegistration" class="h1 color-12192C font-weight-bold">Become Freelancer</label></h1>
                        <hr class="bg-color-12192C" />
                        <!-- <label ID="lblmsg" class="error-msg align-content-center">!!! Error while registering you please try later</label> -->
                    </div>
                    <div class="col-10 justify-content-md-center">
                        <form class="cust-reg-form" method="POST" enctype="multipart/form-data">
                            <!-- ---------------------------- Peronal Details ---------------------------- -->
                            <h2 class="bg-white rd-tl-tr-30 m-0 mb-1 pl-5 p-2 col-4"><label name="lblPersonalDetails" class="h3 font-weight-bold color-12192C">Personal Details</label></h2>
                            <div class="col-12 px-5 py-4 bg-white rd-bl-30 rd-br-30 rd-tr-30">
                                <div class="pl-4">
                                    <div class="row">
                                        <div class="col-10 pb-3 pl-5">
                                            <div class="form-row">
                                                <label ID="lblFname" for="txtFname" class="mb-1 ml-1 color-12192C font-weight-bold">First name :</label>
                                                <input type="text" ID="txtFname" name="txtFname" class="form-control mb-1 p-4" placeholder="First name" required />
                                                <span class="error-msg"><?php echo $firstnameErr; ?></span>
                                            </div>
                                            <div class="form-row">
                                                <label for="txtLname" ID="lblLname" class=" mb-1 mt-3 ml-1 color-12192C font-weight-bold">Last name :</label>
                                                <input type="text" ID="txtLname" name="txtLname" class="form-control mb-1 p-4" placeholder="Last name" required />
                                                <span class="error-msg"><?php echo $lastnameErr; ?></span>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblDob" for="txtDob" class="mb-1 ml-1 mt-3 color-12192C font-weight-bold">Date of Birth :</label>
                                                <input type="date" ID="txtDob" name="txtDob" class="form-control my-1 p-4" placeholder="yyyy-mm-dd" required />
                                                <span class="error-msg"><?php echo $dateofbirthErr; ?></span>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblProfileImg" for="imgUserProfile" class="mt-3 mb-1 ml-1 color-12192C font-weight-bold">Profile Picture :</abel>
                                            </div>
                                            <div class="form-row">
                                                <input type="file" ID="imgUserProfile" name='imgUserProfile' required />
                                                <span class="error-msg"><?php echo $profilepicErr; ?></span>
                                            </div>
                                            <div class="form-row mt-4">
                                                <div class="form-row w-100">
                                                    <label ID="lblGender" for="rbtnlistGender" class="ml-1 mb-1 color-12192C font-weight-bold">Gender : </label>
                                                </div>
                                                <div class="form-row w-100">
                                                    <div id="rbtnlistGender">
                                                        <input type="radio" ID="rbtnlistGenderM" name="rbtnlistGender" class="form-check-inline ml-3" value="Male" required />
                                                        <label for="rbtnlistGenderM" class="form-check-label">Male</label>
                                                        <input type="radio" ID="rbtnlistGenderF" name="rbtnlistGender" class="form-check-inline ml-3" value="Female" required />
                                                        <label for="rbtnlistGenderF" class="form-check-label">Female</label>
                                                    </div>
                                                </div>
                                                <span class="error-msg"><?php echo $genderErr; ?></span>
                                            </div>
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
                                            <div class="form-row">
                                                <label ID="lblEmail" for="txtEmail" class="mb-1 ml-1 color-12192C font-weight-bold">Email Id :</label>
                                                <input type="email" name="txtEmail" id="txtEmail" class="form-control mb-1 p-4" placeholder="Enter email address" pattern="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" required />
                                                <span class="error-msg"><?php echo $emailErr; ?></span>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblContacNo" for="drpdlistCountryCode" class="mb-1 mt-3 color-12192C font-weight-bold">Contact No : </label>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-2">
                                                        <select ID="drpdlistCountryCode" name="drpdlistCountryCode" class="rd-10 h-100 px-1 py-2 form-control" disabled>
                                                            <option value="none" disabled>-- Select Country Code --</option>
                                                            <option value="+91">+91</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" ID="txtContactNo" name="txtContactNo" class="form-control mb-1 ml-1 p-4" placeholder="Contact No" MaxLength="10" pattern="\d{10}" required />
                                                    </div>
                                                    <span class="error-msg"><?php echo $contactnumErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblAddress" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Address :</label>
                                                <input ID="txtAddress" name="txtAddress" class="form-control mb-1 p-4" placeholder="Address" type="text" required />
                                                <span class="error-msg"><?php echo $addressErr; ?></span>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label id="lblCity" for="drpdlistCity" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">City :</label><br />
                                                </div>
                                                <div class="form-row">
                                                    <select id="drpdlistCity" name="drpdlistCity" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                                        <option value="none" disabled selected>-- Select State first --</option>
                                                    </select>
                                                    <span class="error-msg" id="cityErr"></span>
                                                </div>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label id="lblState" for="drpdlistState" class="mb-1 ml-1  mt-3 color-12192C font-weight-bold">State :</label>
                                                </div>
                                                <div class="form-row">
                                                    <select id="drpdlistState" name="drpdlistState" class="rd-10 h-auto px-2 py-3 form-control" Width="10px" required>
                                                    </select>
                                                    <span class="error-msg" id="stateErr"></span>
                                                </div>
                                            </div>

                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblCountry" for="drpdlistCountry" class="mb-1 ml-1  mt-3 color-12192C font-weight-bold">Country :</label>
                                                </div>
                                                <div class="form-row">
                                                    <select ID="drpdlistCountry" name="drpdlistCountry" class="rd-10 h-auto px-2 py-3 form-control" disabled required>
                                                        <option value="none" disabled>-- Select Country --</option>
                                                        <option value="India">India</option>
                                                    </select>
                                                    <!-- <span class="error-msg"><?php //echo $CountryErr; 
                                                                                    ?></span> -->
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblPincode" for="txtPincode" class="mb-1 ml-1 mt-3  color-12192C font-weight-bold">Pincode :</label>
                                                <input ID="txtPincode" name="txtPincode" class="form-control mb-1 p-4" placeholder="Pincode" MaxLength="6" pattern="\d{6}" />
                                                <span class="error-msg"><?php echo $pincodeErr; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-----profesional details----------->
                            <h2 class="bg-white rd-tl-tr-30 mb-1 mt-5 pl-5 p-2 col-4"><label name="lblProfessionalDetail" class="h3 font-weight-bold" Style="color: #12192C">Professional Detail</label></h2>
                            <div class="col-12 px-5 py-4 bg-white rd-bl-30 rd-br-30 rd-tr-30">
                                <div class="pl-4">
                                    <div class="row">

                                        <div class="col-10 pb-3 pl-5">
                                            <div class="form-row">
                                                <label ID="lblGraduation" for="txtGraduation" class="mb-1 ml-1 color-12192C font-weight-bold">Graduation:</label>
                                                <input type="text" name="txtGraduation" id="txtGraduation" class="form-control mb-1 p-4" placeholder="Enter Graduation" required />
                                                <span class="error-msg"><?php echo $GraduationErr; ?></span>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblGraduationYear" for="drpdlistGraduationYear" class="mb-1 mt-3 color-12192C font-weight-bold">GraduationYear </label>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-2">
                                                        <select ID="drpdlistGraduationYear" name="drpdlistGraduationYear" class="rd-10 h-100 px-1 py-2 form-control">
                                                            <option value="none" disabled>-- Select Graduation Year --</option>
                                                            <?php
                                                            for ($i = 2021; $i > 1990; $i--) {
                                                                echo "<option value='" . $i . "'>" . $i . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <span class="error-msg"><?php echo $GraduationYearErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <label ID="lblOccupation" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Occupation :</label>
                                                <input ID="txtOccupation" name="txtOccupation" class="form-control mb-1 p-4" placeholder="Occupation" type="text" required />
                                                <span class="error-msg"><?php echo $OccupationErr; ?></span>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblWorkingExperience" for="txtWorkingExperience" class=" mb-1 ml-1 mt-3 color-12192C font-weight-bold">WorkingExperience :</label><br />
                                                </div>
                                                <div>
                                                    <input ID="txtWorkingExperience" name="txtWorkingExperience" class="form-control mb-1 p-4" placeholder="Enter Working Experience" type="number" min="0" max="50" maxlength="2" required />
                                                    <span class="error-msg"><?php echo $WorkingExperienceErr; ?></span>
                                                </div>
                                            </div>

                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblLastWorkedAt" for="txtLastWorkedAt" class="mb-1 ml-1  mt-3 color-12192C font-weight-bold">LastWorkedAt :</label>
                                                </div>
                                                <div>
                                                    <input ID="txtLastWorkedAt" name="txtLastWorkedAt" class="form-control mb-1 p-4" placeholder="Enter LastWorkedAt" type="text" required />
                                                    <span class="error-msg"><?php echo $LastWorkedAtErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="row-col">
                                                <div class="form-row">
                                                    <label ID="lblAbout" for="txtAbout" class="mb-1 ml-1  mt-3 color-12192C font-weight-bold">About :</label>
                                                </div>
                                                <div>
                                                    <input ID="txtAbout" name="txtAbout" class="form-control mb-1 p-4" placeholder=" Enter About Your Self" type="textarea" required />
                                                    <span class="error-msg"><?php echo $AboutErr; ?></span>
                                                </div>
                                            </div>

                                            <div class="form-row ">
                                                <label ID="lblSkillName" for="txtSkillName" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">SkillName :</label>
                                                <input ID="txtSkillName" name="txtSkillName" class="form-control mb-1 p-4" maxlength="16" placeholder="Enter SkillName" required />
                                                <span class="error-msg"><?php echo $SkillNameErr; ?></span>
                                            </div>
                                            <div class="form-row ">
                                                <label ID="lblSkillLevel" for="drpdlistSkillLevel" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">SkillLevel :</label>
                                                <select ID="drpdlistSkillLevel" name="drpdlistSkillLevel" class="rd-10 h-100 px-1 py-2 form-control">
                                                    <option value="none" disabled>-- Select SkillLevel --</option>
                                                    <option value="Beginner">Beginner</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Advance">Advance</option>
                                                </select>
                                                <span class="error-msg"><?php echo $SkillLevelErr; ?></span>
                                            </div>
                                            <div class="form-row ">
                                                <label ID="lblServiceName" for="txtServiceName" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">ServiceName :</label>
                                                <input ID="txtServiceName" name="txtServiceName" class="form-control mb-1 p-4" placeholder="Enter ServiceName" required />
                                                <span class="error-msg"><?php echo $ServiceNameErr; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!----------------------- Login Details ------------------------------ -->
                            <h2 class="bg-white rd-tl-tr-30 mb-1 mt-5 pl-5 p-2 col-4"><label name="lblLoginDetails" class="h3 font-weight-bold" Style="color: #12192C">Login Details</label></h2>
                            <div class="col-12 px-5 py-4 bg-white rd-bl-30 rd-br-30 rd-tr-30">
                                <div class="pl-4">
                                    <div class="row">
                                        <div class="col-10 pb-3 pl-5">
                                            <div class="form-row ">
                                                <label id="lblUsername" for="txtUsername" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Username :</label>
                                                <input id="txtUsername" name="txtUsername" class="form-control mb-1 p-4" maxlength="16" placeholder="Enter username here" required />
                                                <span class="error-msg" id="usernameErr"></span>
                                            </div>
                                            <div class="form-row">
                                                <label id="lblPassword" for="txtPasswd" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Password :</label>
                                                <div class="input-group">
                                                    <input type="password" id="txtPasswd" name="txtPasswd" class="form-control my-3 mt-0 p-4" placeholder="Password" required /><!-- pattern="(^.{8,16}$)(.*\d)(.*[a-z])(.*[A-Z])(.*[!@#$%^&*()_+}{:;'?/.<>;,])(?!.*\s).*$"/> -->
                                                    <div class="input-group-append">
                                                        <button id="show_password" class="btn border-13eb86 border-left-0 bg-transparent my-3" type="button">
                                                            <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="error-msg" id="passwordErr"></span>
                                            </div>
                                            <div class="form-row">
                                                <label id="lblConfirmPassword" for="txtConfirmPassword" class=" mb-1 ml-1 mt-3  color-12192C font-weight-bold">Confirm Password :</label>
                                                <div class="input-group">
                                                    <input type="password" id="txtConfirmPassword" name="txtConfirmPassword" class="form-control my-3 mt-0 p-4" placeholder="Re-Enter password here" required />
                                                    <!-- pattern="(^.{8,16}$)(.*\d)(.*[a-z])(.*[A-Z])(.*[!@#$%^&*()_+}{:;'?/.<>;,])(?!.*\s).*$"/> -->
                                                    <div class="input-group-append">
                                                        <button id="show_conf_password" class="btn border-13eb86 border-left-0 bg-transparent my-3" type="button">
                                                            <i class="fa fa-eye rd-0 rd-tr-10"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="error-msg" id="confpasswordErr"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ---------------------------- Already have an account & Register button ------------------------------ -->
                            <div class="row-col my-4">
                                <div class="col-6">
                                    <div class="float-left my-4">
                                        <div class="form-row">
                                            <label ID="lblAlreadyAccount" class="color-12192C">Already have an account?</label>
                                        </div>
                                        <div class="form-row">
                                            <a href="../Login.php" class="Link3">Login to your account</a></ </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right my-4">
                                    <div class="col-6">
                                        <div class="form-row">
                                            <input type="submit" name="btnRegister" id="btnRegister" value="Register" class="btn Btn1 font-weight-bolder border-0" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../widgets/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="/FSMS/assets/js/scroll.js"></script>
        <script src="/FSMS/assets/js/load-state-city.js"></script>
        <script src="/FSMS/assets/js/show-password.js"></script>
        <script src="/FSMS/assets/js/validate-freelancer-registration.js"></script>

    </body>

    </html>
<?php } ?>
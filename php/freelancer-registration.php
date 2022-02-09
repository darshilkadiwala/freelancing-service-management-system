<?php
require './config.php';
require './constants.php';
require './functions.php';

$firstnameErr = $lastnameErr = $usernameErr = $passwordErr = $emailErr = $contactnumErr = $genderErr = $dateofbirthErr = $addressErr = $pincodeErr = $profilepicErr = $confpasswordErr = "";
$firstname = $lastname = $username = $confpassword = $password = $email = $contactnum = $gender = $dateofbirth = $address = $pincode = $profilepic = "";
$errorMsg = "";
$GraduationErr = $GraduationYearErr = $OccupationErr = $WorkingExperienceErr = $LastWorkedAtErr = $AboutErr = "";
$FreelancerID = $Graduation = $GraduationYear = $Occupation = $WorkingExperience = $LastWorkedAt = $About = "";
$SkillNameErr = $SkillLevelErr =  $ServiceNameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    // if (empty($_POST["txtDob"])) {
    //     $dateofbirthErr = REQDOB;
    // } else {
    //     $dateofbirth = test_input($_POST["txtDob"]);
    //     $dateofbirth = DateTime::createFromFormat('Y-m-d', $dateofbirth);
    //     if ($dateofbirth) {
    //         echo $dateofbirth->format('Y-m-d');
    //         $dateofbirth = $dateofbirth->format('Y-m-d');
    //     }
    //     if (!preg_match(MATCHDOB, $dateofbirth)) {
    //         $dateofbirthErr = ERRORDATE;
    //     }
    // }

    // // check profile image
    // if (empty($_FILES['imgUserProfile'])) {
    //     $profilepicErr = REQPROFILE;
    // } else {
    //     $profilepic = $_FILES['imgUserProfile'];
    // }

    // // check gender
    // if (empty($_POST["rbtnlistGender"])) {
    //     $genderErr = REQGENDER;
    // } else {
    //     $gender = $_POST["rbtnlistGender"];
    //     if (!($gender == "Male" || $gender == "Female")) {
    //         $genderErr = ERRORGENDER;
    //     }
    // }

    // // check email
    // if (empty($_POST["txtEmail"])) {
    //     $emailErr = REQEMAIL;
    // } else {
    //     $email = test_input($_POST["txtEmail"]);
    //     // check if e-mail address is well-formed
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //         $emailErr = ERROREMAIL;
    //     }
    // }

    // // check contact no
    // if (empty($_POST["txtContactNo"])) {
    //     $contactnumErr = REQCONTACTNO;
    // } else {
    //     $contactnum = test_input($_POST["txtContactNo"]);
    //     if (!preg_match(MATCHCONTACTNO, $contactnum)) {
    //         $contactnumErr = ERRORCONTACTNO;
    //     }
    // }

    // // check address
    // if (empty($_POST["txtAddress"])) {
    //     $addressErr = REQADDRESS;
    // } else {
    //     $address = test_input($_POST["txtAddress"]);
    //     if (!preg_match(MATCHADDRESS, $address)) {
    //         $addressErr = ERRORADDRESS;
    //     }
    // }

    // // check pincode
    // if (empty($_POST["txtPincode"])) {
    //     $pincodeErr = ERRORPINCODE;
    // } else {
    //     $pincode = test_input($_POST["txtPincode"]);
    //     if (!preg_match(MATCHPINCODE, $pincode)) {
    //         $$pincodeErr = ERRORPINCODE;
    //     }
    // }

    // // check username
    // if (empty($_POST["txtUsername"])) {
    //     $usernameErr = REQUSERNAME;
    // } else {
    //     $username = test_input($_POST["txtUsername"]);
    //     if (!preg_match(MATCHUSERNAME, $username)) {
    //         $usernameErr = ERRORUSERNAME;
    //     }
    // }

    // // check password
    // if (empty($_POST["txtPasswd"])) {
    //     $passwordErr = REQPASSWORD;
    // } else {
    //     $password = test_input($_POST["txtPasswd"]);
    //     if (!preg_match(MATCHPASSWORD, $password)) {
    //         $passwordErr = ERRORPASSWORD;
    //     }
    // }

    // // check confirm password
    // if (empty($_POST["txtConfirmPassword"])) {
    //     $confpasswordErr = "Confirm " . REQPASSWORD;
    // } else {
    //     $confpassword = test_input($_POST["txtConfirmPassword"]);
    //     if (!preg_match(MATCHPASSWORD, $confpassword)) {
    //         $confpasswordErr = ERRORPASSWORD;
    //     }
    // }

    // // check both password & confirm password are same
    // if (!(empty($_POST["txtPasswd"]) && empty($_POST["txtConfirmPassword"]))) {
    //     $password = test_input($_POST["txtPasswd"]);
    //     $confpassword = test_input($_POST["txtConfirmPassword"]);
    //     if (!$password === $confpassword) {
    //         $confpasswordErr = MATCHBOTHPASSWORD;
    //     }
    // }
    // if ($firstnameErr == "" &&  $lastnameErr == "" &&  $usernameErr == "" && $confpasswordErr == "" && $passwordErr == "" &&  $emailErr == "" &&  $contactnumErr == "" &&  $genderErr == "" &&  $dateofbirthErr == "" &&  $addressErr == "" &&  $pincodeErr == "" && $profilepicErr == "") {
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = array();
    $RoleId = 2;
    $CityID = (int) test_input($_POST['drpdlistCity']);
    $FirstName = test_input(ucwords($_POST['txtFname']));
    $LastName = test_input(ucwords($_POST['txtLname']));
    $Username = test_input($_POST['txtUsername']);
    $Password = test_input($_POST['txtPasswd']);
    $Email = test_input($_POST['txtEmail']);
    $ContactNo = test_input($_POST['txtContactNo']);
    $Gender = test_input($_POST['rbtnlistGender']);
    if ($Gender == "Male") {
        $Gender = "M";
    } else if ($Gender == "Female") {
        $Gender = "F";
    }
    $DateOfBirth = test_input($_POST['txtDob']);
    $Address = test_input($_POST['txtAddress']);
    $Pincode = test_input($_POST['txtPincode']);
    $Graduation = test_input($_POST['txtGraduation']);
    $GraduationYear = test_input($_POST['drpdlistGraduationYear']);
    $Occupation = test_input($_POST['txtOccupation']);
    $WorkingExperience = test_input($_POST['txtWorkingExperience']);
    $About = test_input($_POST['txtAbout']);
    $LastWorkedAt = test_input($_POST['txtLastWorkedAt']);
    $SkillName = test_input($_POST['txtSkillName']);
    $SkillLevel = test_input($_POST['drpdlistSkillLevel']);
    $ServiceName = test_input($_POST['txtServiceName']);
    //$DateOfJoining = date("Y-m-d h:i:s");

    $AccountStatus = 'P';
    $UserStatus = 0;
    if (isset($_FILES['imgUserProfile']['name'])) {
        $profileImg = $_FILES['imgUserProfile']['tmp_name'];
        $profileImg = addslashes(file_get_contents($profileImg));
        $sqlRegister = "INSERT INTO tbluserpersonaldetails (RoleId, CityID, FirstName, LastName, Username, Password, Email, ContactNo, Gender, DateOfBirth, Address, Pincode, ProfilePicture, AccountStatus, UserStatus) VALUES ('$RoleId', '$CityID', '$FirstName', '$LastName', '$Username', MD5('$Password'), '$Email', '$ContactNo','$Gender', '$DateOfBirth', '$Address', '$Pincode', '$profileImg', '$AccountStatus', '$UserStatus')";

        $queryRegister = mysqli_query($dbConn, $sqlRegister);
        if ($queryRegister) {
            $sqlselectfreelancerid = "SELECT `UserID` FROM tbluserpersonaldetails WHERE Username='$Username' AND Email='$Email'";
            $queryselectfreelancerid = mysqli_query($dbConn, $sqlselectfreelancerid);
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
                            $result[] = array("error" => "1");
                        } else {
                            $result[] = array("error" =>  mysqli_error($dbConn));
                        }
                    } else {
                        $result[] = array("error" =>  mysqli_error($dbConn));
                    }
                } else {
                    $result[] = array("error" =>  mysqli_error($dbConn));
                }
            }
        } else {
            $result[] = array("error" =>  mysqli_error($dbConn));
        }
    }
    header("content-type: application/json"); //this
    echo json_encode($result); //this
}

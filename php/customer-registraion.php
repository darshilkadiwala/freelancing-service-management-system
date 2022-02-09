<?php
require './config.php';
require './constants.php';
require './functions.php';
// $firstnameErr = $lastnameErr = $usernameErr = $passwordErr = $emailErr = $contactnumErr = $genderErr = $dateofbirthErr = $addressErr = $pincodeErr = $profilepicErr = $confpasswordErr = "";
// $firstname = $lastname = $username = $confpassword = $password = $email = $contactnum = $gender = $dateofbirth = $address = $pincode = $profilepic = "";
// $errorMsg = "";
// // check first name
// if (empty($_POST["txtFname"])) {
//     $firstnameErr = REQFNAME;
// } else {
//     $firstname = test_input($_POST["txtFname"]);
//     if (!preg_match(MATCHFLNAME, $firstname)) {
//         $firstnameErr = ERRORLETTERALLOWED;
//     }
// }
// // check last name
// if (empty($_POST["txtLname"])) {
//     $lastnameErr = REQLNAME;
// } else {
//     $lastname = test_input($_POST["txtLname"]);
//     if (!preg_match(MATCHFLNAME, $lastname)) {
//         $lastnameErr = ERRORLETTERALLOWED;
//     }
// }

// // check date of birth
// if (empty($_POST["txtDob"])) {
//     $dateofbirthErr = REQDOB;
// } else {
//     $dateofbirth = test_input($_POST["txtDob"]);
//     $dateofbirth = DateTime::createFromFormat('Y-m-d', $dateofbirth);
//     if ($dateofbirth) {
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
//     if (!preg_match(MATCHEMAIL, $email)) {
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
//     $password = test_password_input($_POST["txtPasswd"]);
//     if (!preg_match(MATCHPASSWORD, $password)) {
//         $passwordErr = ERRORPASSWORD;
//     }
// }

// // check confirm password
// if (empty($_POST["txtConfirmPassword"])) {
//     $confpasswordErr = "Confirm " . REQPASSWORD;
// } else {
//     $confpassword = test_password_input($_POST["txtConfirmPassword"]);
//     if (!preg_match(MATCHPASSWORD, $confpassword)) {
//         $confpasswordErr = ERRORPASSWORD;
//     }
// }

// // check both password & confirm password are same
// if (!(empty($_POST["txtPasswd"]) && empty($_POST["txtConfirmPassword"]))) {
//     $password = test_password_input($_POST["txtPasswd"]);
//     $confpassword = test_password_input($_POST["txtConfirmPassword"]);
//     if (!$password === $confpassword) {
//         $confpasswordErr = MATCHBOTHPASSWORD;
//     }
// }
// if (
//     $firstnameErr == "" &&  $lastnameErr == "" &&  $usernameErr == "" && $confpasswordErr == "" &&
//     $passwordErr == "" &&  $emailErr == "" &&  $contactnumErr == "" &&  $genderErr == "" &&  $dateofbirthErr == ""
//     &&  $addressErr == "" &&  $pincodeErr == "" && $profilepicErr == ""
// ) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = array();
    $RoleId = 3;
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
    //$DateOfJoining = date("Y-m-d h:i:s");
    $AccountStatus = 'P';
    $UserStatus = 0;
    if (isset($_FILES['imgUserProfile']['name'])) {
        $profileImg = $_FILES['imgUserProfile']['tmp_name'];
        $profileImg1 = addslashes(file_get_contents($profileImg));
        // $result[] = array("error" => $profileImg);
        $sqlRegister = "INSERT INTO tbluserpersonaldetails (RoleId, CityID, FirstName, LastName, Username, Password, Email, ContactNo, Gender, DateOfBirth, Address, Pincode,
                 ProfilePicture, AccountStatus, UserStatus) VALUES ('$RoleId', '$CityID', '$FirstName', '$LastName', '$Username', MD5('$Password'), '$Email', '$ContactNo',
                  '$Gender', '$DateOfBirth', '$Address', '$Pincode', '$profileImg1', '$AccountStatus', '$UserStatus')";
        $query = mysqli_query($dbConn, $sqlRegister);

        if ($query) {
            // echo "<script>window.location.href='../Login.php'</script>";
            $result[] = array("error" => "1");
        } else {
            $result[] = array("error" => $dbConn);
        }
        // }
    } else {
        $result[] = array("error" => "Please select profile picture...");
    }
    header("content-type: application/json"); //this
    echo json_encode($result); //this
}

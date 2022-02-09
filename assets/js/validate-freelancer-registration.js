var loadingButton = document.querySelector('.loadingButton');
const form = document.querySelector("form#frmFreeReg"),
    btnRegister = form.querySelector("input#btnRegister"),
    txtFname = form.querySelector("input#txtFname"),
    txtLname = form.querySelector("input#txtLname"),
    txtDob = form.querySelector("input#txtDob"),
    imgUserProfile = form.querySelector("input#imgUserProfile"),
    rbtnlistGender = form.querySelector("input[name=rbtnlistGender]"),
    txtEmail = form.querySelector("input#txtEmail"),
    txtContactNo = form.querySelector("input#txtContactNo"),
    txtAbout = form.querySelector("input#txtAbout"),
    txtAddress = form.querySelector("textarea#txtAddress"),
    drpdlistCity = form.querySelector("#drpdlistCity"),
    drpdlistState = form.querySelector("#drpdlistState"),
    txtPincode = form.querySelector("input#txtPincode"),
    txtGraduation = form.querySelector("input#txtGraduation"),
    drpdlistGraduationYear = form.querySelector("#drpdlistGraduationYear"),
    txtOccupation = form.querySelector("input#txtOccupation"),
    txtWorkingExperience = form.querySelector("input#txtWorkingExperience"),
    txtLastWorkedAt = form.querySelector("input#txtLastWorkedAt"),
    txtSkillName = form.querySelector("input#txtSkillName"),
    drpdlistSkillLevel = form.querySelector("#drpdlistSkillLevel"),
    txtServiceName = form.querySelector("input#txtServiceName"),
    txtUsername = form.querySelector("input#txtUsername"),
    txtPassword = form.querySelector("input#txtPasswd"),
    txtConfirmPasswd = form.querySelector("input#txtConfirmPassword");

form.onsubmit = (e) => {
    e.preventDefault();
}

$(btnRegister).click(function() {
    $(txtFname).blur();
    $(txtLname).blur();
    $(txtDob).blur();
    checkImg();
    $(rbtnlistGender).blur();
    $(txtEmail).blur();
    $(txtContactNo).blur();
    $(txtAddress).blur();
    $(drpdlistCity).blur();
    $(drpdlistState).blur();
    $(txtPincode).blur();
    $(txtPassword).blur();
    $(txtConfirmPasswd).blur();
    $(txtUsername).blur();

    checkGender();
    $(txtGraduation).blur();
    $(drpdlistGraduationYear).blur();
    $(txtOccupation).blur();
    $(txtWorkingExperience).blur();
    $(txtLastWorkedAt).blur();
    $(txtAbout).blur();
    $(txtSkillName).blur();
    $(drpdlistSkillLevel).blur();
    $(txtServiceName).blur();

    if ($(txtFname).blur()) {
        if ($(txtLname).blur()) {
            if ($(txtDob).blur()) {
                if (checkGender()) {
                    if (checkImg()) {
                        if ($(rbtnlistGender).blur()) {
                            if ($(txtEmail).blur()) {
                                if ($(txtContactNo).blur()) {
                                    if ($(txtAddress).blur()) {
                                        if ($(drpdlistCity).blur()) {
                                            if ($(drpdlistState).blur()) {
                                                if ($(txtPincode).blur()) {
                                                    if ($(txtPassword).blur()) {
                                                        if ($(txtConfirmPasswd).blur()) {
                                                            if ($(txtUsername).blur()) {
                                                                if ($(txtGraduation).blur()) {
                                                                    if ($(drpdlistGraduationYear).blur()) {
                                                                        if ($(txtOccupation).blur()) {
                                                                            if ($(txtWorkingExperience).blur()) {
                                                                                if ($(txtLastWorkedAt).blur()) {
                                                                                    if ($(txtAbout).blur()) {
                                                                                        if ($(txtSkillName).blur()) {
                                                                                            if ($(drpdlistSkillLevel).blur()) {
                                                                                                if ($(txtServiceName).blur()) {
                                                                                                    $(btnRegister).val("Registering");
                                                                                                    $(loadingButton).addClass('spinning');
                                                                                                    var errors = "";
                                                                                                    var formData = new FormData(form);
                                                                                                    $.ajax({
                                                                                                        url: "../php/freelancer-registration.php",
                                                                                                        type: 'post',
                                                                                                        data: formData,
                                                                                                        contentType: false,
                                                                                                        cache: false,
                                                                                                        processData: false,
                                                                                                        success: function(result) {
                                                                                                            $.each(result, function(key, value) {
                                                                                                                errors = errors + value.error;
                                                                                                            });
                                                                                                            console.log(errors);
                                                                                                            if (errors == "1") {
                                                                                                                window.location.href = "/FSMS/Login.php";
                                                                                                            } else {
                                                                                                                $(loadingButton).removeClass('spinning');
                                                                                                                $(btnRegister).val("Register");
                                                                                                                $('#confpasswordErr').html(errors);
                                                                                                            }
                                                                                                        },
                                                                                                        error: function(err) {
                                                                                                            $(loadingButton).removeClass('spinning');
                                                                                                            $(btnRegister).val("Register");
                                                                                                        }
                                                                                                    });
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
});






// ---------------------       First name       ---------------------
$(txtFname).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#firstnameErr').text("First name is required");
        return false;
    }
});
$(txtFname).focus(function() {
    $('#firstnameErr').text("");
});

// ---------------------       txtLname       ---------------------
$(txtLname).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#lastnameErr').text("Last name is required");
        return false;
    }
});
$(txtLname).focus(function() {
    $('#lastnameErr').text("");
});

// ---------------------       txtDob       ---------------------
$(txtDob).on('change', function() {

});

$(txtDob).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#dateofbirthErr').text("Birth date is required");
        return false;
    } else {
        var dob = new Date(txtDob.value);
        var month_diff = Date.now() - dob.getTime();
        var age_dt = new Date(month_diff);
        var year = age_dt.getUTCFullYear();
        var age = year - 1970;
        if (age < 18) {
            $('#dateofbirthErr').text("Invalid birth date!! Your age must be 18 or more...");
            return false;

        } else {
            $('#dateofbirthErr').text("");
            return true;
        }
    }
});

$(txtDob).focus(function() {
    $('#dateofbirthErr').text("");
});

// ---------------------     rbtnlistGender       ---------------------
function checkGender() {
    if ($(rbtnlistGender).is(":checked")) {
        $('#genderErr').text("");
        return true;
    } else {
        $('#genderErr').text("Gender is required");
        return false;
    }
}
$(rbtnlistGender).on('change', function() {
    checkGender();
});
// ---------------------     imgUserProfile       ---------------------


function checkImg() {
    if (imgUserProfile.files.length > 0) {
        $('#profilepicErr').text('');
        // var pattern = /image.*/;
        ext = imgUserProfile.files[0].name.substring(imgUserProfile.files[0].name.lastIndexOf('.') + 1).toLowerCase();
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray(ext, fileExtension) == -1) {
            $('#profilepicErr').text("Only image file (.png, .jpeg, .jpg) are allowed");
            return false;
        } else {
            var file_size = imgUserProfile.files[0].size;
            if (file_size > 2097152) {
                $("#profilepicErr").text("File size must less than 2MB");
                return false;
            }
        }
        return true;
    } else {
        $('#profilepicErr').text("Profile picture is required");
        return false;
    }
}

$(imgUserProfile).on('change', function() {
    checkImg();
});

// ---------------------     txtEmail       ---------------------
$(txtEmail).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#emailErr').text("Email id is required");
        return false;
    } else {
        return validateEmail(txtEmail);
    }

});
$(txtEmail).focus(function() {
    $('#emailErr').text("");
});

function checkEmail(object) {
    var requestType = "checkEmail";
    $.ajax({
        url: "../php/check-email-username-contactno.php",
        type: 'post',
        data: { requestType: requestType, email: object.value },
        success: function(result) {
                var errors = "";
                $.each(result, function(key, value) {
                    errors = errors + value.error.toString();
                });
                if (errors == "") {
                    return true;
                } else {
                    $('#emailErr').html(errors);
                    return false;
                }
            }
            // error: function(err) {
            //     alert("error");
            // }
    });
}

function validateEmail(mail) {
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/.test(mail.value)) {
        return checkEmail(mail);
    }
    $('#emailErr').html("You have entered an invalid email format!");
    return false;
}
// ---------------------     txtContactNo       ---------------------
$(txtContactNo).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#contactnumErr').text("Contact number is required");
        return false;
    } else {
        return validateContactNo(txtContactNo);
    }
});
$(txtContactNo).focus(function() {
    $('#contactnumErr').text("");
});

function checkContactNo(object) {
    var requestType = "checkContactNo";
    $.ajax({
        url: "../php/check-email-username-contactno.php",
        type: 'post',
        data: { requestType: requestType, contactno: object.value },
        success: function(result) {
                var errors = "";
                $.each(result, function(key, value) {
                    errors = errors + value.error;
                });
                if (errors != "") {

                    $('#contactnumErr').html(errors);
                    return false;
                } else {
                    return true;
                }
            }
            // error: function(err) {
            //     alert("error");
            // }
    });
}

function validateContactNo(contactnum) {
    if (/^[6-9][0-9]{9}$/.test(contactnum.value)) {
        return checkContactNo(contactnum);
    }
    $('#contactnumErr').html("Invalid Contact number format!");
    return false;
}
// ---------------------     txtAddress       ---------------------
$(txtAddress).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#addressErr').text("Address is required");
        return false;
    } else {
        return true;
    }
});
$(txtAddress).focus(function() {
    $('#addressErr').text("");
});

// ---------------------     drpdlistCity       ---------------------
$(drpdlistCity).blur(function() {
    if (drpdlistCity.selectedIndex <= 0) {
        $('#cityErr').text("City is required");
        return false;
    } else {
        return true;
    }
});
$(drpdlistCity).focus(function() {
    $('#cityErr').text("");
});

// ---------------------     drpdlistState       ---------------------
$(drpdlistState).blur(function() {
    if (drpdlistState.selectedIndex <= 0) {
        $('#stateErr').text("State is required");
        return false;
    } else {
        return true;
    }
});
$(drpdlistState).focus(function() {
    $('#stateErr').text("");
});

// ---------------------     txtPincode       ---------------------
$(txtPincode).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#pincodeErr').text("Pincode is required");
        return false;
    } else {
        return true;
    }
});
$(txtPincode).focus(function() {
    $('#pincodeErr').text("");
});

// ---------------------     txtUsername       ---------------------
$(txtUsername).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#usernameErr').text("Username is required");
        return false;
    } else {
        return validateUsername(txtUsername);
    }
});

$(txtUsername).focus(function() {
    $('#usernameErr').text("");
});

function checkUsername(object) {
    var requestType = "checkUsername";
    $.ajax({
        url: "../php/check-email-username-contactno.php",
        type: 'post',
        data: { requestType: requestType, username: object.value },
        success: function(result) {
                var errors = "";
                $.each(result, function(key, value) {
                    errors = errors + value.error;
                });
                if (errors != "") {
                    $('#usernameErr').html(errors);
                    return false;
                } else {
                    return true;
                }
            }
            // error: function(err) {
            //     alert("error");
            // }
    });
}

function validateUsername(username) {
    if (/^[a-zA-Z0-9]{6,16}$/.test(username.value)) {
        return checkUsername(username);;
    }
    $('#usernameErr').html("Only Alphanumeric value allowed in Username,<br/>Username must be minimum 6 and maximum 16 character");
    return false;
}
// ---------------------     txtPassword       ---------------------
$(txtPassword).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#passwordErr').text("Password is required");
        return false;
    } else {
        return validatePassword(txtPassword, $('#passwordErr'));
    }
});

$(txtPassword).focus(function() {
    $('#passwordErr').text("");
});

// ---------------------     txtConfirmPasswd       ---------------------
$(txtConfirmPasswd).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#confpasswordErr').text("Please Confirm Password is required");
        return false;
    } else {
        if (validatePassword(txtConfirmPasswd, $('#confpasswordErr'))) {
            if (txtConfirmPasswd.value !== txtPassword.value) {
                $('#confpasswordErr').text("Password are not match...");
                return false;
            } else {
                return true;
            }
        }
    }
});

$(txtConfirmPasswd).focus(function() {
    $('#confpasswordErr').text("");
});

function validatePassword(password, errortype) {
    if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[ !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-])[A-Za-z\d !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-]{8,16}$/.test(password.value)) {
        return true;
    } else {
        $(errortype).html("Password must contains minimum 8 and maximum 16 character,<br/>At leas one uppercase letter,<br/> one lowercase letter,<br/> one number and one special character.");
        return false;
    }
}
// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}

// ---------------------     txtGraduation       ---------------------
$(txtGraduation).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#GraduationErr').text("Graduation is required");
        return false;
    }
});

$(txtGraduation).focus(function() {
    $('#GraduationErr').text("");
});

// ---------------------     drpdlistGraduationYear       ---------------------
$(drpdlistGraduationYear).blur(function() {
    if (drpdlistGraduationYear.selectedIndex <= 0) {
        $('#GraduationYearErr').text("Graduation Year is required");
        return false;
    } else {
        return true;
    }
});

$(drpdlistGraduationYear).focus(function() {
    $('#GraduationYearErr').text("");
});


// ---------------------     txtOccupation       ---------------------
$(txtOccupation).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#OccupationErr').text("Occupation is required");
        return false;
    }
});

$(txtOccupation).focus(function() {
    $('#OccupationErr').text("");
});


// ---------------------     txtWorkingExperience       ---------------------
$(txtWorkingExperience).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#WorkingExperienceErr').text("Working experience is required");
        return false;
    }
});

$(txtWorkingExperience).focus(function() {
    $('#WorkingExperienceErr').text("");
});

// ---------------------     txtLastWorkedAt       ---------------------
$(txtLastWorkedAt).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#LastWorkedAtErr').text("Last work is required");
        return false;
    }
});

$(txtLastWorkedAt).focus(function() {
    $('#LastWorkedAtErr').text("");
});

// ---------------------     txtAbout       ---------------------
$(txtAbout).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#AboutErr').text("Please enter About Your Self");
        return false;
    }
});

$(txtAbout).focus(function() {
    $('#AboutErr').text("");
});
// ---------------------     txtServiceName       ---------------------
$(txtServiceName).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#ServiceNameErr').text("Please enter your services name");
        return false;
    }
});

$(txtServiceName).focus(function() {
    $('#ServiceNameErr').text("");
});
// ---------------------     txtSkillName       ---------------------
$(txtSkillName).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#SkillNameErr').text("Skills is required");
        return false;
    }
});

$(txtSkillName).focus(function() {
    $('#SkillNameErr').text("");
});
$(drpdlistSkillLevel).blur();
// ---------------------     drpdlistSkillLevel       ---------------------
$(drpdlistSkillLevel).blur(function() {

    if (drpdlistSkillLevel.selectedIndex <= 0) {
        $('#SkillLevelErr').text("Skill level is required");
        return false;
    } else {
        return true;
    }
});

$(drpdlistSkillLevel).focus(function() {
    $('#SkillLevelErr').text("");
});
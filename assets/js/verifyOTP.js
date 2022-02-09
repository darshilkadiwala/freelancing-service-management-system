const form = document.querySelector("form[name=frmVerifyChangePass]#frmVerifyChangePass"),
    txtOTP = form.querySelector("input#txtOTP"),
    newPasswd = form.querySelector("input#txtNewPasswd"),
    confirmNewPasswd = form.querySelector("input#txtConfirmNewPasswd"),
    btnVerifyChangePass = form.querySelector("input#btnVerifyChangePass"),
    otpErr = form.querySelector(".error-msg#otpErr"),
    newpasswordErr = form.querySelector(".error-msg#newpasswordErr"),
    confnewpasswordErr = form.querySelector(".error-msg#confnewpasswordErr"),
    loadingButton = form.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(btnVerifyChangePass).on('click', function() {
    if (validateOTP() && validateNewPasswd() && validateConfNewPasswd()) {
        $(loadingButton).addClass('spinning');
        $(btnVerifyChangePass).val("Please wait...");
        $.ajax({
            url: "./php/verifyOTP.php",
            type: 'post',
            data: $(form).serialize(),
            success: function(result) {
                error = "";
                $.each(result, function(key, value) {
                    error += value.error;
                });
                if (error == "PASSCHANGE") {
                    window.location.href = "./Login.php";
                } else {
                    if (error == "INVALIDOTP") {
                        error = "You have enterd wrong OTP. !!!";
                    } else if (error == "ERROR") {
                        error = "Something went wrong please try later or try to contact us ...";
                    } else {
                        $(confnewpasswordErr).html(error);
                    }
                    showPopUp(error, 'bg-danger');
                }
                $(loadingButton).removeClass('spinning');
                $(btnVerifyChangePass).val("Verify OTP & Change Password");
            },
            error: function(err) {
                $(loadingButton).removeClass('spinning');
                $(btnVerifyChangePass).val("Verify OTP & Change Password");
                $(confnewpasswordErr).html("");
            }
        });
    }
});

// ---------------------------------------------------	txtOTP	---------------------------------------------------
$(txtOTP).focus(function() {
    $(otpErr).html("");
});
$(txtOTP).blur(function() {
    validateOTP();
});

function validateOTP() {
    result = checkInput(txtOTP);
    if (result) {
        $(otpErr).html("OTP is required");
        return false;
    } else {
        if (/^\d{6}$/.test(txtOTP.value)) {
            return true;
        } else {
            $(otpErr).html("You have entered an invalid OTP !!!");
            return false;
        }
    }
}

// ---------------------------------------------------	txtNewPasswd	---------------------------------------------------
$(newPasswd).focus(function() {
    $(newpasswordErr).html("");
});
$(newPasswd).blur(function() {
    validateNewPasswd()
});

function validateNewPasswd() {
    result = checkInput(newPasswd);
    if (result) {
        $(newpasswordErr).text("New Password is required");
        return false;
    } else {
        return validatePassword(newPasswd, $(newpasswordErr));
    }
}

// ---------------------------------------------------	txtConfNewPasswd	---------------------------------------------------
$(confirmNewPasswd).focus(function() {
    $(confnewpasswordErr).html("");
});
$(confirmNewPasswd).blur(function() {
    validateConfNewPasswd()
});

function validateConfNewPasswd() {
    result = checkInput(confirmNewPasswd);
    if (result) {
        $(confnewpasswordErr).text("Confirm Password is required");
        return false;
    } else {
        if (validatePassword(confirmNewPasswd, $(confnewpasswordErr))) {
            if (confirmNewPasswd.value !== newPasswd.value) {
                $(confnewpasswordErr).text("Password are not match...");
                return false;
            } else {
                return true;
            }
        }
    }
}


function validatePassword(password, errortype) {
    if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[ !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-])[A-Za-z\d !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-]{8,16}$/.test(password.value)) {
        return true;
    } else {
        $(errortype).html("Password must contains<br/><ul class='error-list'><li> minimum 8 and maximum 16 character,</li><li>At least one uppercase letter,</li><li> one lowercase letter,</li><li> one number and one special character.</li></ul>");
        return false;
    }
}
// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}
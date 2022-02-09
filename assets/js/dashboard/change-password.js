const form = document.querySelector("form[name=frmChangePass]#frmChangePass"),
    oldpasswordErr = form.querySelector(".error-msg#oldpasswordErr"),
    newpasswordErr = form.querySelector(".error-msg#newpasswordErr"),
    confnewpasswordErr = form.querySelector(".error-msg#confnewpasswordErr"),
    btnVerify = document.querySelector("input[type=submit][name=btnVerify]#btnVerify"),
    loadingButton = form.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(btnVerify).on('click', function() {
    validateOldPasswd();
    validateNewPasswd();
    validateConfNewPasswd();
    if (validateOldPasswd() && validateNewPasswd() && validateConfNewPasswd()) {
        $(loadingButton).addClass('spinning');
        $(btnVerify).val("Please wait...");
        $.ajax({
            url: "../php/dashboard/change-password.php",
            type: 'post',
            data: $(form).serialize(),
            success: function(result) {
                error = "";
                $.each(result, function(key, value) {
                    error += value.error;
                });
                if (error == "PASSCHANGE") {
                    window.location.href = "/FSMS/Login.php";
                } else {
                    if (error == "INVALIDPASS") {
                        error = "You have enterd wrong password. !!!";
                    } else if (error == "ERROR") {
                        error = "Something went wrong please try later or try to contact us ...";
                    } else {
                        $(confnewpasswordErr).html(error);
                    }
                    showPopUp(error, 'bg-danger');
                }
                $(loadingButton).removeClass('spinning');
                $(btnVerify).val("Verify OTP & Change Password");
            },
            error: function(err) {
                $(loadingButton).removeClass('spinning');
                $(btnVerify).val("Verify OTP & Change Password");
                $(confnewpasswordErr).html("");
            }
        });
    }
});

// ---------------------------------------------------	txtOldPasswd	---------------------------------------------------
$(txtOldPasswd).focus(function() {
    $(oldpasswordErr).html("");
});
$(txtOldPasswd).blur(function() {
    validateOldPasswd()
});

function validateOldPasswd() {
    result = checkInput(txtOldPasswd);
    if (result) {
        $(oldpasswordErr).text("Old Password is required");
        $(oldpasswordErr).show();
        return false;
    } else {
        return validatePassword(txtOldPasswd, $(oldpasswordErr));
    }
}
// ---------------------------------------------------	txtNewPasswd	---------------------------------------------------
$(txtNewPasswd).focus(function() {
    $(newpasswordErr).html("");
});
$(txtNewPasswd).blur(function() {
    validateNewPasswd();
});

function validateNewPasswd() {
    result = checkInput(txtNewPasswd);
    if (result) {
        $(newpasswordErr).text("New Password is required");
        $(newpasswordErr).show();
        return false;
    } else {
        return validatePassword(txtNewPasswd, $(newpasswordErr));
    }
}

// ---------------------------------------------------	txtConfNewPasswd	---------------------------------------------------
$(txtConfirmNewPasswd).focus(function() {
    $(confnewpasswordErr).html("");
});
$(txtConfirmNewPasswd).blur(function() {
    validateConfNewPasswd()
});

function validateConfNewPasswd() {
    result = checkInput(txtConfirmNewPasswd);
    if (result) {
        $(confnewpasswordErr).text("Confirm New Password is required");
        $(confnewpasswordErr).show();
        return false;
    } else {
        if (validatePassword(txtConfirmNewPasswd, $(confnewpasswordErr))) {
            if (txtConfirmNewPasswd.value !== txtNewPasswd.value) {
                $(confnewpasswordErr).text("Password are not match...");
                $(confnewpasswordErr).show();
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
        $(errortype).show();
        return false;
    }
}
// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}
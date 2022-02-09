const form = document.querySelector("form#frmLogin"),
    loginBtn = form.querySelector("input#btnLogin"),
    txtUsername = form.querySelector("input#txtUsername"),
    txtPassword = form.querySelector("input#txtPasswd"),
    displayErr = form.querySelector("#error-msg.error-msg"),
    loadingButton = form.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
var errors = {};

$(loginBtn).on('click', function() {
    if (validateUsername()) {
        if (validatePassword()) {
            $(loginBtn).val("Logging In");
            $(loadingButton).addClass('spinning');
            // var formData = new FormData();
            // formData.append("txtUsername", txtUsername.value);
            // formData.append("txtPasswd", txtPassword.value);
            var error = "";
            $(displayErr).html('');
            $.ajax({
                url: "./php/login.php",
                type: 'post',
                data: $(form).serialize(),
                success: function(result) {
                    if (Object.keys(result).length == 1) {
                        $.each(result, function(key, value) {
                            error = error + value.error;
                        });
                        if (error !== 'notVerified') {
                            error = error == 'blocked' ?
                                'Sorry Your account is blocked by system, If its mistake than Contact us' :
                                (
                                    error == 'rejected' ?
                                    'Sorry!, Your account request was rejected' :
                                    (
                                        error == 'pending' ?
                                        'Your account request is still pending you will be notified once its proceed forward' :
                                        error
                                    )
                                );
                            $(loadingButton).removeClass('spinning');
                            $(loginBtn).val("Login");
                            showPopUp(error, 'bg-danger');
                        } else if (error == 'notVerified') {
                            window.location.href = "/FSMS/verify-your-account.php/";
                        } else {
                            showPopUp(error, 'bg-danger');
                        }
                    } else if (Object.keys(result).length == 2) {
                        $.each(result, function(key, value) {
                            window.errors[value.id] = value.value;
                        });
                        if (window.errors['error'] == 1) {
                            if (window.errors['link'] == 1 || window.errors['link'] == 2) {
                                window.location.href = "/FSMS/dashboard/";
                            } else {
                                window.location.href = "/FSMS/";
                            }
                        } else {
                            $.each(result, function(key, value) {
                                error = error + value.error;
                            });
                            $(loadingButton).removeClass('spinning');
                            $(loginBtn).val("Login");
                            showPopUp(error, 'bg-danger');
                        }
                    }
                },
                error: function(err) {
                    $(loadingButton).removeClass('spinning');
                    $(loginBtn).val("Login");
                }
            });
        }
    }
});


// ---------------------     txtUsername       ---------------------
$(txtUsername).blur(function() {
    validateUsername();
});

$(txtUsername).focus(function() {
    $(displayErr).text("");
});

function validateUsername() {
    result = checkInput(txtUsername);
    if (result) {
        $(displayErr).text("Username is required");
        return false;
    } else {
        if (/^[a-zA-Z0-9]{6,16}$/.test(txtUsername.value)) {
            return true;
        }
        // $(displayErr).html("Invalid Username or password");
        // $(displayErr).html("Only Alphanumeric value allowed in Username,<br/>Username must be minimum 6 and maximum 16 character");
        return false;
    }
}

// ---------------------     txtPassword       ---------------------
$(txtPassword).blur(function() {
    validatePassword();
});

$(txtPassword).focus(function() {
    $(displayErr).text("");
});


function validatePassword() {
    result = checkInput(txtPassword);
    if (result) {
        $(displayErr).text("Password is required");
        return false;
    } else {
        if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[ !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-])[A-Za-z\d !"#$%&'()*+,./:;<=>?@\[\]^_`{|}~-]{8,16}$/.test(txtPassword.value)) {
            return true;
        } else {
            $("#error-msg").html("Invalid Username or password");
            // $("#error-msg").html("Password must contains<br/><ul class='error-list'><li> minimum 8 and maximum 16 character,</li><li>At least one uppercase letter,</li><li> one lowercase letter,</li><li> one number and one special character.</li></ul>");
            return false;
        }
    }
}
// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}
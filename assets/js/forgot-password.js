const form = document.querySelector("form#frmForgotPassword"),
    btnVerifyEmail = form.querySelector("input#btnVerifyEmail"),
    txtEmail = form.querySelector("input#txtEmail"),
    displayErr = form.querySelector("#emailErr"),
    loadingButton = form.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(btnVerifyEmail).click(function() {
    if (validateEmail()) {
        $(btnVerifyEmail).val("Sending OTP");
        $(loadingButton).addClass('spinning');
        var errors = "";
        $.ajax({
            url: "./php/forgot-password.php",
            type: 'post',
            data: $(form).serialize(),
            success: function(result) {
                $.each(result, function(key, value) {
                    errors = errors + value.error;
                });
                if (errors == "OTPsent") {
                    window.location.href = "/FSMS/VerifyOTP.php";
                } else {
                    showPopUp(errors, 'bg-danger');
                }
                $(loadingButton).removeClass('spinning');
                $(btnVerifyEmail).val("Send OTP");
            },
            error: function(err) {
                $(loadingButton).removeClass('spinning');
                $(btnVerifyEmail).val("Send OTP");
                $(displayErr).html("");
            }
        });
    }
});

$(txtEmail).focus(function() {
    $(displayErr).html("");
});
$(txtEmail).blur(function() {
    validateEmail();
});

function validateEmail() {
    result = (txtEmail.value == "") ? true : false;
    if (result) {
        showPopUp("Email id is required", 'bg-danger');
        return false;
    } else {
        if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/.test(txtEmail.value)) {
            return true;
        } else {
            showPopUp("You have entered an invalid email format !!!", 'bg-danger');
            return false;
        }
    }
}
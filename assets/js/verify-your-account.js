const form = document.querySelector("form#frmVerifyAccount"),
    btnVerify = form.querySelector("input[name=btnVerify][type=submit]#btnVerify"),
    txtUsername = form.querySelector("input[name=txtUsername][type=text]#txtUsername"),
    txtEmail = form.querySelector("input[name=txtEmail][type=email]#txtEmail"),
    loadingButton = form.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}

$(btnVerify).on('click', function() {
    if (btnVerify.value == "Send OTP") {
        if (checkInput(txtUsername) || checkInput(txtEmail)) {
            showPopUp("All fields are required !!!", 'bg-danger', 6000);
        } else if (validateUsername() && validateEmail()) {
            $(btnVerify).val("Please wait...");
            $(loadingButton).addClass('spinning');
            var error = "";
            var formData = new FormData(form);
            formData.append();
            var requestType = "checkEmail";
            $.ajax({
                url: "./php/verify-your-account.php",
                type: 'post',
                data: { txtEmail: txtEmail.value, txtUsername: txtUsername.value, requestType: requestType },
                success: function(result) {
                    var error = "";
                    $.each(result, function(key, value) {
                        error += error != "" ? "\n" + value.error : value.error;
                    });
                    bgClass = "bg-danger";
                    if (error == "OTPSENT") {
                        error = "OTP sent to your Email enter below to verify it";
                        bgClass = "";
                        $(txtEmail).attr('type', 'hidden');
                        $(txtUsername).attr('type', 'hidden');
                        $('#lblEmail').remove();
                        $('#lblUsername').remove();
                        $(form).children().first().append("<div class='form-row'><label ID='lblOTP' for='txtOTP' class='ml-1 mt-3 color-12192C font-weight-bold'>OTP :<small> (Sent to your email id)</small></label><input type='number' ID='txtOTP' name='txtOTP' class='form-control mt-0 p-4' placeholder='Enter OTP here' tabindex='2' max='999999' min='100000' required /></div>");
                        // form.firstChild.appendChild("<div class='form-row'><label ID='lblOTP' for='txtOTP' class='ml-1 mt-3 color-12192C font-weight-bold'>OTP :<small> (Sent to your email id)</small></label><input type='number' ID='txtOTP' name='txtOTP' class='form-control mt-0 p-4' placeholder='Enter OTP here' tabindex='2' max='999999' min='100000' required /></div>");
                        $(loadingButton).removeClass('spinning');
                        $(btnVerify).val("Verify OTP");
                    } else {
                        $(loadingButton).removeClass('spinning');
                        $(btnVerify).val("Send OTP");
                    }
                    showPopUp(error, bgClass, 6000);
                },
                error: function(err) {
                    $(loadingButton).removeClass('spinning');
                    $(btnVerify).val("Send OTP");
                }
            });
        } else { showPopUp("Invalid Email Id or Username !!!", 'bg-danger'); }
    }
});


// ---------------------     txtUsername       ---------------------
$(txtUsername).blur(function() {
    validateUsername();
});

$(txtUsername).focus(function() {

});

function validateUsername() {
    if (/^[a-zA-Z0-9]{6,16}$/.test(txtUsername.value)) {
        return true;
    }
    return false;
}

// ---------------------     txtEmail       ---------------------
$(txtEmail).blur(function() {
    validateEmail();
});

$(txtEmail).focus(function() {

});


function validateEmail() {
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/.test(txtEmail.value)) {
        return true;
    }
    return false;
}
// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value === "") ? true : false;
}
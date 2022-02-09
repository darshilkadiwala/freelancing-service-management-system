var loadingButton = document.querySelector('.loadingButton');

const form = document.querySelector('form#frmSubmitRequirement'),
    txtAboutOrder = form.querySelector("input[type='text'][name='txtAboutOrder']#txtAboutOrder"),
    txtRequirement = form.querySelector("textarea[name='txtRequirement']#txtRequirement"),
    ReqImg = form.querySelector("input[type='file'][name='ReqImg']#ReqImg"),
    btnSubmitRequirement = form.querySelector("input[type='submit'][name='SubmitRequirement']#btnSubmitRequirement");

form.onsubmit = (e) => {
    e.preventDefault();
}

$(document).ready(function() {
    $(btnSubmitRequirement).on('click', function() {
        aboutOrder = checkAboutOrder();
        requirement = checkRequirement();
        if (aboutOrder && requirement) {
            $(btnSubmitRequirement).val("Submitting your Requirement");
            $(loadingButton).addClass('spinning');
            var formData = new FormData(form);
            var errors = "";
            $.ajax({
                url: "../php/order/submit-reqiurement.php",
                type: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    $.each(result, function(key, value) {
                        errors = errors + value.error;
                    });
                    if (errors == "1") {
                        window.location.href = "/FSMS/order/";
                    } else {
                        $(loadingButton).removeClass('spinning');
                        $(btnSubmitRequirement).val("Submit Requirement");
                    }
                },
                error: function(err) {
                    $(loadingButton).removeClass('spinning');
                    $(btnSubmitRequirement).val("Submit Requirement");
                }
            });
        }
    })
});

// ---------------------       About Order       ---------------------
$(txtAboutOrder).blur(function() {
    checkAboutOrder();
});

function checkAboutOrder() {
    result = checkInput(txtAboutOrder);
    if (result) {
        $('#errAboutOrder').text("Please tell about your order!!!");
        return false;
    } else {
        return true;
    }
}
$(txtAboutOrder).focus(function() {
    $('#errAboutOrder').text("");
});
// ---------------------  Order Requirement      ---------------------
$(txtRequirement).blur(function() {
    checkRequirement();
});

function checkRequirement() {
    result = checkInput(txtRequirement);
    if (result) {
        $('#errRequirement').text("Please give your requirement in detail  !!!");
        return false;
    } else {
        return true;
    }
}
$(txtRequirement).focus(function() {
    $('#errRequirement').text("");
});

// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return ($(object).val().trim().length < 1) ? true : false;
}
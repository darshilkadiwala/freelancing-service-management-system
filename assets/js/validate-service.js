var loadingButton = document.querySelector('.loadingButton');
const form = document.querySelector("form#frmAddService"),
    btnAdd = form.querySelector("input#btnAdd"),
    txtServicetitle = form.querySelector("input#txtServicetitle"),
    txtDeliveryDays = form.querySelector("input#txtDeliveryDays"),
    txtShortDescription = form.querySelector("textarea#txtShortDescription"),
    imgServiceImg = form.querySelector("input#imgServiceImg"),
    drpdlistServiceType = form.querySelector("#drpdlistServiceType"),
    drpdlistSubCategory = form.querySelector("#drpdlistSubCategory"),
    drpdlistCategory = form.querySelector("#drpdlistCategory"),
    txtAboutService = form.querySelector("textarea#txtAboutService");

form.onsubmit = (e) => {
    e.preventDefault();
}

$(btnAdd).click(function() {
    $(txtServicetitle).blur();
    $(txtShortDescription).blur();
    $(txtDeliveryDays).blur();
    checkImg();
    $(drpdlistSubCategory).blur();
    $(drpdlistCategory).blur();
    $(drpdlistServiceType).blur();
    $(txtAboutService).blur();

    if ($(txtServicetitle).blur()) {
        if ($(txtShortDescription).blur()) {
            if ($(txtDeliveryDays).blur()) {
                if (checkImg()) {
                    if ($(drpdlistSubCategory).blur()) {
                        if ($(drpdlistServiceType).blur()) {
                            if ($(drpdlistCategory).blur()) {
                                if ($(txtAboutService).blur()) {
                                    $(btnAdd).val("Please wait...");
                                    $(loadingButton).addClass('spinning');
                                    var errors = "";
                                    var formData = new FormData(form);
                                    $.ajax({
                                        url: "../../php/add-service.php",
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
                                                // window.location.href = "/FSMS/Login.php";
                                            } else {
                                                $(loadingButton).removeClass('spinning');
                                                $(btnAdd).val("Add Service");
                                                $('#serviceImgErr').html(errors);
                                            }
                                        },
                                        error: function(err) {
                                            $(loadingButton).removeClass('spinning');
                                            $(btnAdd).val("Add Service");
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
});



// ---------------------       txtServicetitle       ---------------------
$(txtServicetitle).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#ServicetitleErr').text("Service title is required");
        return false;
    }
});
$(txtServicetitle).focus(function() {
    $('#ServicetitleErr').text("");
});
// ---------------------       txtDeliveryDays       ---------------------
$(txtDeliveryDays).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#DeliveryDaysErr').text("Delivery days is required");
        return false;
    } else if ($(txtDeliveryDays).val() > 30) {
        $('#DeliveryDaysErr').text("Delivery days must be less than 30");
        return false;
    }
});
$(txtDeliveryDays).focus(function() {
    $('#DeliveryDaysErr').text("");
});

// ---------------------       txtShortDescription       ---------------------
$(txtShortDescription).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#ShortDescriptionErr').text("Short description is required");
        return false;
    }
});
$(txtShortDescription).focus(function() {
    $('#ShortDescriptionErr').text("");
});
// ---------------------     imgServiceImg       ---------------------


function checkImg() {
    if (imgServiceImg.files.length > 0) {
        $('#serviceImgErr').text('');
        // var pattern = /image.*/;
        ext = imgServiceImg.files[0].name.substring(imgServiceImg.files[0].name.lastIndexOf('.') + 1).toLowerCase();
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray(ext, fileExtension) == -1) {
            $('#serviceImgErr').text("Only image file (.png, .jpeg, .jpg) are allowed");
            return false;
        } else {
            var file_size = imgServiceImg.files[0].size;
            if (file_size > 2097152) {
                $("#serviceImgErr").text("File size must be less than 2MB");
                return false;
            }
        }
        return true;
    } else {
        $('#serviceImgErr').text("Service image is required");
        return false;
    }
}

$(imgServiceImg).on('change', function() {
    checkImg();
});

// ---------------------     drpdlistSubCategory       ---------------------
$(drpdlistSubCategory).blur(function() {
    if (drpdlistSubCategory.selectedIndex <= 0) {
        $('#subcategoryErr').text("Sub-category is required");
        return false;
    } else {
        return true;
    }
});
$(drpdlistSubCategory).focus(function() {
    $('#subcategoryErr').text("");
});

// ---------------------     drpdlistServiceType       ---------------------
$(drpdlistServiceType).blur(function() {
    if (drpdlistServiceType.selectedIndex <= 0) {
        $('#ServiceTypeErr').text("Service type is required");
        return false;
    } else {
        return true;
    }
});
$(drpdlistServiceType).focus(function() {
    $('#ServiceTypeErr').text("");
});

// ---------------------     drpdlistCategory       ---------------------
$(drpdlistCategory).blur(function() {
    if (drpdlistCategory.selectedIndex <= 0) {
        $('#categoryErr').text("Category is required");
        return false;
    } else {
        return true;
    }
});
$(drpdlistCategory).focus(function() {
    $('#categoryErr').text("");
});

// ---------------------     txtAboutService       ---------------------
$(txtAboutService).blur(function() {
    result = checkInput(this);
    if (result) {
        $('#AboutServiceErr').text("About service is required");
        return false;
    } else {
        return true;
    }
});
$(txtAboutService).focus(function() {
    $('#AboutServiceErr').text("");
});

// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}
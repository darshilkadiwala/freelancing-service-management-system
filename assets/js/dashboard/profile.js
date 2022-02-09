const formContactInfo = document.querySelector('form#frmContactInfo'),
    formUserInfo = document.querySelector('form#frmUserInfo'),
    btnSaveUserInfo = formUserInfo.querySelector('#btnSave'),
    btnSaveContactInfo = formContactInfo.querySelector('#btnSave'),
    txtFname = formUserInfo.querySelector("input#txtFname"),
    txtLname = formUserInfo.querySelector("input#txtLname"),
    txtDob = formUserInfo.querySelector("input#txtDob"),
    rbtnlistGenderM = formUserInfo.querySelector("input#rbtnlistGenderM"),
    rbtnlistGenderF = formUserInfo.querySelector("input#rbtnlistGenderF"),
    txtEmail = formContactInfo.querySelector("input#txtEmail"),
    txtContactNo = formContactInfo.querySelector("input#txtContactNo"),
    txtAddress = formContactInfo.querySelector("textarea#txtAddress"),
    drpdlistCity = formContactInfo.querySelector("#drpdlistCity"),
    drpdlistState = formContactInfo.querySelector("#drpdlistState"),
    txtPincode = formContactInfo.querySelector("input#txtPincode"),
    saveUserLoadingButton = formUserInfo.querySelector('.loadingButton'),
    saveContactLoadingButton = formContactInfo.querySelector('.loadingButton');

var result = {};
var UserID;
$(document).ready(function() {
    disableForms();
    loadStates();
    loadData();

    // Show user info
    $('#btnEditFrmUserInfo i.bxs-edit').on('click', function() {
        $('#frmUserInfo input').removeAttr('disabled');
        $('#lblUserInfo').html("Edit User information");
        $('#btnEditFrmUserInfo i.bx-x').show();
        $('#btnEditFrmUserInfo i.bxs-edit').hide();
        $('#frmUserInfo #btnSave').show();
    });

    // hide user info
    $('#btnEditFrmUserInfo i.bx-x').on('click', function() {
        loadData();
        $('#frmUserInfo input').attr('disabled', 'disabled');
        $('#lblUserInfo').html("User information");
        $('#btnEditFrmUserInfo i.bx-x').hide();
        $('#btnEditFrmUserInfo i.bxs-edit').show();
        $('#frmUserInfo #btnSave').hide();
    });

    // show contact info
    $('#btnEditFrmContactInfo i.bxs-edit').on('click', function() {
        $('#frmContactInfo input').removeAttr('disabled');
        $('#lblContactInfo').html("Edit Contact information");
        $('#frmContactInfo textarea').removeAttr('disabled');
        $('#frmContactInfo #drpdlistState').removeAttr('disabled');
        $('#frmContactInfo #drpdlistCity').removeAttr('disabled');
        $('#btnEditFrmContactInfo i.bx-x').show();
        $('#btnEditFrmContactInfo i.bxs-edit').hide();
        $('#frmContactInfo #btnSave').show();
    });

    // hide contact info
    $('#btnEditFrmContactInfo i.bx-x').on('click', function() {
        loadData();
        $('#frmContactInfo input').attr('disabled', 'disabled');
        $('#lblContactInfo').html("Contact information");
        $('#btnEditFrmContactInfo i.bx-x').hide();
        $('#btnEditFrmContactInfo i.bxs-edit').show();
        $('#frmContactInfo textarea').attr('disabled', 'disabled');
        $('#frmContactInfo #drpdlistState').attr('disabled', 'disabled');
        $('#frmContactInfo #btnSave').hide();
        $('#frmContactInfo #drpdlistCity').attr('disabled', 'disabled');
    });

    formContactInfo.onsubmit = (e) => {
        e.preventDefault();
    }

    formUserInfo.onsubmit = (e) => {
        e.preventDefault();
    }

    $(btnSaveContactInfo).click(function() {
        if (checkAddress()) {
            if (checkContactNo()) {
                if (checkPincode()) {
                    alert();
                    var formData = new FormData(formContactInfo);
                    saveData("update-contact-info", $(btnSaveContactInfo), $(saveContactLoadingButton), formData);
                }
            }
        } else {
            console.log("ot chec");
        }
    });

    $(btnSaveUserInfo).click(function() {
        checkFirstName();
        checkLastName();
        checkDOB();
        checkGender();
        if (checkFirstName()) {
            if (checkLastName()) {
                if (checkDOB()) {
                    if (checkGender()) {
                        var formData = new FormData(formUserInfo);
                        saveData("update-user-info", $(btnSaveUserInfo), $(saveUserLoadingButton), formData);
                    }
                }
            }
        }
    });

});

function saveData(requestType, btnSave, loadingButton, formData) {
    $('#popup-msg').text('');
    $("#popup-msg").hide();
    $(btnSave).html("Please wait ...");
    $(btnSave).attr('disabled', 'disabled');
    $(loadingButton).addClass('spinning');
    var errors = "";
    formData.append('requestType', requestType);
    $.ajax({
        url: "../php/dashboard/profile.php",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result) {
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors == "1") {
                $('#popup-msg').text('Profile information updated successfully...');
                loadData();
            } else {
                $('#popup-msg').text(errors);
            }
            $("#popup-msg").show().delay(3000).fadeIn();
            setTimeout(function() {
                $('#popup-msg').text('');
                $("#popup-msg").hide();
                $(btnSave).removeAttr('disabled');
            }, 5000);
            $(loadingButton).removeClass('spinning');
            $(btnSave).html("<i class='bx bxs-check-circle btn-icon'></i>Save");

        },
        error: function(err) {
            $(loadingButton).removeClass('spinning');
            $(btnSave).html("<i class='bx bxs-check-circle btn-icon'></i>Save");
        }
    });
}

function disableForms() {
    $('input').attr('disabled', 'disabled');
    $('textarea').attr('disabled', 'disabled');
    $('#lblProfile').text('Profile');
    $('#drpdlistState').attr('disabled', 'disabled');
    $('#drpdlistCity').attr('disabled', 'disabled');
    $('#btnEditFrmUserInfo i.bx-x').hide();
    $('#btnEditFrmContactInfo i.bx-x').hide();
    $('#frmUserInfo#btnSave').hide();
    $('#frmContactInfo #btnSave').hide();
}

function loadData() {
    var requestType = 'FetchAll';

    $.ajax({
        url: "../php/dashboard/profile.php",
        type: 'post',
        data: { requestType: requestType },
        success: function(object) {
            $.each(object, function(key, value) {
                window.result[value.id] = value.value;
            });
        },
        complete: function() {
            window.UserID = window.result['UserID'];
            const Username = window.result['Username'];
            // console.log(window.result['UserID']);
            const Email = window.result['Email'];
            const AccountStatus = window.result['AccountStatus'];
            const DateOfJoining = window.result['DateOfJoining'];
            const Address = window.result['Address'];
            const ProfilePic = "data:image;base64," + window.result['ProfilePicture'];
            const UserStatus = window.result['UserStatus'];
            const Fname = window.result['FirstName'];
            const Lname = window.result['LastName'];
            const ContactNo = window.result['ContactNo'];
            const Dob = window.result['DateOfBirth'];
            const Pincode = window.result['Pincode'];
            const StateID = window.result['StateID'];
            const CityID = window.result['CityID'];
            const StateName = window.result['StateName'];
            const CityName = window.result['CityName'];
            const Gender = window.result['Gender'];
            txtAddress.value = Address;
            $(imgProfilePic).attr('src', ProfilePic);
            $(UserStatus).val(UserStatus);
            $(txtFname).val(Fname);
            $(txtLname).val(Lname);
            $("#users-name").text(Fname + " " + Lname);
            $("#city-state").html("<i class='bx bxs-map-pin mr-2'></i>" + CityName + ", " + StateName);
            $("#username").html("<i class='bx bxs-user-circle mr-2'></i>" + Username);
            $(txtContactNo).val(ContactNo);
            $(txtDob).val(Dob);
            $(txtPincode).val(Pincode);
            $(drpdlistState).val(StateID);
            getCities(CityID);
            Gender == 'M' || Gender == 'm' ? $('#rbtnlistGenderM').attr('checked', 'checked') : (Gender == 'F' || Gender == 'f' ? $('#rbtnlistGenderF').attr('checked', 'checked') : "")
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function getCities(city) {
    var requestType = "getCities";
    $.ajax({
        url: "../php/state-city.php",
        type: 'post',
        data: { requestType: requestType, id: $('#drpdlistState').val() },
        success: function(result) {
            var cities = "<option value=''disabled>-- Select City --</option>";
            $.each(result, function(key, value) {
                if (value.id == city) {
                    cities = cities + "<option value='" + value.id + "' selected>" + value.city + "</option>";
                } else {
                    cities = cities + "<option value='" + value.id + "'>" + value.city + "</option>";
                }
            });
            $('#drpdlistCity').html(cities);
        }
    });
}

function loadStates() {
    var requestType = "getStates";
    $.ajax({
        url: "../php/state-city.php",
        type: 'post',
        data: { requestType: requestType },
        success: function(result) {
            var states = "<option value='' disabled selected>-- Select State --</option>";
            // console.log(result);
            $.each(result, function(key, value) {
                states = states + "<option value='" + value.id + "'>" + value.state + "</option>";
            });
            $('#drpdlistState').html(states);
        }
    });
}

//---------------------      Gender       ---------------------
function checkGender() {
    if ($(rbtnlistGenderM).is(":checked")) {
        $('#genderErr').text("");
        return true;
    } else if ($(rbtnlistGenderF).is(":checked")) {
        $('#genderErr').text("");
        return true;
    } else {
        $('#genderErr').text("Gender is required");
        return false;
    }
}

// ---------------------       First name       ---------------------
$(txtFname).blur(function() {
    checkFirstName();
});

function checkFirstName() {
    result = checkInput(txtFname);
    if (result) {
        $('#firstnameErr').text("First name is required");
        return false;
    } else if (!/^[a-zA-Z]+$/.test(txtFname.value)) {
        $('#firstnameErr').text("Only alphabat is allowed");
        return false;
    } else {
        return true;
    }
}

$(txtFname).focus(function() {
    $('#firstnameErr').text("");
});

// ---------------------       Last Name       ---------------------
$(txtLname).blur(function() {
    checkLastName();
});

function checkLastName() {
    result = checkInput(txtLname);
    if (result) {
        $('#lastnameErr').text("Last name is required");
        return false;
    } else if (!/^[a-zA-Z]+$/.test(txtLname.value)) {
        $('#lastnameErr').text("Only alphabat is allowed");
        return false;
    } else {
        return true;
    }
}

$(txtLname).focus(function() {
    $('#lastnameErr').text("");
});
// ---------------------    Date of Birth    ---------------------
$(txtDob).blur(function() {
    checkDOB();
});

function checkDOB() {
    result = checkInput(txtDob);
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
}
$(txtDob).focus(function() {
    $('#dateofbirthErr').text("");
});

// ---------------------     Contact Number       ---------------------
$(txtContactNo).blur(function() {
    return checkContactNo();
});
$(txtContactNo).focus(function() {
    $('#contactnumErr').text("");
});

function checkContactNo() {
    result = checkInput(txtContactNo);
    if (result) {
        $('#contactnumErr').text("Contact number is required");
        return false;
    } else {
        if (/^[6-9][0-9]{9}$/.test(txtContactNo.value)) {
            return validateContactNo(txtContactNo);
        } else {
            $('#contactnumErr').html("Invalid Contact number format!");
            return false;
        }
    }
}

function validateContactNo(object) {

    var requestType = "checkContactNo";
    const exceptID = window['UserID'];
    var valid;
    $.when($.ajax({
        url: "../php/check-email-username-contactno.php",
        type: 'post',
        data: { requestType: requestType, contactno: object.value, exceptID: exceptID },
        success: function(result) {
            var errors = "";
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors != "0") {
                $('#contactnumErr').html(errors);
                valid = false;
            } else {
                valid = true;
            }
            console.log(valid);
            // return valid;
        }
    })).then(function() {
        console.log(valid);
        return valid;
    });

}

// ---------------------     Address       ---------------------
$(txtAddress).blur(function() {
    checkAddress();
});

function checkAddress() {
    result = checkInput(txtAddress);
    if (result) {
        $('#addressErr').text("Address is required");
        return false;
    } else {
        return true;
    }
}

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
    checkPincode();
});

function checkPincode() {
    result = checkInput(txtPincode);
    if (result) {
        $('#pincodeErr').text("Pincode is required");
        return false;
    } else {
        return true;
    }
}
$(txtPincode).focus(function() {
    $('#pincodeErr').text("");
});

// ---------------------     checkInput()       ---------------------
function checkInput(object) {
    return (object.value == "") ? true : false;
}
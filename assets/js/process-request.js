const form = document.querySelector("form#frmProcessRequest"),
    btnApprove = form.querySelector("input#btnApprove"),
    userid = form.querySelector("input#userid"),
    btnReject = form.querySelector("input#btnReject");
var displayErr = document.querySelector("#error-msg"),
    btnApproveloadingButton = document.querySelector('.loadingButton1'),
    btnRejectloadingButton = document.querySelector('.loadingButton2');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(btnApprove).on('click', function() {
    $(btnApprove).val("Please Wait...");
    $(btnApproveloadingButton).addClass('spinning');
    var errors = "";
    $.ajax({
        url: "../../php/dashboard/users/process-reqest.php",
        type: 'post',
        data: { requestType: "A", uid: userid.value },
        success: function(result) {
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors == "1") {
                window.location.href = "./";
            } else {
                $(btnApproveloadingButton).removeClass('spinning');
                $(btnApprove).val("Approve");
                $(displayErr).html(errors);
                console.log(errors);
            }
        },
        error: function(err) {
            $(btnApproveloadingButton).removeClass('spinning');
            $(btnApprove).val("Approve");
            $(displayErr).html(errors);
        }
    });
});
$(btnReject).on('click', function() {
    $(btnReject).val("Please Wait...");
    $(btnRejectloadingButton).addClass('spinning');
    var errors = "";
    $.ajax({
        url: "../../php/dashboard/users/process-reqest.php",
        type: 'post',
        data: { requestType: "R", uid: userid.value },
        success: function(result) {
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors == "1") {
                window.location.href = "./";
            } else {
                $(btnRejectloadingButton).removeClass('spinning');
                $(btnReject).val("Approve");
                $(displayErr).html(errors);
                console.log(errors);
            }
        },
        error: function(err) {
            $(btnRejectloadingButton).removeClass('spinning');
            $(btnReject).val("Approve");
            $(displayErr).html(errors);
        }
    });
});
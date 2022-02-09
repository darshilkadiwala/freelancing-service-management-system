const form = document.querySelector("form#frmBlockUser"),
    btnBlock = form.querySelector("input#btnBlock"),
    userid = form.querySelector("input#userid");
var displayErr = document.querySelector("#error-msg"),
    btnBlockloadingButton = document.querySelector('.loadingButton');
form.onsubmit = (e) => {
    e.preventDefault();
}
$(btnBlock).on('click', function() {
    $(btnBlock).val("Please Wait...");
    $(btnBlockloadingButton).addClass('spinning');
    var errors = "";
    $.ajax({
        url: "../../php/dashboard/users/process-reqest.php",
        type: 'post',
        data: { requestType: "B", uid: userid.value },
        success: function(result) {
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors == "1") {
                window.location.href = "./";
            } else {
                $(btnBlockloadingButton).removeClass('spinning');
                $(btnBlock).val("Block");
                $(displayErr).html(errors);
                console.log(errors);
            }
        },
        error: function(err) {
            $(btnBlockloadingButton).removeClass('spinning');
            $(btnBlock).val("Block");
            $(displayErr).html(errors);
        }
    });
});
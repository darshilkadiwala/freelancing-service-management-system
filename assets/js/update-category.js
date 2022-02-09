const form = document.querySelector("form#frmUpdateCatagory"),
    btnUpdate = form.querySelector("input#btnUpdate");
var displayErr = document.querySelector("#error-msg");
var loadingButton = document.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(form).on("submit", function() {
    $(btnUpdate).val("Updating");
    $(loadingButton).addClass('spinning');
    var errors = "";
    $.ajax({
        url: "../../php/dashboard/update-category.php",
        type: 'post',
        data: $(form).serialize(),
        success: function(result) {
            $.each(result, function(key, value) {
                errors = errors + value.error;
            });
            if (errors == "1") {
                window.location.href = "/FSMS/dashboard/category/";
            } else {
                $(loadingButton).removeClass('spinning');
                $(btnUpdate).val("Update");
                $(displayErr).html(errors);
            }
        },
        error: function(err) {
            $(loadingButton).removeClass('spinning');
            $(btnUpdate).val("Update");
            $(displayErr).html(errors);
        }
    });
});
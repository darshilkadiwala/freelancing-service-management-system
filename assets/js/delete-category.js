const form = document.querySelector("form#frmDeleteCatagory"),
    btnUpdate = form.querySelector("input#btnDelete");
var displayErr = document.querySelector("#error-msg");
var loadingButton = document.querySelector('.loadingButton');

form.onsubmit = (e) => {
    e.preventDefault();
}
$(form).on("submit", function() {
    $(btnUpdate).val("Deleteing");
    $(loadingButton).addClass('spinning');
    var errors = "";
    $.ajax({
        url: "../../php/dashboard/delete-category.php",
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
                $(btnUpdate).val("Yes");
                $(displayErr).html(errors);
                console.log(errors);
            }
        },
        error: function(err) {
            $(loadingButton).removeClass('spinning');
            $(btnUpdate).val("Ye");
            $(displayErr).html(errors);
        }
    });
});
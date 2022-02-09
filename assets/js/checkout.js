const form = document.querySelector("form#frmCheckOutService"),
    ORDID = form.querySelector("input[type='hidden'][name='ORDID']#ORDID"),
    CUSTID = form.querySelector("input[type='hidden'][name='CUSTID']#CUSTID"),
    btnCheckOutService = form.querySelector("input[type='submit']#btnCheckOutService");
var orid;
form.onsubmit = (e) => {
    e.preventDefault();
}
$(document).ready(function() {
    $(btnCheckOutService).attr('disabled', 'disabled');
    getCUSTID();
    $(btnCheckOutService).on('click', function() {
        if (confirm("Do you want to buy this")) {
            var dt = new Date();
            year = dt.getFullYear();
            month = (dt.getMonth() + 1).toString().padStart(2, "0");
            day = dt.getDate().toString().padStart(2, "0");
            hour = dt.getHours().toString().padStart(2, "0");
            min = dt.getMinutes().toString().padStart(2, "0");
            sec = dt.getSeconds().toString().padStart(2, "0");
            orid = parseInt(year + month + day + hour + min + sec + ("" + Math.random()).substring(2, 6));
            ORDID.value = orid;
            CUSTID.value = custid;
            form.action = "/FSMS/pay/pgRedirect.php";
            form.submit();
        }
    });
});

function getCUSTID() {
    $.ajax({
        url: "./php/checkout.php",
        type: 'post',
        data: { requestType: "getCustomerID" },
        success: function(result) {
            $.each(result, function(key, value) {
                window.custid = parseInt(value.value);
                if (!isNaN(custid)) {
                    $(btnCheckOutService).removeAttr('disabled');
                }
            })
        },
        error: function(e) {
            console.log(e);
        }
    });
}
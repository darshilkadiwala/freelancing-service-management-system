const popupErr = document.querySelector("#popup-div");

function showPopUp(errors = "", bgColor = "", duration = 5000, fadeout = 1000) {
    if (errors !== "") {
        $(popupErr).children().remove();
        $(popupErr).append("<div class='popup-msg " + bgColor + "' id='popup-msg'></div>");
        $(popupErr).children().append("<p class='popup-msg-text'>" + errors + "</p><i class='bx bx-x icon-suffix popup-msg-icon' id='close-popup'></i>");
    }
    $(popupErr).show();
    $(popupErr).fadeIn();
    $('#popup-div .popup-msg#popup-msg i#close-popup').on('click', function() {
        $(popupErr).children().remove();
        $(popupErr).hide();
    });
    if (duration > 0) {
        setTimeout(function() {
            $(popupErr).fadeOut(fadeout);
        }, duration - fadeout);
        setTimeout(function() {
            $(popupErr).children().remove();
            $(popupErr).hide();
        }, duration);
    }
}
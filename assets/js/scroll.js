$(window).on('scroll', function() {
    if ($(window).scrollTop() > 10) {
        $('.navbar').addClass('active');
        // $('.l-navbar').addClass('active');
        $('.t-navbar').addClass('active');
        $('.Btn2').addClass('color-F5A623');
        $('#scrolltoTop').addClass('active');
        $('#scrolltoTop').show();
    } else {
        $('.navbar').removeClass('active');
        // $('.l-navbar').removeClass('active');
        $('.t-navbar').removeClass('active');
        $('.Btn2').removeClass('color-F5A623');
        $('#scrolltoTop').hide();
    }
});

$('#scrolltoTop').on('click', function() {
    $("html, body").animate({ scrollTop: 0 });
})

$(".profile").on("click", function() {
    $('.profile').toggleClass('active');
    $('.profile-icon .bx').toggleClass('rotate180');
});
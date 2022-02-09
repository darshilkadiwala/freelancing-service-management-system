// SHOW MENU
const showMenu = (toggleId, navbarId, bodyId) => {
    const toggle = document.querySelector(toggleId),
        navbar = document.getElementById(navbarId),
        bodypadding = document.getElementById(bodyId),
        closeMenu = document.querySelector("bx-x");

    if (toggle && navbar) {

        toggle.addEventListener('click', () => {
            // APARECER MENU
            navbar.classList.toggle('show-l-navbar');
            // ROTATE TOGGLE
            toggle.classList.toggle('bx-x');
            toggle.classList.toggle("active");
            // PADDING BODY
            bodypadding.classList.toggle('l-nav-expander');
        });

    }
}
showMenu('.l-nav-toggle i', 'l-navbar', 'main-content')

// LINK ACTIVE COLOR
const leftActiveLink = document.querySelectorAll('.l-nav-list .l-nav-link');
const topActiveLink = document.querySelectorAll('.t-nav-list .t-nav-link');

function topLink() {
    topActiveLink.forEach(l => l.classList.remove('active'));
    // topActiveLink.forEach(l => l.classList.remove('text-uppercase'));
    this.classList.add('active');
    // this.classList.add('text-uppercase');
}

function leftLink() {
    leftActiveLink.forEach(l => l.classList.remove('active'));
    this.classList.add('active');
}

leftActiveLink.forEach(l => l.addEventListener('click', leftLink));
topActiveLink.forEach(l => l.addEventListener('click', topLink));
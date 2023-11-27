// navbar-interactions.js
$(document).ready(function () {
    $(document).click(function (event) {
        let clickover = $(event.target);
        let $navbar = $(".navbar-collapse");
        let _opened = $navbar.hasClass("show");

        if (_opened === true && !clickover.hasClass("navbar-toggler")) {
            $navbar.collapse("hide");
        }
    });
});

// navbar-interactions.js
let prevScrollpos = window.pageYOffset;

$(window).scroll(function () {
    let currentScrollPos = window.pageYOffset;
    let $navbar = $(".navbar-collapse");

    if (currentScrollPos === 0) {
        // Si estamos en la parte superior de la página, mostrar el menú
        $navbar.collapse("hide");
    } else if (prevScrollpos > currentScrollPos) {
        // Desplazamiento hacia arriba
        $navbar.collapse("hide");
    } else {
        // Desplazamiento hacia abajo
        $navbar.collapse("hide");
    }

    prevScrollpos = currentScrollPos;
});
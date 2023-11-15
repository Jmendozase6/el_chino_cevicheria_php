window.onbeforeunload = function () {
    window.scrollTo(0, 0);
}
document.addEventListener("DOMContentLoaded", function () {
    const categoryLinks = document.querySelectorAll(".category-link");

    categoryLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            const targetCategory = this.getAttribute("data-target");
            const targetElement = document.getElementById("category-" + targetCategory);

            if (targetElement) {
                const offset = 100; // Ajusta según sea necesario
                const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - offset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
});

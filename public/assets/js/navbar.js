//
// Js for responsive navbar defined in scss/style
//

let burger = document.getElementById("burger");
let navbar = document.getElementById("navbar");

burger.addEventListener("click", () => {
    if (navbar.classList.contains("mobile-navbar-show")) {
        navbar.classList.add("mobile-navbar-hide");
        navbar.classList.remove("mobile-navbar-show")
    } else {
        navbar.classList.remove("mobile-navbar-hide");
        navbar.classList.add("mobile-navbar-show");
    }
});

window.addEventListener("resize", () => {
    console.log(window.innerWidth);
    // If windows is lower than sm breakpoint remove mobile navbar style
    if (window.innerWidth >= 575) {
        navbar.classList.remove("mobile-navbar-show");
        navbar.classList.remove("mobile-navbar-hide");
    }

});

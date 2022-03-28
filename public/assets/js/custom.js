const nav = document.getElementById("nav");
nav.style.transition = ".4s";
nav.style.backgroundColor = "#232222";

window.addEventListener("scroll", () => {
    if (window.scrollY > 150) {
        nav.classList.add("onscroll");
    } else {
        nav.classList.remove("onscroll");
    }
});
window.addEventListener("load", () => {
    setTimeout(() => {
        document.getElementById("loader").style.display = "none";
    }, 500);
});

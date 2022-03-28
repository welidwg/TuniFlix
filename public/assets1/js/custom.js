const nav = document.getElementById("nav2");
nav.style.transition = ".4s";
const username = document.getElementById("usernameNav");
username.style.color = "rgb(221,21,44) ";
username.style.fontWeight = "bolder";

window.addEventListener("scroll", () => {
    console.log();
    if (window.location.pathname != "/Dash/Main") {
        if (window.scrollY > 50) {
            // nav.style.position = "fixed";
            nav.classList.add("fixedTop");
            username.style.color = "white";
        } else {
            // nav.style.position = "relative";
            nav.classList.remove("fixedTop");
            username.style.color = "rgb(221,21,44) ";
        }
    }
});

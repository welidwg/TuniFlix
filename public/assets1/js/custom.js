const nav = document.getElementById("nav2");
nav.style.transition = ".4s";
const username = document.getElementById("usernameNav");
username.style.color = "rgb(221,21,44) ";
username.style.fontWeight = "bolder";
let item = document.getElementById("navStik");

window.addEventListener("scroll", () => {
    item.style.position = "sticky";
    item.style.top = "0px";
    if (window.location.pathname != "/Dash/Main") {
        if (window.scrollY > 90) {
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

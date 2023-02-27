let sideBar = document.querySelector("#sideBar")
let loginorregister = document.querySelector("#loginorRegister")
let loginbutton = document.querySelector(".loginbutton")
let registerbutton = document.querySelector(".registerbutton")

sideBar.addEventListener("mouseenter", toggleDropdown)
sideBar.addEventListener("mouseleave", toggleDropdown)


let dropdown = document.getElementById("sideBar");

function toggleDropdown() {
    if (dropdown.style.height === "10rem") {
        dropdown.style.height = "0";
    } else {
        dropdown.style.height = "10rem";
        dropdown.style.display = "block";
    }
}

function toggleLogIn(){
    if (loginorregister.style.display === "flex") {
        loginorregister.style.display = "none";
        loginbutton.style.display = "none";
        registerbutton.style.display = "none";
    } else {
        loginorregister.style.display = "flex";
        loginbutton.style.display = "inline-block";
        registerbutton.style.display = "inline-block";
    }
}

function selectModal(id, display) {
    document.getElementById(id).style.display=display
}

document.querySelectorAll(".modal").forEach(el => {
    el.addEventListener("click", evt => {
        if (evt.target.classList.contains("modal")) evt.target.style.display = "none"
    })
})
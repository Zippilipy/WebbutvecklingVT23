let sideBar = document.querySelector("#sideBar")
let loginorregister = document.querySelector("#loginorRegister")
let loginbutton = document.querySelector(".loginbutton")
let registerbutton = document.querySelector(".registerbutton")
let logout = document.querySelector("#logOut");
let userbutton = document.querySelector(".userandbutton");
let logoutbutton = document.querySelector(".logoutbutton");

/*
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
*/


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

function toggleLogOut() {
    if (logout.style.display === "flex") {
        logout.style.display = "none";
        userbutton.style.display = "none";
        logoutbutton.style.display = "none";

    } else {
        logout.style.display = "flex";
        userbutton.style.display = "inline-block";
        logoutbutton.style.display = "inline-block";
    }
}

function selectModal(modalId, display, showError) {
    var modal = document.getElementById(modalId);
    modal.style.display = display;
    // Display or hide the pop-up message
    var popup = document.getElementById('popup-message');
    if (display === 'block') {
        popup.style.display = 'block';
    } else {
        popup.style.display = 'none';
    }

    // Keep the form open if there was an error
    if (display === 'block' && showError) {
        modal.style.display = 'block';
    }
}

document.querySelectorAll(".modal").forEach(el => {
    el.addEventListener("click", evt => {
        if (evt.target.classList.contains("modal")) evt.target.style.display = "none"
    })
})

function hideThis(){
    var container = document.querySelector(".modal-error");
    container.style.display = "none";
}
function confirmAction() {
    var confirmMessage = "Are you sure you want to make this change?";
    return confirm(confirmMessage);
}
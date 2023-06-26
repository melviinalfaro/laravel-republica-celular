const body = document.querySelector("body");
const sidebar = body.querySelector("nav");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");
const home = document.querySelector(".home");
const sidebarBtn = document.querySelector(".sidebarBtn");
const toggleContainer = document.getElementById("toggle-container");
const modeText2 = document.querySelector(".toggle-title");

const storedSidebarState = localStorage.getItem("sidebarState");
const isSidebarClosed = storedSidebarState === "closed";

function updateSidebarBtnContent() {
    sidebarBtn.innerHTML = sidebar.classList.contains("active")
        ? "arrow_back"
        : "menu";
}

sidebar.addEventListener("mouseenter", function () {
    sidebar.classList.add("open");
});

sidebar.addEventListener("mouseleave", function () {
    sidebar.classList.remove("open");
});

const storedMode = localStorage.getItem("mode");
body.classList.toggle("dark", storedMode === "dark");

modeText.innerText = storedMode === "dark" ? "Oscuro" : "Claro";

modeSwitch.addEventListener("click", function () {
    body.classList.toggle("dark");
    const isDarkMode = body.classList.contains("dark");
    modeText.innerText = isDarkMode ? "Oscuro" : "Claro";
    localStorage.setItem("mode", isDarkMode ? "dark" : "light");
});

document.addEventListener("DOMContentLoaded", function () {
    const loadingOverlay = document.getElementById("loadingOverlay");

    function showLoadingOverlay() {
        loadingOverlay.style.display = "flex";
    }

    function hideLoadingOverlay() {
        loadingOverlay.style.display = "none";
    }

    showLoadingOverlay();

    window.addEventListener("load", function () {
        hideLoadingOverlay();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const notification = document.querySelector(".notificacion");

    if (notification) {
        notification.addEventListener("animationend", function () {
            notification.remove();
        });
    }
});

function redirectTo(url) {
    window.location.href = url;
}

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

const toggleSwitchNav2 = document.getElementById("toggle-switch-nav2");
const modeTextToggle = toggleSwitchNav2.querySelector(".mode-text");
const darkIcon = document.querySelector(".dropdown-icon.dark");
const lightIcon = document.querySelector(".dropdown-icon.light");

function toggleMode() {
    body.classList.toggle("dark");
    const isDarkMode = body.classList.contains("dark");

    if (isDarkMode) {
        modeTextToggle.innerText = "Oscuro";
        darkIcon.style.display = "block";
        lightIcon.style.display = "none";
    } else {
        modeTextToggle.innerText = "Claro";
        darkIcon.style.display = "none";
        lightIcon.style.display = "block";
    }

    localStorage.setItem("mode", isDarkMode ? "dark" : "light");
}

toggleSwitchNav2.addEventListener("click", toggleMode);

const storedMode2 = localStorage.getItem("mode");
if (storedMode2 === "dark") {
    body.classList.add("dark");
    modeTextToggle.innerText = "Oscuro";
    darkIcon.style.display = "block";
    lightIcon.style.display = "none";
} else {
    modeTextToggle.innerText = "Claro";
    darkIcon.style.display = "none";
    lightIcon.style.display = "block";
}


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

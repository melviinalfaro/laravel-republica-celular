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
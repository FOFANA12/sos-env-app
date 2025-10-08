document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("mobile-menu-toggle");
    const menu = document.getElementById("mobile-menu");
    const openIcon = document.getElementById("menu-open-icon");
    const closeIcon = document.getElementById("menu-close-icon");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
            openIcon.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
        });
    }
});
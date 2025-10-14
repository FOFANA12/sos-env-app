document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("mobile-menu-toggle");
    const menu = document.getElementById("mobile-menu");
    const openIcon = document.getElementById("menu-open-icon");
    const closeIcon = document.getElementById("menu-close-icon");

    // Get all dropdown buttons (settings and profile)
    const dropdownButtons = document.querySelectorAll(
        '[id$="-dropdown-button"]'
    );
    const dropdownMenus = document.querySelectorAll('[id$="-dropdown-menu"]');

    // Function to close all dropdowns
    function closeAllDropdowns() {
        dropdownMenus.forEach((menu) => {
            menu.classList.add("hidden");
        });
    }

    // Function to close mobile menu
    function closeMobileMenu() {
        if (menu) {
            menu.classList.add("hidden");
            openIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
        }
    }

    // Toggle mobile menu
    if (toggleBtn) {
        toggleBtn.addEventListener("click", (e) => {
            e.stopPropagation();

            // Close all dropdowns first
            closeAllDropdowns();

            // Toggle mobile menu
            menu.classList.toggle("hidden");
            openIcon.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
        });
    }

    // Handle dropdown buttons (settings and profile)
    dropdownButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.stopPropagation();

            const dropdownId = this.id.replace("-button", "-menu");
            const currentDropdown = document.getElementById(dropdownId);

            if (!currentDropdown) return;

            // Close mobile menu if open
            closeMobileMenu();

            // Close all other dropdowns
            dropdownMenus.forEach((menu) => {
                if (menu.id !== dropdownId) {
                    menu.classList.add("hidden");
                }
            });

            // Toggle current dropdown
            currentDropdown.classList.toggle("hidden");
        });
    });

    // Close all menus when clicking outside
    document.addEventListener("click", function (e) {
        const isDropdownButton = e.target.closest('[id$="-dropdown-button"]');
        const isDropdownMenu = e.target.closest('[id$="-dropdown-menu"]');
        const isMobileToggle = e.target.closest("#mobile-menu-toggle");
        const isMobileMenu = e.target.closest("#mobile-menu");

        if (
            !isDropdownButton &&
            !isDropdownMenu &&
            !isMobileToggle &&
            !isMobileMenu
        ) {
            closeAllDropdowns();
            closeMobileMenu();
        }
    });

    // Close mobile menu when clicking on a link inside it
    if (menu) {
        const mobileMenuLinks = menu.querySelectorAll("a");
        mobileMenuLinks.forEach((link) => {
            link.addEventListener("click", function () {
                closeMobileMenu();
            });
        });
    }
});

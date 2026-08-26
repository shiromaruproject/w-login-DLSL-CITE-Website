document.addEventListener("DOMContentLoaded", () => {
    const usernameBtn = document.getElementById("usernameBtn");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // Nothing to wire up if the user is logged out (elements won't exist)
    if (!usernameBtn || !dropdownMenu) return;

    function openDropdown() {
        dropdownMenu.classList.add("open");
        usernameBtn.setAttribute("aria-expanded", "true");
    }

    function closeDropdown() {
        dropdownMenu.classList.remove("open");
        usernameBtn.setAttribute("aria-expanded", "false");
    }

    function toggleDropdown() {
        if (dropdownMenu.classList.contains("open")) {
            closeDropdown();
        } else {
            openDropdown();
        }
    }

    // Toggle on username click
    usernameBtn.addEventListener("click", (event) => {
        event.stopPropagation();
        toggleDropdown();
    });

    // Close when clicking anywhere outside the menu/button
    document.addEventListener("click", (event) => {
        if (!dropdownMenu.contains(event.target) && event.target !== usernameBtn) {
            closeDropdown();
        }
    });

    // Close on Escape for keyboard users
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeDropdown();
        }
    });
});

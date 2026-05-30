document.addEventListener("DOMContentLoaded", function () {
    const html = document.documentElement;
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const iconMenu = document.getElementById("iconMenu");
    const iconClose = document.getElementById("iconClose");
    const overlay = document.getElementById("overlay");
    const themeToggle = document.getElementById("themeToggle");
    const iconMoon = document.getElementById("iconMoon");
    const iconSun = document.getElementById("iconSun");
    const profileToggle = document.getElementById("profileToggle");
    const profileMenu = document.getElementById("profileMenu");

    function setTheme(theme) {
        if (theme === "dark") {
            html.classList.add("dark");

            if (iconMoon) {
                iconMoon.classList.add("hidden");
            }

            if (iconSun) {
                iconSun.classList.remove("hidden");
            }
        } else {
            html.classList.remove("dark");

            if (iconMoon) {
                iconMoon.classList.remove("hidden");
            }

            if (iconSun) {
                iconSun.classList.add("hidden");
            }
        }

        localStorage.setItem("theme", theme);
    }

    function openSidebar() {
        if (!sidebar || !overlay || !iconMenu || !iconClose) {
            return;
        }

        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        iconMenu.classList.add("hidden");
        iconClose.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
    }

    function closeSidebar() {
        if (!sidebar || !overlay || !iconMenu || !iconClose) {
            return;
        }

        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        iconMenu.classList.remove("hidden");
        iconClose.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }

    function resetSidebar() {
        closeSidebar();
    }

    setTheme(localStorage.getItem("theme") || "light");
    resetSidebar();

    window.addEventListener("pageshow", resetSidebar);
    window.addEventListener("load", resetSidebar);

    if (themeToggle) {
        themeToggle.addEventListener("click", function () {
            if (html.classList.contains("dark")) {
                setTheme("light");
            } else {
                setTheme("dark");
            }
        });
    }

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener("click", function () {
            if (sidebar.classList.contains("-translate-x-full")) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener("click", closeSidebar);
    }

    document.querySelectorAll(".sidebar-link").forEach(function (link) {
        link.addEventListener("click", function () {
            closeSidebar();
        });
    });

    if (profileToggle && profileMenu) {
        profileToggle.addEventListener("click", function () {
            profileMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (event) {
            if (
                !profileToggle.contains(event.target) &&
                !profileMenu.contains(event.target)
            ) {
                profileMenu.classList.add("hidden");
            }
        });
    }

    document.querySelectorAll(".toggle-password").forEach(function (button) {
        button.addEventListener("click", function () {
            const input = button.parentElement.querySelector(".toggle-input");

            if (!input) {
                return;
            }

            if (input.type === "password") {
                input.type = "text";
                button.textContent = "🙈";
            } else {
                input.type = "password";
                button.textContent = "👁";
            }
        });
    });
});

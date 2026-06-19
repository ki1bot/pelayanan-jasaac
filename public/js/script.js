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

    function eyeIcon() {
        return `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
        `;
    }

    function eyeOffIcon() {
        return `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.576 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                <path d="m2 2 20 20"/>
            </svg>
        `;
    }

    function setPasswordIcon(button, isVisible) {
        button.innerHTML = isVisible ? eyeOffIcon() : eyeIcon();
        button.setAttribute(
            "aria-label",
            isVisible ? "Sembunyikan password" : "Tampilkan password",
        );
        button.classList.add(
            "inline-flex",
            "items-center",
            "justify-center",
            "text-green-700",
            "dark:text-green-300",
        );
    }

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
        const input = button.parentElement.querySelector(".toggle-input");

        if (!input) {
            return;
        }

        setPasswordIcon(button, false);

        button.addEventListener("click", function () {
            const isVisible = input.type === "password";
            input.type = isVisible ? "text" : "password";
            setPasswordIcon(button, isVisible);
        });
    });
});

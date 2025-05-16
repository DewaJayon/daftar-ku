const sidebarToggle = (el) => {
    let sidebarItems = document.querySelectorAll(".sidebar-item.has-sub");

    for (var i = 0; i < sidebarItems.length; i++) {
        let sidebarItem = sidebarItems[i];

        sidebarItems[i]
            .querySelector(".sidebar-link")
            .addEventListener("click", (e) => {
                e.preventDefault();
                let submenu = sidebarItem.querySelector(".submenu");
                toggleSubmenu(submenu);
            });

        // If submenu has submenu
        const submenuItems = sidebarItem.querySelectorAll(
            ".submenu-item.has-sub"
        );
        submenuItems.forEach((item) => {
            item.addEventListener("click", () => {
                const submenuLevelTwo = item.querySelector(".submenu");
                toggleSubmenu(submenuLevelTwo);

                // Pass second .submenu
                const height = calculateChildrenHeight(
                    item.parentElement,
                    true
                );
            });
        });
    }
    const toggleSubmenu = (el) => {
        if (el.classList.contains("submenu-open")) {
            el.classList.remove("submenu-open");
            el.classList.add("submenu-closed");
        } else {
            el.classList.remove("submenu-closed");
            el.classList.add("submenu-open");
        }
    };
};

export default sidebarToggle;

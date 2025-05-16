<script setup>
import { Link } from "@inertiajs/vue3";

import sidebarToggle from "@/utils/sidebar-toggle.js";
import DarkMode from "./DarkMode.vue";

const toggleHamburger = () => {
    const sidebar = document.querySelector("#sidebar");
    const main = document.querySelector("#main");
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
};

const toggleSidebarSubMenu = (el) => {
    sidebarToggle(el);
};
</script>
<template>
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo mt-2">
                        <Link :href="route('home')">DaftarKu</Link>
                    </div>
                    <DarkMode />
                    <div class="sidebar-toggler x">
                        <a
                            @click="toggleHamburger()"
                            class="sidebar-hide d-xl-none d-block"
                            ><i class="bi bi-x bi-middle"></i
                        ></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active">
                        <Link :href="route('home')" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </Link>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a
                            @click="toggleSidebarSubMenu(this)"
                            href="#"
                            class="sidebar-link"
                        >
                            <i class="bi bi-stack"></i>
                            <span>Management</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item">
                                <a
                                    href="component-accordion.html"
                                    class="submenu-link"
                                    >Project</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

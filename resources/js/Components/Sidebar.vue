<script setup>
import { Link } from "@inertiajs/vue3";

import sidebarToggle from "@/utils/sidebar-toggle.js";
import DarkMode from "./DarkMode.vue";
import { onMounted, ref } from "vue";

const sidebar = ref(null);
// const active = ref(false);

const toggleHamburger = () => {
    const sidebar = document.querySelector("#sidebar");
    const main = document.querySelector("#main");
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
};

onMounted(() => {
    sidebarToggle(sidebar);
});
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

                    <li
                        class="sidebar-item"
                        :class="{
                            ' active': route().current('home'),
                        }"
                    >
                        <Link :href="route('home')" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </Link>
                    </li>

                    <li
                        class="sidebar-item has-sub"
                        :class="{
                            ' active': route().current('projects.*'),
                        }"
                    >
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-stack"></i>
                            <span>Management</span>
                        </a>

                        <ul
                            class="submenu"
                            :class="{
                                ' submenu-open': route().current('projects.*'),
                            }"
                        >
                            <li
                                class="submenu-item"
                                :class="{
                                    ' active':
                                        route().current('projects.index'),
                                }"
                            >
                                <Link
                                    :href="route('projects.index')"
                                    class="submenu-link"
                                    >Project</Link
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

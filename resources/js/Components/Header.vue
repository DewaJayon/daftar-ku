<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import Badge from "./ui/Badge.vue";

const page = usePage();

const notification = ref(page.props.notification);

const notificationLenghtRef = ref(notification.value.length);
const notificationDropdownRef = ref("");
const profileDropdownRef = ref("");

watch(
    () => page.props.notification,
    (newNotification) => {
        notification.value = newNotification;
        notificationLenghtRef.value = newNotification.length;
    },
    { deep: true }
);

const notificationDropdown = () => {
    const notificationDropdown = document.querySelector(
        "#dropdownNotificationButton"
    );

    if (notificationDropdown.classList.contains("show")) {
        notificationDropdown.classList.remove("show");
        notificationDropdownRef.value = "";
        return;
    }

    notificationDropdownRef.value = "show";
};

const profileDropdown = () => {
    const profileDropdown = document.querySelector("#dropdownProfileButton");

    if (profileDropdown.classList.contains("show")) {
        profileDropdown.classList.remove("show");
        profileDropdownRef.value = "";
        return;
    }

    profileDropdownRef.value = "show";
};

const toggleHamburger = () => {
    const sidebar = document.querySelector("#sidebar");
    const main = document.querySelector("#main");
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
};
</script>

<template>
    <header>
        <nav class="navbar navbar-expand navbar-light navbar-top">
            <div class="container-fluid">
                <a
                    href="#"
                    @click="toggleHamburger()"
                    class="burger-btn d-block"
                >
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav ms-auto mb-lg-0">
                        <li class="nav-item dropdown me-3">
                            <a
                                class="nav-link active dropdown-toggle text-gray-600"
                                href="#"
                                id="dropdownNotificationButton"
                                data-bs-toggle="dropdown"
                                data-bs-display="static"
                                aria-expanded="false"
                                @click="notificationDropdown()"
                                :class="notificationDropdownRef"
                            >
                                <i class="bi bi-bell bi-sub fs-4"></i>
                                <span
                                    class="badge badge-notification bg-danger"
                                    >{{ notificationLenghtRef }}</span
                                >
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end notification-dropdown"
                                :class="notificationDropdownRef"
                                aria-labelledby="dropdownMenuButton"
                            >
                                <li class="dropdown-header">
                                    <h6>Notifications</h6>
                                </li>
                                <li
                                    class="dropdown-item notification-item"
                                    v-for="notification in page.props
                                        .notification"
                                    :key="notification.id"
                                >
                                    <Link
                                        class="d-flex align-items-center"
                                        href="#"
                                    >
                                        <div
                                            class="notification-icon bg-warning text-dark"
                                        >
                                            <i
                                                class="bi bi-exclamation-triangle-fill"
                                            />
                                        </div>
                                        <div class="notification-text ms-4">
                                            <p
                                                class="notification-title font-bold"
                                            >
                                                {{ notification.project_name }}
                                            </p>
                                            <p
                                                class="notification-subtitle font-thin text-sm text-uppercase"
                                            >
                                                {{ notification.name }}
                                            </p>
                                            <p
                                                class="notification-subtitle font-thin text-sm"
                                            >
                                                <Badge
                                                    :text="notification.status"
                                                    class="text-uppercase text-dark"
                                                />
                                            </p>
                                        </div>
                                    </Link>
                                </li>
                                <li
                                    class="dropdown-footer"
                                    v-if="notificationLenghtRef === 0"
                                >
                                    <p class="font-bold py-2 text-center">
                                        Tidak ada notifikasi
                                    </p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a
                            href="#"
                            data-bs-toggle="dropdown"
                            data-bs-display="dynamic"
                            aria-expanded="false"
                            id="dropdownProfileButton"
                            @click="profileDropdown()"
                        >
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">
                                        {{ page.props.auth.user.name }}
                                    </h6>
                                    <p class="mb-0 text-sm text-gray-600">
                                        User
                                    </p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="#" />
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem"
                            :class="profileDropdownRef"
                        >
                            <li>
                                <h6 class="dropdown-header">
                                    Hello, {{ page.props.auth.user.name }}!
                                </h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    ><i class="icon-mid bi bi-person me-2"></i>
                                    My Profile</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"
                                    ><i class="icon-mid bi bi-gear me-2"></i>
                                    Settings</a
                                >
                            </li>

                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <Link
                                    class="dropdown-item"
                                    :href="route('logout')"
                                    method="post"
                                >
                                    <i
                                        class="icon-mid bi bi-box-arrow-left me-2"
                                    ></i>
                                    Logout</Link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

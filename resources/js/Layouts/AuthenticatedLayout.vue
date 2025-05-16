<script setup>
import Footer from "@/Components/Footer.vue";
import Header from "@/Components/Header.vue";
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <div id="app">
        <Sidebar />
        <div id="main" class="layout-navbar navbar-fixed">
            <Header />
            <div id="main-content">
                <slot name="heading" />
                <slot />
                <Footer />
            </div>
        </div>
    </div>
</template>

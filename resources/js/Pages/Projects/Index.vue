<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Project" />

    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <h3>Project</h3>
            </div>
        </template>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="card">adasd</div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

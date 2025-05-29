<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    projectsCompleted: Number,
    projectsPending: Number,
    projectsInProgress: Number,
    projectsCancelled: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
        </template>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                                        >
                                            <div
                                                class="bg-success p-3 d-flex align-items-center justify-content-center rounded-3"
                                            >
                                                <i
                                                    class="bi bi-check-circle-fill fs-2 d-flex align-items-center justify-content-center text-dark"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-8 col-lg-12 col-xl-12 col-xxl-7"
                                        >
                                            <h6
                                                class="text-muted font-semibold"
                                            >
                                                Project Selesai
                                            </h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ props.projectsCompleted }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                                        >
                                            <div
                                                class="bg-warning p-3 d-flex align-items-center justify-content-center rounded-3"
                                            >
                                                <i
                                                    class="bi bi-exclamation-circle-fill fs-2 d-flex align-items-center justify-content-center text-dark"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-8 col-lg-12 col-xl-12 col-xxl-7"
                                        >
                                            <h6
                                                class="text-muted font-semibold"
                                            >
                                                Project Tertunda
                                            </h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ props.projectsPending }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                                        >
                                            <div
                                                class="bg-primary p-3 d-flex align-items-center justify-content-center rounded-3"
                                            >
                                                <i
                                                    class="bi bi-gear fs-2 d-flex align-items-center justify-content-center text-dark"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-8 col-lg-12 col-xl-12 col-xxl-7"
                                        >
                                            <h6
                                                class="text-muted font-semibold"
                                            >
                                                Project sedang berjalan
                                            </h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ props.projectsInProgress }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
                                        >
                                            <div
                                                class="bg-danger p-3 d-flex align-items-center justify-content-center rounded-3"
                                            >
                                                <i
                                                    class="bi bi-trash-fill fs-2 d-flex align-items-center justify-content-center text-dark"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-8 col-lg-12 col-xl-12 col-xxl-7"
                                        >
                                            <h6
                                                class="text-muted font-semibold"
                                            >
                                                Project dibatalkan
                                            </h6>
                                            <h6 class="font-extrabold mb-0">
                                                {{ props.projectsCancelled }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

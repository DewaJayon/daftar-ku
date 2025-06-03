<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav
                                aria-label="breadcrumb"
                                class="breadcrumb-header float-start float-lg-end"
                            >
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('home')"
                                            >Dashboard</Link
                                        >
                                    </li>
                                    <li
                                        class="breadcrumb-item active"
                                        aria-current="page"
                                    >
                                        Profile
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="page-content">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card">
                        <div
                            class="d-flex align-items-center justify-content-center p-3"
                        >
                            <img
                                alt="image"
                                width="300"
                                src="/assets/daftarku-logo.png"
                                class="rounded-circle img-fluid"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form
                            method="post"
                            class="needs-validation"
                            novalidate=""
                        >
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <UpdateProfileInformationForm />
                                <hr class="my-4" />
                                <UpdatePasswordForm />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

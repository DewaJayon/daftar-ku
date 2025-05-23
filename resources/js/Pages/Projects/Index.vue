<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import Create from "./Create.vue";
import setTableColor from "@/utils/datatable-pagination";

const props = defineProps({
    customers: {
        type: Object,
        required: true,
    },
    customerTypes: {
        type: Object,
        required: true,
    },
});

const edit = () => {
    alert("edit");
};

onMounted(() => {
    setTableColor();
});
</script>

<template>
    <Head title="Project" />

    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Projects</h3>
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
                                        Project
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h5 class="card-title">Project List</h5>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <div class="float-end">
                                    <Create :customerTypes="customerTypes" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <DataTable class="table">
                                <thead>
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <th>Nama Customer</th>
                                        <th>Nama Project</th>
                                        <th>Tech Stack</th>
                                        <th>Customer Type</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="customer in customers"
                                        :key="customer.id"
                                        @click="edit"
                                        style="cursor: pointer"
                                    >
                                        <td>{{ customer.user.name }}</td>
                                        <td>{{ customer.name }}</td>
                                        <td>{{ customer.project_name }}</td>
                                        <td>{{ customer.tech_stack }}</td>
                                        <td>
                                            {{ customer.customer_type.name }}
                                        </td>
                                        <td>Emmanuel</td>
                                        <td class="text-capitalize">
                                            {{
                                                customer.status.replace(
                                                    "_",
                                                    " "
                                                )
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import Create from "./Create.vue";
import setTableColor from "@/utils/datatable-pagination";
import IconButton from "@/Components/ui/IconButton.vue";
import Swal from "sweetalert2";
import Toast from "@/utils/toast";
import Edit from "./Edit.vue";

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

const tableData = ref(props.customers);

const tableColumns = ref([
    { data: "name", title: "Name" },
    { data: "project_name", title: "Project Name" },
    { data: "tech_stack", title: "Tech Stack" },
    { data: "customer_type.name", title: "Customer Type" },
    { data: "status", title: "Status" },
    { data: "payment.payment_method", title: "Payment Method" },
    { data: "payment.amount", title: "Amount" },
    { data: "payment.is_deposited", title: "Is Deposited" },
    { title: "Aksi" },
]);

watch(
    () => props.customers,
    () => {
        tableData.value = props.customers;
    }
);

const destroy = (slug) => {
    Swal.fire({
        title: slug,
        showCancelButton: true,
        confirmButtonText: "Hapus!",
    })
        .then((result) => {
            if (result.isConfirmed) {
                router.delete(route("projects.destroy", slug));
                Toast("Data berhasil dihapus!");
            }
        })
        .catch((err) => {
            console.log(err);
        });
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
                            <DataTable
                                class="table table-striped"
                                :data="tableData"
                                :columns="tableColumns"
                            >
                                <template #column-4="props">
                                    <td class="text-capitalize">
                                        {{
                                            props.rowData.status.replace(
                                                "_",
                                                " "
                                            )
                                        }}
                                    </td>
                                </template>
                                <template #column-8="props">
                                    <div class="d-flex">
                                        <div class="mx-auto">
                                            <IconButton
                                                icon="bi bi-trash"
                                                variant="danger"
                                                @click="
                                                    destroy(props.rowData.slug)
                                                "
                                            />
                                            <Edit
                                                :rowData="props.rowData"
                                                :customerTypes="customerTypes"
                                            />
                                        </div>
                                    </div>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

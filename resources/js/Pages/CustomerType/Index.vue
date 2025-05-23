<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import setTableColor from "@/utils/datatable-pagination";
import { Head, Link, router } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import Create from "./Create.vue";
import IconButton from "@/Components/ui/IconButton.vue";
import Swal from "sweetalert2";
import Toast from "@/utils/toast";
import Edit from "./Edit.vue";

const props = defineProps({
    customerTypes: {
        type: Array,
        required: true,
    },
});

const tableData = ref(props.customerTypes);

const columns = ref([{ data: "name", title: "Nama" }, { title: "Aksi" }]);

watch(
    () => props.customerTypes,
    () => {
        tableData.value = props.customerTypes;
    }
);

const destroy = (slug) => {
    Swal.fire({
        title: "Anda yakin ingin menghapus?",
        showCancelButton: true,
        confirmButtonText: "Hapus!",
    })
        .then((result) => {
            if (result.isConfirmed) {
                router.delete(route("customer-type.destroy", slug));
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
    <Head title="Customer" />
    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Customer Type</h3>
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
                                        Customer Type
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">Project List</h5>
                            </div>
                            <div class="col-6">
                                <div class="float-end">
                                    <Create />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <DataTable
                                class="table table-striped overflow-y-hidden"
                                :columns="columns"
                                :data="tableData"
                            >
                                <template #column-1="props">
                                    <div class="d-flex">
                                        <div class="mx-auto">
                                            <IconButton
                                                icon="bi bi-trash"
                                                variant="danger"
                                                @click="
                                                    destroy(props.rowData.slug)
                                                "
                                            />
                                            <Edit :rowData="props.rowData" />
                                        </div>
                                    </div>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </AuthenticatedLayout>
</template>

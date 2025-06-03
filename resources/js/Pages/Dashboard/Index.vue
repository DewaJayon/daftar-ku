<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Chart from "./Partials/Chart.vue";
import Statistic from "./Partials/Statistic.vue";

const props = defineProps({
    projectsCompleted: Number,
    projectsPending: Number,
    projectsInProgress: Number,
    projectsCancelled: Number,
    income: Array,
    month: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #heading>
            <div class="page-heading">
                <h3>Statistics</h3>
            </div>
        </template>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <Statistic
                        :projectsCompleted="props.projectsCompleted"
                        :projectsPending="props.projectsPending"
                        :projectsInProgress="props.projectsInProgress"
                        :projectsCancelled="props.projectsCancelled"
                    />
                </div>
                <div class="col-12">
                    <Chart :income="props.income" :month="props.month" />
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

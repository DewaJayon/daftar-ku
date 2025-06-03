<script setup>
const props = defineProps({
    income: Array,
    month: Array,
});

const options = {
    chart: {
        type: "area",
    },
    stroke: {
        curve: "smooth",
    },
    series: [
        {
            name: "Pendapatan",
            data: props.income,
        },
    ],
    xaxis: {
        categories: props.month,
    },
};
</script>

<template>
    <div class="card">
        <div class="card-header">
            <h4>Pendapatan</h4>
        </div>
        <div class="card-body">
            <apexchart
                width="100%"
                height="400"
                :options="options"
                :series="options.series"
            ></apexchart>
        </div>
    </div>
</template>

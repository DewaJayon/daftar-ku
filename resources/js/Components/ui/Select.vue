<script setup>
defineProps({
    name: {
        default: "select",
    },
});

const model = defineModel({
    required: true,
});
</script>

<template>
    <select class="form-select" v-model="model">
        <slot />
    </select>
</template>

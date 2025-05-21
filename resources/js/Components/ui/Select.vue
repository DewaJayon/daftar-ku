<script setup>
defineProps({
    name: {
        type: String,
        default: "select",
    },
});

const model = defineModel({
    type: String,
    required: true,
});
</script>

<template>
    <select class="form-select" v-model="model">
        <option hidden>{{ name }}</option>
        <slot />
    </select>
</template>

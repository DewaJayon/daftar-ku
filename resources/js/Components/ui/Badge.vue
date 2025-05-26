<script setup>
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    variant: {
        type: String,
        default: "bg-warning",
    },
});
</script>

<template>
    <span class="badge" :class="props.variant">{{ props.text }}</span>
</template>

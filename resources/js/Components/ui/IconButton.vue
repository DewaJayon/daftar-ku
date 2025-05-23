<script setup>
import { computed } from "vue";

const props = defineProps({
    icon: {
        type: String,
        required: true,
    },
    variant: {
        type: String,
        default: "success",
    },
});

const variant = computed(() => {
    return `btn-${props.variant}`;
});
</script>

<template>
    <button class="btn icon" :class="variant">
        <i :class="props.icon"></i>
    </button>
</template>

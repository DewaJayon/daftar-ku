<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div class="invalid-feedback">
        <i class="bx bx-radio-circle"></i>
        {{ message }}
    </div>
</template>

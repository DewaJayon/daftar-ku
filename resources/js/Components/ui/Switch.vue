<script setup>
const model = defineModel({
    type: String,
    required: true,
});
</script>

<template>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" v-model="model" />
    </div>
</template>

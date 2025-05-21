<script setup>
import { inject, defineProps, computed } from "vue";

const props = defineProps({
    title: { type: String, required: true },
    active: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
});

const { activeTab, registerTab } = inject("tabsContext");

const id = computed(
    () => `tab-${props.title.toLowerCase().replace(/\s+/g, "-")}`
);

// Register tab saat komponen dibuat
registerTab({
    id: id.value,
    title: props.title,
    active: props.active,
    disabled: props.disabled,
});
</script>

<template>
    <div v-show="activeTab === id">
        <slot />
    </div>
</template>

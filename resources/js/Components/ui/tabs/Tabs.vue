<script setup>
import { ref, provide, watch } from "vue";

const props = defineProps({
    contentClass: { type: String, default: "mt-3" },
});

const activeTab = ref(null);
const tabs = ref([]);

const registerTab = (tab) => {
    tabs.value.push(tab);
    // Set tab pertama sebagai aktif jika belum ada yang aktif
    if (tabs.value.length === 1 || tab.active) {
        activeTab.value = tab.id;
    }
};

provide("tabsContext", {
    activeTab,
    registerTab,
});
</script>

<template>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li v-for="tab in tabs" :key="tab.id" class="nav-item">
                <button
                    class="nav-link"
                    :class="{
                        active: activeTab === tab.id,
                        disabled: tab.disabled,
                    }"
                    @click="!tab.disabled && (activeTab = tab.id)"
                >
                    {{ tab.title }}
                </button>
            </li>
        </ul>

        <div :class="['tab-content', contentClass]">
            <slot :activeTab="activeTab" />
        </div>
    </div>
</template>

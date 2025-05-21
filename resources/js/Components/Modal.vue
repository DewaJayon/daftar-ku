<script setup lang="ts">
import { ref } from "vue";

const bootstrap = typeof window !== `undefined` && import("bootstrap");
defineProps({
    title: {
        type: String,
        default: "<<Title goes here>>",
    },
});

const modal = ref<HTMLElement | null>(null);
let thisModalObj: any = null;

function _show() {
    if (!thisModalObj && modal.value) {
        bootstrap?.then(({ Modal }) => {
            thisModalObj = new Modal(modal.value, { backdrop: false });
            thisModalObj.show();
        });
    } else {
        thisModalObj?.show();
    }
}

function _hide() {
    thisModalObj?.hide();
}

defineExpose({ show: _show, hide: _hide });
</script>

<template>
    <div
        ref="modal"
        class="modal fade text-left w-100"
        id="xlarge"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel16"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ title }}
                    </h4>
                    <button
                        type="button"
                        class="close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="body" />
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-light-secondary"
                        data-bs-dismiss="modal"
                    >
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

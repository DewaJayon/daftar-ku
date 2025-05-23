<script setup>
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/ui/InputError.vue";
import InputLabel from "@/Components/ui/InputLabel.vue";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import TextInput from "@/Components/ui/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Toast from "@/utils/toast";
import Spinner from "@/Components/ui/Spinner.vue";

const modal = ref(null);

const showModal = () => {
    modal.value?.show();
};

const form = useForm({
    name: "",
});

const submit = () => {
    form.post(route("customer-type.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            modal.value?.hide();
            Toast("Data berhasil disimpan!");
        },
    });
};
</script>

<template>
    <PrimaryButton @click="showModal">Tambah</PrimaryButton>

    <Modal ref="modal" title="Tambah Customer Type">
        <template #body>
            <section id="basic-horizontal-layouts">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <InputLabel
                                                        for="name"
                                                        value="Tipe Customer"
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-8 form-group"
                                                >
                                                    <TextInput
                                                        v-model="form.name"
                                                        placeholder="Tipe Customer"
                                                        :class="{
                                                            'is-invalid':
                                                                form.errors
                                                                    .name,
                                                        }"
                                                    />
                                                    <InputError
                                                        :message="
                                                            form.errors.name
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </template>
        <template #footer>
            <PrimaryButton
                @click="submit"
                class="me-1 mb-1"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                <Spinner v-show="form.processing" />
                {{ form.processing ? "Menyimpan..." : "Simpan" }}
            </PrimaryButton>
        </template>
    </Modal>
</template>

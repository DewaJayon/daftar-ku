<script setup>
import Tabs from "@/Components/ui/tabs/Tabs.vue";
import Tab from "@/Components/ui/tabs/Tab.vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import { ref } from "vue";
import InputLabel from "@/Components/ui/InputLabel.vue";
import TextInput from "@/Components/ui/TextInput.vue";
import Select from "@/Components/ui/Select.vue";
import Switch from "@/Components/ui/Switch.vue";
import InputError from "@/Components/ui/InputError.vue";
import Toast from "@/utils/toast";
import Spinner from "@/Components/ui/Spinner.vue";

const props = defineProps({
    customerTypes: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    user_id: props.user_id,
    name: "",
    project_name: "",
    tech_stack: "",
    customer_type: "",
    status: "",
    payment_method: "",
    amount: Number(),
    is_deposited: false,
    deposited_amount: Number(),
});

const status = [
    {
        value: "pending",
        name: "Pending",
    },
    {
        value: "in_progres",
        name: "In Progress",
    },
    {
        value: "completed",
        name: "Completed",
    },
    {
        value: "cancelled",
        name: "Cancelled",
    },
];

const modal = ref(null);

const showModal = () => {
    modal.value?.show();
};

const submit = () => {
    form.post(route("projects.store"), {
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
    <PrimaryButton @click="showModal">Tambah Project</PrimaryButton>
    <Modal ref="modal" title="Tambah Project">
        <template #body>
            <Tabs>
                <Tab title="Customer" active>
                    <div class="row match-height">
                        <div class="col-12">
                            <form class="form" @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <InputLabel
                                                for="name"
                                                value="Nama Customer"
                                            />
                                            <TextInput
                                                v-model="form.name"
                                                type="text"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.name,
                                                }"
                                                placeholder="Nama Customer"
                                                id="name"
                                            />
                                            <InputError
                                                :message="form.errors.name"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <InputLabel
                                                for="project-name"
                                                value="Nama Project"
                                            />
                                            <TextInput
                                                v-model="form.project_name"
                                                type="text"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors
                                                            .project_name,
                                                }"
                                                placeholder="Nama Project"
                                                id="project-name"
                                            />
                                            <InputError
                                                :message="
                                                    form.errors.project_name
                                                "
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <InputLabel
                                                for="tech-stack"
                                                value="Tech Stack"
                                            />
                                            <TextInput
                                                v-model="form.tech_stack"
                                                type="text"
                                                placeholder="Tech Stack"
                                                id="tech-stack"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.tech_stack,
                                                }"
                                            />
                                            <InputError
                                                :message="
                                                    form.errors.tech_stack
                                                "
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <InputLabel
                                                for="customer-type"
                                                value="Customer Type"
                                            />
                                            <Select
                                                name="Customer Type"
                                                id="customer-type"
                                                v-model="form.customer_type"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors
                                                            .customer_type,
                                                }"
                                            >
                                                <option
                                                    v-for="customerType in customerTypes"
                                                    :value="customerType.id"
                                                    :key="customerType.id"
                                                    :selected="
                                                        customerType.id ==
                                                        form.customer_type
                                                    "
                                                >
                                                    {{ customerType.name }}
                                                </option>
                                            </Select>
                                            <InputError
                                                :message="
                                                    form.errors.customer_type
                                                "
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <InputLabel
                                                for="status"
                                                value="Status"
                                            />
                                            <Select
                                                name="Status"
                                                id="status"
                                                v-model="form.status"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.status,
                                                }"
                                            >
                                                <option
                                                    v-for="s in status"
                                                    :value="s.value"
                                                    :key="s.value"
                                                >
                                                    {{ s.name }}
                                                </option>
                                            </Select>
                                            <InputError
                                                :message="form.errors.status"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </Tab>
                <Tab title="Payment">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <InputLabel
                                        for="payment-method"
                                        value="Payment Method"
                                    />
                                    <TextInput
                                        type="text"
                                        placeholder="Payment Method"
                                        id="payment-method"
                                        v-model="form.payment_method"
                                        :class="{
                                            'is-invalid':
                                                form.errors.payment_method,
                                        }"
                                    />
                                    <InputError
                                        :message="form.errors.payment_method"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <InputLabel
                                        for="project-amount"
                                        value="Harga Project"
                                    />
                                    <TextInput
                                        type="number"
                                        placeholder="Harga Project"
                                        id="project-amount"
                                        v-model="form.amount"
                                        :class="{
                                            'is-invalid': form.errors.amount,
                                        }"
                                    />
                                    <InputError :message="form.errors.amount" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <InputLabel value="Deposit" />
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <Switch v-model="form.is_deposited" />
                                    </div>
                                    <TextInput
                                        type="number"
                                        placeholder="Deposit"
                                        v-model="form.deposited_amount"
                                        :disabled="!form.is_deposited"
                                        :class="{
                                            'is-invalid':
                                                form.errors.deposited_amount,
                                        }"
                                    />
                                    <InputError
                                        :message="form.errors.deposited_amount"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </Tab>
            </Tabs>
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

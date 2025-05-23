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
    form.post(route("projects.store"));
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
                                                placeholder="Nama Customer"
                                                id="name"
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
                                                placeholder="Nama Project"
                                                id="project-name"
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
                                            >
                                                <option
                                                    v-for="s in status"
                                                    :value="s.value"
                                                    :key="s.value"
                                                >
                                                    {{ s.name }}
                                                </option>
                                            </Select>
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
                                    />
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
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </Tab>
            </Tabs>
        </template>
        <template #footer>
            <PrimaryButton @click="submit" class="me-1 mb-1">
                Submit
            </PrimaryButton>
        </template>
    </Modal>
</template>

<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/ui/InputError.vue";
import Checkbox from "@/Components/ui/Checkbox.vue";
import TextInput from "@/Components/ui/TextInput.vue";
import InputLabel from "@/Components/ui/InputLabel.vue";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Login" />
    <GuestLayout>
        <div class="card">
            <div class="card-header mb-1 pb-0">
                <h2 class="card-title text-center">Login</h2>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" @submit.prevent="submit">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <InputLabel
                                            for="email-id-icon"
                                            value="Email"
                                        />
                                        <div class="position-relative">
                                            <TextInput
                                                type="text"
                                                v-model="form.email"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.email,
                                                }"
                                                placeholder="Email"
                                                id="email-id-icon"
                                            />
                                            <InputError
                                                :message="form.errors.email"
                                            />
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <InputLabel
                                            for="password-id-icon"
                                            value="Password"
                                        />
                                        <div class="position-relative">
                                            <TextInput
                                                v-model="form.password"
                                                type="password"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.password,
                                                }"
                                                placeholder="Password"
                                                id="password-id-icon"
                                            />

                                            <InputError
                                                :message="form.errors.password"
                                            />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <Link :href="route('password.request')"
                                        >Lupa Password</Link
                                    >
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-check">
                                        <div class="checkbox mt-2">
                                            <Checkbox
                                                id="remember-me-v"
                                                v-model:checked="form.remember"
                                            />
                                            <InputLabel
                                                for="remember-me-v"
                                                value="Remember Me"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mt-2">
                                        Belum Punya Akun?
                                        <Link :href="route('register')"
                                            >Register</Link
                                        >
                                    </div>
                                </div>
                                <div
                                    class="col-12 d-flex justify-content-center mt-4"
                                >
                                    <PrimaryButton
                                        type="submit"
                                        class="me-1"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Login
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

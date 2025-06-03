<script setup>
import InputError from "@/Components/ui/InputError.vue";
import InputLabel from "@/Components/ui/InputLabel.vue";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import Spinner from "@/Components/ui/Spinner.vue";
import TextInput from "@/Components/ui/TextInput.vue";
import Toast from "@/utils/toast";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            Toast("Password berhasil diperbarui!");
        },
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="mt-4">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>

            <p class="mt-1 text-sm text-gray-600">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak
                agar tetap aman.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-2">
            <div>
                <InputLabel for="current_password" value="Password Lama" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1"
                    :class="{
                        'is-invalid': form.errors.current_password,
                    }"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="mt-2"
                />
            </div>

            <div class="mt-2">
                <InputLabel for="password" value="Password Baru" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1"
                    :class="{ 'is-invalid': form.errors.password }"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="mt-2">
                <InputLabel
                    for="password_confirmation"
                    value="Konfirmasi Password Baru"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1"
                    :class="{
                        'is-invalid': form.errors.password_confirmation,
                    }"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="d-flex mt-3">
                <PrimaryButton :disabled="form.processing">
                    <Spinner v-show="form.processing" />
                    {{ form.processing ? "Menyimpan..." : "Simpan" }}
                </PrimaryButton>
            </div>
        </form>
    </section>
</template>

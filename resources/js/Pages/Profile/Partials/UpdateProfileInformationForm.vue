<script setup>
import InputError from "@/Components/ui/InputError.vue";
import InputLabel from "@/Components/ui/InputLabel.vue";
import PrimaryButton from "@/Components/ui/PrimaryButton.vue";
import Spinner from "@/Components/ui/Spinner.vue";
import TextInput from "@/Components/ui/TextInput.vue";
import Toast from "@/utils/toast";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route("profile.update"), {
        onSuccess: () => Toast("Data berhasil diperbarui!"),
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Informasi profile</h2>

            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi profil akun dan alamat email Anda.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-3">
            <div class="mt-2">
                <InputLabel for="name" value="Nama" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1"
                    :class="{ 'is-invalid': form.errors.name }"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-3">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1"
                    :class="{ 'is-invalid': form.errors.email }"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Alamat email Anda belum diverifikasi.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    Tautan verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            </div>

            <div class="d-flex align-items-center mt-3">
                <PrimaryButton :disabled="form.processing">
                    <Spinner v-show="form.processing" />
                    {{ form.processing ? "Menyimpan..." : "Simpan" }}
                </PrimaryButton>
            </div>
        </form>
    </section>
</template>

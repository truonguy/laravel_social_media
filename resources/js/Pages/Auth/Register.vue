<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

// const showPassword = ref(false);
// const showConfirmPassword = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

// const toggleConfirmPasswordVisibility = () => {
//     showConfirmPassword.value = !showConfirmPassword.value;
// };

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <!-- Input Name -->
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Input Email -->
            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="Enter your email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Input Password -->
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <div class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        id="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pr-10"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter your password"
                    />
                    <!-- Icon hiển thị/ẩn mật khẩu -->
                    <!-- <span
                        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        @click="togglePasswordVisibility"
                    >
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </span> -->
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Input Confirm Password -->
            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <div class="relative">
                    <input
                        :type="showConfirmPassword ? 'text' : 'password'"
                        id="password_confirmation"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pr-10"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                    />
                    <!-- Icon hiển thị/ẩn mật khẩu -->
                    <!-- <span
                        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                        @click="toggleConfirmPasswordVisibility"
                    >
                        <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </span> -->
                </div>
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <!-- Links và Button -->
            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<style>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css";
</style>

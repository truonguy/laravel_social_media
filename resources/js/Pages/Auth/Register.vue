<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
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
          placeholder="Enter your email"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <!-- Input Password -->
      <div class="mt-4">
        <InputLabel for="password" value="Password" />
        <div class="relative">
          <TextInput
            id="password"
            :type="showPassword ? 'text' : 'password'"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="new-password"
            placeholder="Enter your password"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <!-- Input Confirm Password -->
      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <div class="relative">
          <TextInput
            id="password_confirmation"
            :type="showConfirmPassword ? 'text' : 'password'"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
            placeholder="Confirm your password"
          />
        </div>
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <!-- Links và Button -->
      <div class="mt-4 flex items-center justify-end">
        <Link
          :href="route('login')"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-slate-300"
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

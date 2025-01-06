<script setup>
import { ref, onMounted } from 'vue';
import { MoonIcon, SunIcon } from '@heroicons/vue/24/solid';

const darkModeEnabled = ref(localStorage.getItem('darkMode') === '1');
const showDropdown = ref(false);

function setDarkMode(enable) {
    const html = window.document.documentElement;
    if (enable) {
        html.classList.add('dark');
        localStorage.setItem('darkMode', '1');
        darkModeEnabled.value = true;
    } else {
        html.classList.remove('dark');
        localStorage.setItem('darkMode', '0');
        darkModeEnabled.value = false;
    }
    showDropdown.value = false;
}

function toggleDropdown() {
    showDropdown.value = !showDropdown.value;
}

onMounted(() => {
    if (darkModeEnabled.value) {
        document.documentElement.classList.add('dark');
    }
});
</script>

<template>
    <div class="relative inline-block px-2">
        <button @click="toggleDropdown" class="dark:text-white cursor-pointer">
            <template v-if="darkModeEnabled">
                <MoonIcon class="w-5 h-5" />
            </template>
            <template v-else>
                <SunIcon class="w-5 h-5" />
            </template>
        </button>
        <div v-if="showDropdown" class="absolute mt-2 bg-white dark:bg-gray-800 shadow-lg rounded-lg" style="left: -5px;">
            <button
                v-if="darkModeEnabled"
                @click="setDarkMode(false)"
                class="flex items-center rounded-md px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 active:bg-gray-200 dark:active:bg-gray-600">
                <SunIcon class="w-5 h-5 mr-2 dark:text-slate-300" />
            </button>
            <button
                v-else
                @click="setDarkMode(true)"
                class="flex items-center rounded-md px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 active:bg-gray-200 dark:active:bg-gray-600">
                <MoonIcon class="w-5 h-5 mr-2 dark:text-slate-300" />
            </button>
        </div>
    </div>
</template>

<style scoped>
button {
    cursor: pointer;
}
</style>

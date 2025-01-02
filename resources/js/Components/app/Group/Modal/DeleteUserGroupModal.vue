<template>
    <teleport to="body">
        <TransitionRoot appear :show="show" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>
                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded bg-white text-left align-middle shadow-xl transition-all">
                                <DialogTitle as="h3"
                                    class="flex items-center justify-between py-3 px-4 font-medium bg-gray-100 text-gray-900">
                                    {{ title }}
                                    <button @click="closeModal"
                                        class="w-8 h-8 rounded-full hover:bg-black/5 transition flex items-center justify-center">
                                        <XMarkIcon class="w-4 h-4" />
                                    </button>
                                </DialogTitle>
                                <div class="p-4">
                                    <div class="font-medium text-gray-900">{{ message }}</div>
                                </div>
                                <div class="py-3 px-4 flex justify-between items-center gap-2">
                                    <button type="button"
                                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline
                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 w-full"
                                        @click="confirm">
                                        {{ confirmButtonText }}
                                    </button>
                                    <button type="button"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 w-full"
                                        @click="closeModal">
                                        {{ cancelButtonText }}
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </teleport>
</template>

<script>
import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";

export default {
    name: "ConfirmModal",
    components: { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild, XMarkIcon },
    props: {
        show: {
            type: Boolean,
            required: true,
        },
        title: {
            type: String,
            default: "Confirmation",
        },
        message: {
            type: String,
            default: "Are you sure you want to proceed?",
        },
        confirmButtonText: {
            type: String,
            default: "Confirm",
        },
        cancelButtonText: {
            type: String,
            default: "Cancel",
        },
    },
    emits: ["confirm", "close"],
    methods: {
        confirm() {
            this.$emit("confirm");
            this.closeModal();
        },
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>

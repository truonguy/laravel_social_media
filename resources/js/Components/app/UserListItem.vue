<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import DeleteUserGroupModal from './Group/Modal/DeleteUserGroupModal.vue';
import { ref } from 'vue';
defineProps({
    user: Object,
    forApprove: {
        type: Boolean,
        default: false
    },
    showRoleDropdown: {
        type: Boolean,
        default: false
    },
    disableRoleDropdown: {
        type: Boolean,
        default: false
    }
})
defineEmits(['approve', 'reject', 'roleChange', 'delete'])
const showDeleteModal = ref(false);
const userToDelete = ref(null);

function confirmDelete(user) {
    userToDelete.value = user;
    showDeleteModal.value = true;
}

function deleteUser() {
    const form = useForm({
        user_id: userToDelete.value.id,
    });
    form.delete(route('group.removeUser', props.group.slug), {
        preserveScroll: true,
    });
    showDeleteModal.value = false;
}
</script>
<template>
    <div class="bg-white transition-all border-2 border-transparent hover:border-indigo-500">
        <div class="flex items-center gap-2 py-2 px-2">
            <Link :href="route('profile', user.username)">
            <img :src="user.avatar_url" class="w-[32px] rounded-full" />
            </Link>
            <div class="flex justify-between flex-1">
                <Link :href="route('profile', user.username)">
                <h3 class="font-black hover:underline">{{ user.name }}</h3>
                </Link>
                <div v-if="forApprove" class="flex gap-1">
                    <button class="text-xs py-1 px-2 rounded bg-emerald-500 hover:bg-emerald-600 text-white"
                        @click.prevent.stop="$emit('approve', user)">
                        approve
                    </button>
                    <button class="text-xs py-1 px-2 rounded bg-red-500 hover:bg-red-600 text-white"
                        @click.prevent.stop="$emit('reject', user)">
                        reject
                    </button>
                </div>
                <div v-if="showRoleDropdown">
                    <select @change="$emit('roleChange', user, $event.target.value)"
                        class="rounded-md border-0 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 max-w-xs text-sm leading-6"
                        :disabled="disableRoleDropdown">
                        <option :selected="user.role === 'admin'">admin</option>
                        <option :selected="user.role === 'user'">user</option>
                    </select>
                    <button @click="confirmDelete(user)"
                        class="text-xs py-1.5 px-2 rounded bg-gray-700 hover:bg-gray-800 text-white ml-3"
                        :disabled="disableRoleDropdown">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        <DeleteUserGroupModal
        v-if="showDeleteModal"
        :show="showDeleteModal"
        title="Confirm Deletion"
        :message="`Are you sure you want to remove user '${userToDelete?.name}' from this group?`"
        @cancel="showDeleteModal = false"
        @confirm="deleteUser"
        @close="showDeleteModal = false"
    />
    </div>
</template>
<style scoped></style>

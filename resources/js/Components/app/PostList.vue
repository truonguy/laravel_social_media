<script setup>
import PostItem from "@/Components/app/PostItem.vue";
import PostModal from "@/Components/app/PostModal.vue";
import {ref} from "vue";
import DeletePostModal from "./DeletePostModal.vue";
import { usePage } from "@inertiajs/vue3";
defineProps({
    posts: Array
})

const authUser = usePage().props.auth.user;

const showEditModal = ref(false)
const showDeleteModal = ref(false)
const editPost = ref({})
const deletePost = ref({})
function openEditModal(post) {
    editPost.value = post;
    showEditModal.value = true;
}

function openDeleteModal(post) {
    deletePost.value = post;
    showDeleteModal.value = true;
}

function onModalHide() {
    editPost.value = {
        id: null,
        body: '',
        user: authUser
    }
}

</script>
<template>
    <div class="overflow-auto h-full">
        <PostItem v-for="post of posts" :key="post.id" :post="post" @editClick="openEditModal" @deleteClick="openDeleteModal"/>
        <PostModal :post="editPost" v-model="showEditModal" @hide="onModalHide"/>
        <DeletePostModal :post="deletePost" v-model="showDeleteModal"/>
    </div>
</template>
<style scoped>
</style>

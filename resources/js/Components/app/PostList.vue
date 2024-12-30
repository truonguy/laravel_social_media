<script setup>
import PostItem from "@/Components/app/PostItem.vue";
import PostModal from "@/Components/app/PostModal.vue";
import { ref } from "vue";
import DeletePostModal from "./DeletePostModal.vue";
import { usePage } from "@inertiajs/vue3";
import AttachmentPreviewModal from "@/Components/app/AttachmentPreviewModal.vue";
defineProps({
    posts: Array
})

const authUser = usePage().props.auth.user;

const showEditModal = ref(false)
const showDeletePostModal = ref(false)
const editPost = ref({})
const showAttachmentsModal = ref(false)
const deletePost = ref({})
const previewAttachmentsPost = ref({})

function openEditModal(post) {
    editPost.value = post;
    showEditModal.value = true;
}

function openAttachmentPreviewModal(post, index) {
    previewAttachmentsPost.value = {
        post,
        index
    }
    showAttachmentsModal.value = true;
}

function openDeletePostModal(post) {
    deletePost.value = post;
    showDeletePostModal.value = true;
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
        <PostItem v-for="post of posts" :key="post.id" :post="post" @editClick="openEditModal"
            @deletePostClick="openDeletePostModal" @attachmentClick="openAttachmentPreviewModal" />
        <PostModal :post="editPost" v-model="showEditModal" @hide="onModalHide" />
        <AttachmentPreviewModal :attachments="previewAttachmentsPost.post?.attachments || []"
            v-model:index="previewAttachmentsPost.index" v-model="showAttachmentsModal" />
        <DeletePostModal :post="deletePost" v-model="showDeletePostModal" />

    </div>
</template>
<style scoped></style>

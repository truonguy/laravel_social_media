<script setup>
import { Head } from '@inertiajs/vue3';
import GroupList from "@/Components/app/Home/GroupList.vue";
import FollowingList from "@/Components/app/Home/FollowingList.vue";
import CreatePost from "@/Components/app/Home/CreatePost.vue";
import PostList from "@/Components/app/PostList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    posts: Object,
    groups: Array,
    followings: Array
});
</script>

<template>

    <Head title="Social Media Website" />

    <AuthenticatedLayout>
        <div class="grid lg:grid-cols-12 gap-3 p-4 lg:h-screen h-full">
            <div class="lg:col-span-3 lg:order-1 h-full overflow-hidden">
                <GroupList :groups="groups" />
            </div>
            <div class="lg:col-span-3 lg:order-3 h-full overflow-hidden">
                <FollowingList :users="followings"/>
            </div>
            <div class="lg:col-span-6 lg:order-2 h-full overflow-hidden flex flex-col">
                <CreatePost />
                <PostList :posts="posts.data" class="flex-1" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>

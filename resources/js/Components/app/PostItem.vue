<script setup>
import { ChatBubbleLeftRightIcon, HandThumbUpIcon } from "@heroicons/vue/24/outline";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import PostUserHeader from "@/Components/app/PostUserHeader.vue";
import axiosClient from "@/axiosClient.js";
import ReadMoreReadLess from "@/Components/app/ReadMoreReadLess.vue";
import PostAttachments from "./PostAttachments.vue";
import CommentList from "@/Components/app/CommentList.vue";
import { MapPinIcon } from "@heroicons/vue/24/solid";
import { usePage, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import UrlPreview from "@/Components/app/UrlPreview.vue";
import EditDeleteDropdown from "./EditDeleteDropdown.vue";

const props = defineProps({
  post: Object,
  currentUser: Object,
});

const authUser = usePage().props.auth.user;
const group = usePage().props.group;

const user = computed(() => props.comment?.user || props.post?.user);
const emit = defineEmits(["editClick", "attachmentClick"]);

const postBody = computed(() => {
  let content = props.post.body.replace(
    /(?:(\s+)|<p>)((#\w+)(?![^<]*<\/a>))/g,
    (match, group1, group2) => {
      const encodedGroup = encodeURIComponent(group2);
      return `${
        group1 || ""
      }<a href="/search/${encodedGroup}" class="hashtag">${group2}</a>`;
    }
  );
  return content;
});

function openEditModal() {
  emit("editClick", props.post);
}

function openDeletePostModal() {
  emit("deletePostClick", props.post);
}

function openAttachment(ind) {
  emit("attachmentClick", props.post, ind);
}

function sendReaction() {
  axiosClient
    .post(route("post.reaction", props.post), {
      reaction: "like",
    })
    .then(({ data }) => {
      props.post.current_user_has_reaction = data.current_user_has_reaction;
      props.post.num_of_reactions = data.num_of_reactions;
    });
}

function copyToClipboard() {
  // Replace 'your-text-to-copy' with the actual text you want to copy
  const textToCopy = route("post.view", props.post.id);
  // Create a temporary element to copy the text
  const tempInput = document.createElement("input");
  tempInput.value = textToCopy;
  document.body.appendChild(tempInput);
  // Select the text in the temporary input
  tempInput.select();
  document.execCommand("copy");
  // Remove the temporary input from the DOM
  documen;

  t.body.removeChild(tempInput);
}
const pinAllowed = computed(() => {
  return (
    user.value.id === authUser.id ||
    (props.post.group && props.post.group.role === "admin")
  );
});
const isPinned = computed(() => {
  if (group?.id) {
    return group?.pinned_post_id === props.post.id;
  }
  return authUser?.pinned_post_id === props.post.id;
});

function pinUnpinPost() {
  const form = useForm({
    forGroup: group?.id,
  });
  let isPinned = false;
  if (group?.id) {
    isPinned = group?.pinned_post_id === props.post.id;
  } else {
    isPinned = authUser?.pinned_post_id === props.post.id;
  }
  form.post(route("post.pinUnpin", props.post.id), {
    preserveScroll: true,
    onSuccess: () => {
      if (group?.id) {
        group.pinned_post_id = isPinned ? null : props.post.id;
      } else {
        authUser.pinned_post_id = isPinned ? null : props.post.id;
      }
    },
  });
}
</script>

<template>
  <div
    class="bg-white border dark:bg-slate-950 dark:border-slate-900 dark:text-gray-100 rounded p-4 mb-3"
  >
    <div class="flex items-center justify-between mb-3">
      <PostUserHeader :post="post" />
      <div class="flex items-center gap-2">
        <div v-if="isPinned" class="flex items-center text-xs">
          <MapPinIcon class="h-3 w-3" aria-hidden="true" />
          pinned
        </div>
        <EditDeleteDropdown
          :user="post.user"
          :post="post"
          @edit="openEditModal"
          @delete="openDeletePostModal"
          @pin="pinUnpinPost"
        />
      </div>
    </div>
    <div class="mb-3">
      <ReadMoreReadLess :content="postBody" />
      <UrlPreview :preview="post.preview" :url="post.preview_url" />
    </div>
    <div
      class="grid gap-3 mb-3"
      :class="[post.attachments.length === 1 ? 'grid-cols-1' : 'grid-cols-2']"
    >
      <PostAttachments
        :attachments="post.attachments"
        @attachmentClick="openAttachment"
      />
    </div>
    <Disclosure v-slot="{ open }">
      <!-- Like & Comment buttons-->
      <div class="flex gap-2">
        <button
          @click="sendReaction"
          class="text-gray-800 dark:text-gray-100 flex gap-1 items-center justify-center rounded-lg py-2 px-4 flex-1"
          :class="[
            post.current_user_has_reaction
              ? 'bg-sky-100 dark:bg-sky-900 hover:bg-sky-200 dark:hover:bg-sky-950'
              : 'bg-gray-100 dark:bg-slate-800 dark:hover:bg-slate-800 ',
          ]"
        >
          <HandThumbUpIcon class="w-5 h-5" />
          <span class="mr-2">{{ post.num_of_reactions }}</span>
          {{ post.current_user_has_reaction ? "Unlike" : "Like" }}
        </button>
        <DisclosureButton
          class="text-gray-800 dark:text-gray-100 flex gap-1 items-center justify-center bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 rounded-lg hover:bg-gray-200 py-2 px-4 flex-1"
        >
          <ChatBubbleLeftRightIcon class="w-5 h-5" />
          <span class="mr-2">{{ post.num_of_comments }}</span>
          Comment
        </DisclosureButton>
      </div>

      <DisclosurePanel class="comment-list mt-3 max-h-[400px] overflow-auto">
        <CommentList :post="post" :data="{ comments: post.comments }" />
      </DisclosurePanel>
    </Disclosure>
  </div>
</template>

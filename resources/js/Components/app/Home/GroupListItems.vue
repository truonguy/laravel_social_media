<script setup>
import TextInput from "@/Components/TextInput.vue";
import GroupItem from "@/Components/app/Group/Groupitem.vue";
import GroupModal from "@/Components/app/Group/Modal/GroupModal.vue";
import { ref } from "vue";
const searchKeyword = ref('')
const showNewGroupModal = ref(false)

const props = defineProps({
    groups: Array
})
function onGroupCreate(group) {
    props.groups.unshift(group)
}
</script>
<template>
    <div class="flex gap-2  mt-4">
        <TextInput :model-value="searchKeyword" placeholder="Type to search" class="w-full" />
        <button @click="showNewGroupModal = true"
            class="text-sm bg-indigo-500 hover:bg-indigo-600 text-white rounded py-1 px-2 w-[120px]">
            new group
        </button>
    </div>
    <div class="mt-3 h-[200px] lg:flex-1 overflow-y-auto">
        <div v-if="false" class="text-gray-400 text-center p-3">
            You are not joined to any groups
        </div>
        <div v-else>
            <GroupItem v-for="group of groups" :group="group"/>
        </div>
    </div>
    <GroupModal v-model="showNewGroupModal" @create="onGroupCreate"/>
</template>
<style scoped></style>

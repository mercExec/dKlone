<template>
    <div class="flex flex-col w-60 flex-[0_0_auto] overflow-hidden bg-[#2b2d31] min-h-0">
        <div class="relative box-border min-h-0 flex-auto">
            <div class="flex min-w-0 flex-auto whitespace-nowrap text-ellipsis overflow-hidden items-center gap-2 cursor-pointer text-[#949ba4] fill-white max-w-[224px] mt-4 ml-2 hover:bg-[#35373c]" @click="router.push({name: 'dashboard'})"
                :class="{ 'bg-[#35373c] text-white': route.name == 'dashboard' }">
                <div class="flex-grow flex min-w-0 items-center rounded h-[42px] px-2">
                    <div class="flex items-center justify-center flex-[0_0_auto] w-8 h-8 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 640 512">
                            <path
                                d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex justify-start items-center">
                            <div class="text-base leading-5 font-medium flex-initial">
                                Friends
                            </div>
                        </div>
                    </div>
                    <div v-if="incomingRequests > 0"
                        class="bg-[#f23f42] ml-auto w-4 h-4 min-w-[16px] min-h-[16px] pr-[1px] flex items-center justify-center rounded-lg text-center flex-[0_0_auto] text-xs font-bold tracking-[0.02em] text-white">
                        {{ incomingRequests }}
                    </div>
                </div>
            </div>
            <div class="pl-4 text-[#717477] text-[12px] font-bold uppercase hover:text-gray-200 pt-6 font-sans">
                Direct Messages
            </div>
            <!-- Direct Message -->
            <div v-if="authStore.user">
                <div class="relative block justify-start box-border py-[1px] h-[44px] mt-4 ml-[8px] space-x-3 max-w-[224px] rounded text-white fill-white hover:bg-[#35373c] cursor-pointer group"
                    :class="conversationsStore.selectedConversation && conversationsStore.selectedConversation.id == conversation.id ? 'bg-[#3f4248] hover:bg-[#3f4248]' : ''"
                    v-for="(conversation, index) in conversationsStore.conversations" :key="index">
                    <div class="text-[#dbdee1] flex items-center box-border w-full cursor-pointer">
                        <router-link :to="{ name: 'conversation', params: { conversation: conversation.id } }"
                            class="flex min-w-0 flex-auto whitespace-nowrap text-ellipsis overflow-hidden items-center color-[inherit] gap-2 ">
                            <div class="min-w-0 flex items-center rounded h-[42px] px-2">
                                <div class="flex items-center justify-center flex-[0_0_auto] w-8 h-8 mr-3">
                                    <div
                                        class="relative flex h-8 w-8 shadow-lg bg-[#5865f2] rounded-3xl transition-all duration-150 ease-linear group">
                                        <img :src="$storage + 'icons/profiles/0.png'" class="cursor-pointer w-full h-full rounded-3xl  transition-all duration-150 ease-linear ">

                                    </div>
                                </div>
                                <div class="min-w-0 flex-auto whitespace-nowrap text-ellipsis overflow-hidden">
                                    <div class="flex justify-start items-center">
                                        <div
                                            class="text-base leading-5 font-medium whitespace-nowrap text-ellipsis overflow-hidden flex-initial">
                                            <div
                                                class="whitespace-nowrap text-ellipsis overflow-hidden relative text-[#949ba4] group-hover:text-[#dbdee1] pb-0.5" :class="conversationsStore.selectedConversation && conversationsStore.selectedConversation.id == conversation.id ? 'text-white' : ''">
                                                {{ conversation.user1.id ==
                                                    authStore.user.id ? conversation.user2.display_name :
                                                    conversation.user1.display_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </router-link>
                        <div class="pr-2">
                            <div @click.prevent="deleteConversation(conversation.id, index)"
                                class="hidden group-hover:block w-4 h-4 opacity-70 m-0.5 pr-2 text-[#949ba4] rounded-[inherit] ">
                                <svg aria-hidden="true" role="img" class="block w-4 h-4 text-[#949ba4] hover:text-[#dbdee1]"
                                    width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                    </path>
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- !Direct Message! -->
        </div>
        <UserDetails />
    </div>
</template>

<script setup>
import { onBeforeMount, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
import { useConversationsStore } from "../stores/conversations";
import { useFriendsStore } from "../stores/friends";
import UserDetails from "./UserDetails.vue";

const authStore = useAuthStore();
const conversationsStore = useConversationsStore();
const friendsStore = useFriendsStore();

const route = useRoute();
const router = useRouter();

const incomingRequests = ref(friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length);

const deleteConversation = (conversationId, index) => {
    conversationsStore.deleteConversation(conversationId, index);
    if (route.params.conversation == conversationId) {
        router.push({ name: 'dashboard' });
    }
}

watch(
    () => friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length,
    () => { incomingRequests.value = friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length },
);

onBeforeMount(async () => {
    await conversationsStore.getConversations();
})

</script>

<style></style>

<template>
    <div class="bg-[#1e1f22] flex-none w-[4.5rem] ">
        <!-- Current User -->
        <router-link :to="{ name: 'dashboard' }">
            <div class="stroke-0 relative flex items-center justify-center h-12 w-12 mt-3 mb-2 mx-auto shadow-lg text-white rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear hover:bg-[#5865f2] cursor-pointer group z-30"
                :class="route.name == 'dashboard' ? 'bg-[#5865f2] rounded-xl' : 'bg-[#313338]'">
                <img :src="$storage + 'icons/profiles/0.png'" class="cursor-pointer w-full h-full rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear ">
                    <div class="absolute bottom-0 right-0 z-[31]">
                        <div v-if="incomingRequests > 0"
                            class="bg-[#f23f42] w-4 h-4 min-w-[16px] min-h-[16px] pr-[1px] flex items-center justify-center rounded-lg box-border outline outline-4 outline-[#1e1f22] text-center text-white text-xs font-bold uppercase tracking-[0.02em]">
                            {{ incomingRequests }}
                        </div>
                    </div>
                <span
                    class="absolute w-auto p-2 m-2 min-w-max left-14 rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                    Direct Messages
                </span>
            </div>
        </router-link>
        <div v-for="(notification, index) in conversationsStore.notifications" :key="index">
            <router-link :to="{ name: 'conversation', params: { conversation: notification.conversation_id } }">
                <div
                    class="stroke-0 relative flex items-center justify-center h-12 w-12  mt-3 mb-2 mx-auto shadow-lg bg-[#313338] text-white rounded-3xl cursor-pointer group z-30">
                    <img :src="$storage + 'icons/profiles/0.png'" class="cursor-pointer w-full h-full rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear ">
                    <div class="absolute bottom-0 right-0 z-[31]">
                        <div
                            class="bg-[#f23f42] w-4 h-4 min-w-[16px] min-h-[16px] pr-[1px] flex items-center justify-center rounded-lg box-border outline outline-4 outline-[#1e1f22] text-center text-white text-xs font-bold uppercase tracking-[0.02em]">
                            {{ notification.counter }}
                        </div>
                    </div>
                    <span
                        class="absolute w-auto p-2 m-2 min-w-max left-14 rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                        {{ notification.sender.display_name }}
                    </span>
                </div>
            </router-link>
        </div>
        <div class="px-5">
            <div class="border-b-2 border-[#4e50587a]"></div>
        </div>
        <!-- !Current User! -->

        <!-- Servers -->

        <ServerIcon v-for="(server, index) in serversStore.servers" :key="index" :server="server" />
        <AddServerButton />
        <!-- !Servers! -->

        <!-- Add Server -->
        <!-- !Add Server! -->

        <!-- Explore Servers -->
        <router-link :to="{ name: 'explore' }">
            <div
                class="stroke-0 flex items-center justify-center h-12 w-12 p-2 mt-3 mb-2 mx-auto shadow-lg bg-[#313338] fill-[#23a559] hover:fill-white hover:bg-green-600 rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear cursor-pointer group">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px"
                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm50.7-186.9L162.4 380.6c-19.4 7.5-38.5-11.6-31-31l55.5-144.3c3.3-8.5 9.9-15.1 18.4-18.4l144.3-55.5c19.4-7.5 38.5 11.6 31 31L325.1 306.7c-3.2 8.5-9.9 15.1-18.4 18.4zM288 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                </svg>
                <span
                    class="absolute w-auto z-10 p-2 m-2 min-w-max left-14 rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                    Explore Discoverable Servers
                </span>
            </div>
        </router-link>
        <!-- !Explore Servers! -->

    </div>
</template>

<script setup>
import { onBeforeMount, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useAuthStore } from '../stores/auth';
import { useConversationsStore } from '../stores/conversations';
import { useFriendsStore } from '../stores/friends';
import { useServersStore } from "../stores/servers";
import AddServerButton from './AddServerButton.vue';
import ServerIcon from './ServerIcon.vue';

const authStore = useAuthStore();
const friendsStore = useFriendsStore();
const conversationsStore = useConversationsStore();
const serversStore = useServersStore();

const route = useRoute();

const incomingRequests = ref(friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length);

watch(
    () => friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length,
    () => { incomingRequests.value = friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length },
);

onBeforeMount(() => {
    serversStore.getServers();
})

</script>

<style></style>

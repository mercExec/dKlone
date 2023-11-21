<template>
    <!-- Channels -->
    <div class="flex flex-col w-60 flex-[0_0_auto] overflow-hidden bg-[#2b2d31] min-h-0">
        <div class="relative box-border min-h-0 flex-auto">
            <div v-if="serverStore.server">
                <section class="h-12 w-full p-2 shadow-md ">
                    <div class="pt-[3px] text-white fill-[#80848e] flex pr-5 pl-2">
                        <span class="font-semibold">{{ serverStore.server.name }}</span>
                        <!-- Add dropdown for server settings -->
                    </div>
                </section>
                <div class="text-[#949ba4] text-[11px] font-bold pt-5 font-sans">
                    <div class="flex pl-1 w-ful  pr-2">
                        <div class="cursor-pointer flex" @click="isCategoryExpanded = !isCategoryExpanded">
                            <div class="pt-1 pr-1">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" clas
                                    class=" h-[9px] w-[9px] transform transition-transform duration-200 ease-in-out"
                                    :class="isCategoryExpanded ? '' : 'rotate-[-90deg]'">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <span class="hover:text-gray-200">TEXT CHANNEL</span>
                        </div>

                        <div class="flex items-center justify-center flex-[0_0_auto] w-[18px] h-[18px] ml-auto"
                            @click="isModalOpen = true">
                            <button class="block relative h-full w-full text-sm leading-4 font-medium hover:text-gray-200">
                                <svg aria-hidden="true" role="img" width="18" height="18" viewBox="0 0 18 18">
                                    <polygon fill-rule="nonzero" fill="currentColor"
                                        points="15 10 10 10 10 15 8 15 8 10 3 10 3 8 8 8 8 3 10 3 10 8 15 8"></polygon>
                                </svg>
                            </button>
                        </div>
                        <AddChannelModal :state="isModalOpen" @close-add-channel-modal="isModalOpen = !isModalOpen" />
                    </div>
                    <div>
                        <ul v-show="isCategoryExpanded" class="pt-2" v-if="serverStore.server && serverStore.channel">
                            <li v-for="(channel, index) in serverStore.server.channels" :key="index"
                                class="h-[34px] py-1 mx-2 hover:bg-[#36373d] cursor-pointer rounded px-2"
                                :class="{ 'bg-[#3f4248] hover:bg-[#3f4248]': serverStore.channel.id == channel.id }">
                                <router-link :to="{ name: 'channel', params: { channel: channel.id } }"
                                    @click="selectChannel(channel)">
                                    <div class="flex">
                                        <div class="pr-[6px] pt-[2px]">
                                            <svg width="20" height="20" viewBox="0 0 24 24" class="icon-2W8DHg"
                                                aria-hidden="true" role="img">
                                                <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M5.88657 21C5.57547 21 5.3399 20.7189 5.39427 20.4126L6.00001 17H2.59511C2.28449 17 2.04905 16.7198 2.10259 16.4138L2.27759 15.4138C2.31946 15.1746 2.52722 15 2.77011 15H6.35001L7.41001 9H4.00511C3.69449 9 3.45905 8.71977 3.51259 8.41381L3.68759 7.41381C3.72946 7.17456 3.93722 7 4.18011 7H7.76001L8.39677 3.41262C8.43914 3.17391 8.64664 3 8.88907 3H9.87344C10.1845 3 10.4201 3.28107 10.3657 3.58738L9.76001 7H15.76L16.3968 3.41262C16.4391 3.17391 16.6466 3 16.8891 3H17.8734C18.1845 3 18.4201 3.28107 18.3657 3.58738L17.76 7H21.1649C21.4755 7 21.711 7.28023 21.6574 7.58619L21.4824 8.58619C21.4406 8.82544 21.2328 9 20.9899 9H17.41L16.35 15H19.7549C20.0655 15 20.301 15.2802 20.2474 15.5862L20.0724 16.5862C20.0306 16.8254 19.8228 17 19.5799 17H16L15.3632 20.5874C15.3209 20.8261 15.1134 21 14.8709 21H13.8866C13.5755 21 13.3399 20.7189 13.3943 20.4126L14 17H8.00001L7.36325 20.5874C7.32088 20.8261 7.11337 21 6.87094 21H5.88657ZM9.41045 9L8.35045 15H14.3504L15.4104 9H9.41045Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="text-[16px] font-medium hover:text-[#dbdee1]"
                                            :class="serverStore.channel.name == channel.name ? 'text-white hover:text-white' : ''">
                                            {{ channel.name }}
                                        </span>
                                    </div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <UserDetails />
    </div>
    <!-- !Channels! -->
    <!-- Selected Channel -->
    <router-view></router-view>
    <!-- !Selected Channel! -->
</template>

<script setup>
import { onBeforeMount, onUnmounted, ref } from "vue"
import { onBeforeRouteUpdate, useRoute, useRouter } from "vue-router";
import { useServersStore } from "../stores/servers";
import AddChannelModal from '../components/AddChannelModal.vue';
import UserDetails from "../components/UserDetails.vue";

const router = useRouter();
const route = useRoute();
const serverId = route.params.server;

const serverStore = useServersStore();

const isCategoryExpanded = ref(true);
const isModalOpen = ref(false);

const selectChannel = (channel) => {
    serverStore.selectedChannel = channel;
}

onBeforeMount(async () => {
    if (!route.params.channel) {
        router.push({ name: 'channel', params: { server: serverId, channel: serverStore.server.channels[0].id } })
    }
})

onBeforeRouteUpdate(async (to, from, next) => {
    const newServerId = to.params.server;
    const oldServerId = from.params.server;
    if (newServerId !== oldServerId) {
        if (!route.params.channel) {
            router.push({ name: 'channel', params: { server: serverId, channel: serverStore.server.channels[0].id } })
        }
    }
    next();
});

onUnmounted(() => {
    serverStore.selectedServer = '';
    serverStore.selectedChannel = '';
})
</script>

<style></style>

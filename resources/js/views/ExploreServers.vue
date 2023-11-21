<template>
    <div class="flex items-stretch justify-start min-w-0 min-h-0 flex-auto">
        <div class="flex flex-col w-60 flex-[0_0_auto] overflow-hidden bg-[#2b2d31] min-h-0 ">
            <div class="relative box-border min-h-0 flex-auto">
                <h2 class="m-4 mr-0 font-bold text-[#f2f3f5] text-2xl leading-[30px]">
                    Discover
                </h2>
                <div class="text-white mx-2 box-border block py-[1px] rounded transition-none">
                    <div class="h-auto py-[5px] px-2 flex items-center rounded bg-[#5865f2]">
                        <div class="flex items-center justify-center flex-[0_0_auto] w-8 h-8 mr-3">
                            <svg aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 10.9C11.39 10.9 10.9 11.39 10.9 12C10.9 12.61 11.39 13.1 12 13.1C12.61 13.1 13.1 12.61 13.1 12C13.1 11.39 12.61 10.9 12 10.9ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM14.19 14.19L6 18L9.81 9.81L18 6L14.19 14.19Z">
                                </path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-auto whitespace-nowrap overflow-ellipsis overflow-hidden cursor-pointer">
                            <div class="flex">
                                <div
                                    class="whitespace-normal text-base leading-5 font-medium overflow-ellipsis overflow-hidden flex-initial">
                                    Home
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <UserDetails />
        </div>
        <div class="bg-[#313338] text-white w-full relative">
            <div class="overflow-x-hidden overflow-y-scroll p-[32px] pr-[15px] h-full relative box-border min-h-0">
                <div class="w-full h-full max-w-screen-2xl mx-auto text-white">
                    <div>
                        <section class="w-full mb-[32px] min-w-[580px]">
                            <h2 class="text-[#f2f3f5] text-xl leading-6 font-semibold">
                                Public Servers
                            </h2>
                            <div class="mt-4 grid grid-cols-4 gap-4" v-if="publicServers">
                                <!-- Server Card -->
                                <div class="relative cursor-pointer bg-[#232428] h-[320px] overflow-hidden rounded-lg" v-for="(server, index) in publicServers" :key="index" @click.prevent="joinServer(server.id)">
                                    <!-- Header -->
                                    <div class="h-[143px] relative block overflow-visible mb-[32px]" @click.prevent="joinServer(server.id)">
                                        <div class="opacity-100 block absolute top-0 left-0 w-full h-full">
                                            <div class="bg-[#5865f2] w-full h-full">
                                            </div>
                                        </div>
                                        <div class="absolute -bottom-[21px] left-3">
                                            <svg width="48" height="48" viewBox="0 0 48 48">
                                                <foreignObject x="0" y="0" width="48" height="48" overflow="visible">
                                                    <div class="bg-[#232428] p-1 rounded-lg">
                                                        <svg width="40" height="40" viewBox="0 0 40 40" class="rounded-lg">
                                                            <foreignObject x="0" y="0" width="40" height="40"
                                                                overflow="visible">
                                                                <img class="w-full h-full" :src="$storage + (server.image ? server.image : ('icons/profiles/' + Math.floor(Math.random() * 6) + '.png')) ">
                                                            </foreignObject>
                                                        </svg>
                                                    </div>
                                                </foreignObject>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Info -->
                                    <div class="flex-auto relative flex flex-col content-stretch p-4 pt-0 overflow-hidden ">
                                        <!-- Name -->
                                        <div class="flex items-center w-full font-semibold">
                                            <h3 class="overflow-hidden whitespace-nowrap text-ellipsis text-[#f2f3f5] text-base leading-5 font-semibold">
                                                {{ server.name }}
                                            </h3>
                                        </div>
                                        <!-- Description -->
                                        <div class="text-[#b5bac1] flex-auto overflow-hidden mt-1 mb-4 block text-sm leading-[18px] font-normal h-[64px] max-h-[64px]">
                                            {{ lorem.generateWords(15) }}
                                        </div>
                                        <!-- Members count -->
                                        <div class="flex-[0_0_auto] flex items-center ">
                                            <!-- Online -->
                                            <div class=" text-xs flex items-center mr-4">
                                                <div class="bg-[#23a559] rounded-[50%] w-2 h-2 mr-1 flex-shrink-0">
                                                </div>
                                                <div class="text-[#b5bac1] text-xs font-normal">
                                                    {{ Math.round(server.users_count / 2) }} Online
                                                </div>
                                            </div>
                                            <!-- Members -->
                                            <div class="mr-0 text-xs flex items-center">
                                                <div class="bg-[#c4c9ce] w-2 h-2 mr-1 flex-shrink-0 rounded-[50%]">
                                                </div>
                                                <div class="text-[#b5bac1] text-xs font-normal">
                                                    {{ server.users_count }} Members
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onBeforeMount, ref } from "vue";
import UserDetails from "../components/UserDetails.vue";
import { LoremIpsum } from "lorem-ipsum";
import { useRouter } from "vue-router";
import { useServersStore } from "../stores/servers";

const serversStore = useServersStore();

const publicServers = ref();

const router = useRouter();

const getPublicServers = async () => {
    await axios.get('/api/getPublicServers')
        .then(res => {
            console.log(res.data.data);
            publicServers.value = res.data.data;
        });
}

const joinServer = async (serverId) => {
    let res = await serversStore.joinServer(serverId);

    router.push({ name: 'channel', params: { server: res.server.id, channel: res.server.first_channel.id } });

}

const lorem = new LoremIpsum({
  sentencesPerParagraph: {
    max: 8,
    min: 4
  },
  wordsPerSentence: {
    max: 16,
    min: 4
  }
});

onBeforeMount(async () => {
    await getPublicServers();
})
</script>

<style></style>
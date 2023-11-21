<template>
    <div v-if="props.state">
        <div class="absolute w-screen h-screen bg-black opacity-70 inset-0 z-30" @click.prevent="clearAddChannel"></div>

        <div class="absolute top-0 right-0 left-0 bottom-0 items-center flex justify-center flex-col min-h-0 py-10 ">
            <div class="flex flex-col max-w-full mx-auto z-40">
                <div
                    class="opacity-100 w-[460px] rounded-[12px] bg-[#313338] overflow-x-hidden overflow-y-scroll flex flex-col mx-auto relative max-h-full">
                    <form>
                        <div>
                            <div class="relative w-full h-[482px] overflow-hidden">
                                <!-- Container of inner elements -->
                                <div class="absolute w-full opacity-100">
                                    <div
                                        class="rounded-[4px_4px_0px_0px] relative p-4 z-[1] overflow-x-hidden flex-nowrap justify-start items-center flex-row flex">
                                        <div class="my-1">
                                            <h1 class="font-medium text-xl leading-6 text-[#f2f3f5]">Create Channel</h1>
                                            <div class="text-[#b5bac1] text-xs font-normal flex items-center">
                                                In Text Channel.
                                            </div>
                                        </div>
                                        <button
                                            class="absolute top-4 right-2 p-1 h-[26px] w-auto opacity-50 cursor-pointer box-content flex justify-center items-center text-sm leading-4 font-medium text-[#b5bac1] hover:text-[#dbdee1] hover:opacity-100"
                                            @click="clearAddChannel">
                                            <div class="">
                                                <svg aria-hidden="true" role="img" class="" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                    </path>
                                                </svg>

                                            </div>
                                        </button>
                                    </div>
                                    <div
                                        class="overflow-hidden pl-4 box-border min-h-0 max-h-[680px] relative z-0 rounded-l-[5px] rounded-r-[5px]">
                                        <div class="relative">
                                            <!-- Channel Type -->
                                            <div class="mb-5">
                                                <h2
                                                    class="mb-2 text-xs font-bold uppercase spacing tracking-[0.02em] text-[#b5bac1]">
                                                    Channel Type
                                                </h2>
                                                <div role="radiogroup" aria-disabled="false" aria-orientation="vertical">
                                                    <!-- Channel Type Radio -->
                                                    <div class="mb-2 cursor-pointer rounded-[3px] block bg-[#4e505899]">
                                                        <div class="flex py-[10px] px-3 rounded items-center">
                                                            <div class="order-2 text-white">
                                                                <svg aria-hidden="true" role="img" width="24" height="24"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                                        fill="currentColor"></path>
                                                                    <circle cx="12" cy="12" r="5" fill="currentColor">
                                                                    </circle>
                                                                </svg>
                                                            </div>
                                                            <div class="order-1 mr-2 w-full grid gap-1 items-center">
                                                                <div class="text-base leading-5 font-medium">
                                                                    <div class="flex items-center leading-5">
                                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                                            class="mr-3 opacity-60 fill-[#c4c9ce] leading-5 text-white"
                                                                            background="background__4e49e"
                                                                            aria-hidden="true" role="img">
                                                                            <path class="foreground__7568c"
                                                                                fill="currentColor" fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M5.88657 21C5.57547 21 5.3399 20.7189 5.39427 20.4126L6.00001 17H2.59511C2.28449 17 2.04905 16.7198 2.10259 16.4138L2.27759 15.4138C2.31946 15.1746 2.52722 15 2.77011 15H6.35001L7.41001 9H4.00511C3.69449 9 3.45905 8.71977 3.51259 8.41381L3.68759 7.41381C3.72946 7.17456 3.93722 7 4.18011 7H7.76001L8.39677 3.41262C8.43914 3.17391 8.64664 3 8.88907 3H9.87344C10.1845 3 10.4201 3.28107 10.3657 3.58738L9.76001 7H15.76L16.3968 3.41262C16.4391 3.17391 16.6466 3 16.8891 3H17.8734C18.1845 3 18.4201 3.28107 18.3657 3.58738L17.76 7H21.1649C21.4755 7 21.711 7.28023 21.6574 7.58619L21.4824 8.58619C21.4406 8.82544 21.2328 9 20.9899 9H17.41L16.35 15H19.7549C20.0655 15 20.301 15.2802 20.2474 15.5862L20.0724 16.5862C20.0306 16.8254 19.8228 17 19.5799 17H16L15.3632 20.5874C15.3209 20.8261 15.1134 21 14.8709 21H13.8866C13.5755 21 13.3399 20.7189 13.3943 20.4126L14 17H8.00001L7.36325 20.5874C7.32088 20.8261 7.11337 21 6.87094 21H5.88657ZM9.41045 9L8.35045 15H14.3504L15.4104 9H9.41045Z">
                                                                            </path>
                                                                        </svg>

                                                                        <div>
                                                                            <div
                                                                                class="flex items-center text-base leading-5 font-medium text-[#dbdee1]">
                                                                                Text
                                                                            </div>
                                                                            <div
                                                                                class="text-[#b5bac1] mt-1 whitespace-pre-wrap text-sm leading-[18px]">
                                                                                Send messages, emoji, opinions, and puns
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- !Channel Type Radio -->
                                                    <!-- Channel Type Radio -->
                                                    <div class="mb-2 cursor-not-allowed rounded-[3px] block bg-[#2b2d31] ">
                                                        <div class="flex py-[10px] px-3 rounded items-center">
                                                            <div class="order-2 text-white">
                                                                <svg aria-hidden="true" role="img" width="24" height="24"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill-rule="evenodd"
                                                                        class="mr-3 opacity-60 leading-5"
                                                                        clip-rule="evenodd"
                                                                        d="M12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="order-1 mr-2 w-full grid gap-1 items-center">
                                                                <div class="text-base leading-5 font-medium">
                                                                    <div class="flex items-center leading-5">
                                                                        <svg class="mr-3 opacity-60 fill-[#c4c9ce] leading-5 text-white"
                                                                            aria-hidden="true" role="img" width="24"
                                                                            height="24" viewBox="0 0 24 24">
                                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M11.383 3.07904C11.009 2.92504 10.579 3.01004 10.293 3.29604L6 8.00204H3C2.45 8.00204 2 8.45304 2 9.00204V15.002C2 15.552 2.45 16.002 3 16.002H6L10.293 20.71C10.579 20.996 11.009 21.082 11.383 20.927C11.757 20.772 12 20.407 12 20.002V4.00204C12 3.59904 11.757 3.23204 11.383 3.07904ZM14 5.00195V7.00195C16.757 7.00195 19 9.24595 19 12.002C19 14.759 16.757 17.002 14 17.002V19.002C17.86 19.002 21 15.863 21 12.002C21 8.14295 17.86 5.00195 14 5.00195ZM14 9.00195C15.654 9.00195 17 10.349 17 12.002C17 13.657 15.654 15.002 14 15.002V13.002C14.551 13.002 15 12.553 15 12.002C15 11.451 14.551 11.002 14 11.002V9.00195Z"
                                                                                aria-hidden="true">
                                                                            </path>
                                                                        </svg>
                                                                        <div>
                                                                            <div
                                                                                class="flex items-center text-base leading-5 font-medium text-[#dbdee1]">
                                                                                Voice (Coming Soon)
                                                                            </div>
                                                                            <div
                                                                                class="text-[#b5bac1] mt-1 whitespace-pre-wrap text-sm leading-[18px]">
                                                                                Hang out together with voice, video, and
                                                                                screen share
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- !Channel Type Radio -->
                                                </div>
                                            </div>
                                            <!-- !Channel Type -->
                                            <!-- Cannel Name -->
                                            <div class="mb-5">
                                                <label
                                                    class="mb-2 block text-xs font-bold uppercase tracking-[0.02em] text-[#dbdee1]">
                                                    Channel Name
                                                </label>
                                                <div class="relative flex flex-col text-[#dbdee1]">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        class="absolute top-3 left-2 " aria-hidden="true" role="img">
                                                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M5.88657 21C5.57547 21 5.3399 20.7189 5.39427 20.4126L6.00001 17H2.59511C2.28449 17 2.04905 16.7198 2.10259 16.4138L2.27759 15.4138C2.31946 15.1746 2.52722 15 2.77011 15H6.35001L7.41001 9H4.00511C3.69449 9 3.45905 8.71977 3.51259 8.41381L3.68759 7.41381C3.72946 7.17456 3.93722 7 4.18011 7H7.76001L8.39677 3.41262C8.43914 3.17391 8.64664 3 8.88907 3H9.87344C10.1845 3 10.4201 3.28107 10.3657 3.58738L9.76001 7H15.76L16.3968 3.41262C16.4391 3.17391 16.6466 3 16.8891 3H17.8734C18.1845 3 18.4201 3.28107 18.3657 3.58738L17.76 7H21.1649C21.4755 7 21.711 7.28023 21.6574 7.58619L21.4824 8.58619C21.4406 8.82544 21.2328 9 20.9899 9H17.41L16.35 15H19.7549C20.0655 15 20.301 15.2802 20.2474 15.5862L20.0724 16.5862C20.0306 16.8254 19.8228 17 19.5799 17H16L15.3632 20.5874C15.3209 20.8261 15.1134 21 14.8709 21H13.8866C13.5755 21 13.3399 20.7189 13.3943 20.4126L14 17H8.00001L7.36325 20.5874C7.32088 20.8261 7.11337 21 6.87094 21H5.88657ZM9.41045 9L8.35045 15H14.3504L15.4104 9H9.41045Z">
                                                        </path>
                                                    </svg>
                                                    <input type="text" v-model="newChannelName"
                                                        class="p-[10px] pl-7 h-10 text-base leading-none bg-[#1e1f22] box-border w-full rounded-[3px] border-none focus:ring-0 font-normal"
                                                        placeholder="new-channel">
                                                </div>
                                            </div>
                                            <!-- !Cannel Name -->
                                            <!-- Private channel -->
                                            <div class="cursor-not-allowed">
                                                <div class="flex flex-col mb-5">
                                                    <div class="flex flex-row w-full items-center">
                                                        <!-- Label -->
                                                        <label
                                                            class="flex-1 block overflow-hidden text-base font-semibold text-[#f2f3f5] cursor-not-allowed">
                                                            <svg width="24" height="24"
                                                                class="relative w-4 h-4 inline-block opacity-60 mb-1"
                                                                viewBox="0 0 24 24" aria-hidden="true" role="img">
                                                                <path fill="currentColor"
                                                                    d="M17 11V7C17 4.243 14.756 2 12 2C9.242 2 7 4.243 7 7V11C5.897 11 5 11.896 5 13V20C5 21.103 5.897 22 7 22H17C18.103 22 19 21.103 19 20V13C19 11.896 18.103 11 17 11ZM12 18C11.172 18 10.5 17.328 10.5 16.5C10.5 15.672 11.172 15 12 15C12.828 15 13.5 15.672 13.5 16.5C13.5 17.328 12.828 18 12 18ZM15 11H9V7C9 5.346 10.346 4 12 4C13.654 4 15 5.346 15 7V11Z"
                                                                    aria-hidden="true"></path>
                                                            </svg>
                                                            Private Channel (Coming Soon)
                                                        </label>
                                                        <!-- Control -->
                                                        <div
                                                            class="bg-[#80848e] relative rounded-[14px] w-10 h-6">
                                                            <svg class="block absolute w-7 h-[18px] m-[3px]"
                                                                viewBox="0 0 28 20" preserveAspectRatio="xMinYMid meet"
                                                                style="left: -3px;" aria-hidden="true">
                                                                <rect fill="white" x="4" y="0" height="20" width="20"
                                                                    rx="10">
                                                                </rect><svg viewBox="0 0 20 20" fill="none">
                                                                    <path fill="rgba(128, 132, 142, 1)"
                                                                        d="M5.13231 6.72963L6.7233 5.13864L14.855 13.2704L13.264 14.8614L5.13231 6.72963Z">
                                                                    </path>
                                                                    <path fill="rgba(128, 132, 142, 1)"
                                                                        d="M13.2704 5.13864L14.8614 6.72963L6.72963 14.8614L5.13864 13.2704L13.2704 5.13864Z">
                                                                    </path>
                                                                </svg>
                                                            </svg>
                                                            <input type="checkbox" name="private_channel"
                                                                class="hidden absolute w-full h-full rounded-[14px] top-0 left-0 m-0">
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <div class="cursor-default text-sm font-normal text-[#b5bac1]">
                                                            Only selected members and roles will be able to view this channel.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- !Private channel -->
                                        </div>
                                    </div>
                                    <div class=" shadow-[inset_0_1px_0_rgba(43,45,49,0.6)] rounded-[0_0_12px_12px] bg-[#2b2d31] relative p-4 pr-0 z-10 overflow-hidden flex-nowrap justify-start items-stretch flex-row-reverse flex ">
                                        <button class=" text-white bg-[#5865f2]  w-[125.133px] h-[38px] min-h-[38px] min-w-[96px] leading-4 relative flex justify-center items-center box-border border-none rounded-[3px] text-sm font-semibold" :class="{'cursor-pointer hover:bg-[#4752c4]': newChannelName, 'cursor-not-allowed opacity-50':  !newChannelName}" @click.prevent="createChannel">
                                            <div class="mx-auto whitespace-nowrap text-ellipsis overflow-hidden">
                                                Create Channel
                                            </div>
                                        </button>
                                        <button class="text-white w-auto h-[38px] min-h-[38px] min-w-[96px] leading-4 relative flex justify-center items-center box-border border-none rounded-[3px] text-sm font-semibold py-0.5" @click.prevent="clearAddChannel">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useServersStore } from "../stores/servers";

const props = defineProps({
    state: Boolean
});

const emit = defineEmits(['closeAddChannelModal']);

const router = useRouter();


const serversStore = useServersStore();

const newChannelName = ref('');

const inputErrors = ref([]);

const clearAddChannel = () => {
    emit('closeAddChannelModal');
    newChannelName.value = '';
}

const createChannel = async () => {
    let form = new FormData();
    form.append('channelName', newChannelName.value);

    await axios.post('/api/createChannel/' + serversStore.selectedServer.id, form)
        .then(res => {
            serversStore.addChannel(res.data);
            clearAddChannel();
            console.log(res.data);
            router.push({ name: 'channel', params: { server: serversStore.selectedServer.id, channel: res.data.id } });
        });
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
    position: absolute;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}</style>

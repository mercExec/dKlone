<template>
    <div v-if="props.state">
        <div class="absolute w-screen h-screen bg-black opacity-70 inset-0 z-30" @click.prevent="clearAddServer"></div>

        <div class="p-3 absolute top-0 left-0 w-screen h-screen flex flex-col items-center justify-center  shadow-lg ">
            <!-- Page 1 -->
            <Transition name="fade">
                <div class="w-[27.5rem] z-30 bg-white shadow rounded " v-if="openPage == 1">
                    <div>
                        <div class="px-4 pt-6">
                            <div
                                class="relative text-[#4e5058] hover:text-black opacity-50 hover:opacity-100 cursor-pointer transition-all duration-200">
                                <div class="absolute -top-2 -right-0" @click="clearAddServer">
                                    <svg aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="font-bold text-2xl text-center leading-[30px]">Create a server</h1>
                            <div class="text-[#4e5058] text-base leading-5 text-center mt-2">
                                Your server is where you and your friends hang out. Make yours and start talking.
                            </div>
                        </div>
                        <div class="h-[330px] px-4 mt-6 overflow-y-scroll">
                            <AddServerContainer :bg-color="'bg-[#718ef7]'" :text="'Create My Own'"
                                @click="togglePage(2, 1)" />
                            <div class="mt-4 mb-2 uppercase font-bold text-xs text-[#4e5058]">
                                Start from a template
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#c482ff]'" :text="'Gaming'" @click="togglePage(2, 2)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#ff78b9]'" :text="'School Club'"
                                    @click="togglePage(2, 3)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#ebebed]'" :text="'Study Group'"
                                    @click="togglePage(2, 4)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#60cfac]'" :text="'Friends'"
                                    @click="togglePage(2, 5)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#f7d036]'" :text="'Artists & Creators'"
                                    @click="togglePage(2, 6)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#ebf0f7]'" :text="'Local Community'"
                                    @click="togglePage(2, 7)" />
                            </div>
                        </div>
                        <div class="w-full bg-[#f2f3f5] p-4 rounded">
                            <h2 class="text-center text-xl leading-6 font-semibold mb-2">
                                Have an invite already?
                            </h2>
                            <button
                                class="w-full text-sm font-semibold leading-4 h-[38px] px-4 py-[2px] rounded bg-[#6d6f78] text-white">
                                Join a Server
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
            <!-- Page 2 -->
            <Transition name="fade">
                <div class="w-[27.5rem] z-30 bg-white shadow rounded " v-if="openPage == 2">
                    <div>
                        <div class="px-4 pt-6">
                            <div
                                class="relative text-[#4e5058] hover:text-black opacity-50 hover:opacity-100 cursor-pointer transition-all duration-200">
                                <div class="absolute -top-2 -right-0" @click="$emit('closeAddServerModal')">
                                    <svg aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="font-bold text-2xl text-center leading-[30px]">Tell us more about your server</h1>
                            <div class="text-[#4e5058] text-base leading-5 text-center mt-2">
                                In order to help you with your setup, is your new server for just a few friends or a larger
                                community?
                            </div>
                        </div>
                        <div class="pl-4 pr-2 pb-2 mt-6">
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#ebf0f7]'" :text="'For a club or community'"
                                    @click="togglePage(3)" />
                            </div>
                            <div class="mb-2">
                                <AddServerContainer :bg-color="'bg-[#f7d036]'" :text="'For me and my friends'"
                                    @click="togglePage(3)" />
                            </div>
                            <div class="text-[#4e5058] font-normal text-sm leading-[18px] text-center mt-[18px] mb-4">
                                Not sure? You can <a class="text-[#006ce7] hover:underline"
                                    @click.prevent="togglePage(3)">skip this question</a> for now
                            </div>
                        </div>
                        <div class="w-full bg-[#f2f3f5] p-4 rounded">
                            <button class="h-[38px] mr-auto w-auto px-1 py-0.5 text-sm leading-4 font-semibold"
                                @click="togglePage(1)">
                                Back
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
            <!-- Page 3 -->
            <Transition name="fade">
                <div class="w-[27.5rem] z-30 bg-white shadow rounded " v-if="openPage == 3">
                    <div>
                        <div class="px-4 pt-6">
                            <div
                                class="relative text-[#4e5058] hover:text-black opacity-50 hover:opacity-100 cursor-pointer transition-all duration-200">
                                <div class="absolute -top-2 -right-0" @click="$emit('closeAddServerModal')">
                                    <svg aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="font-bold text-2xl text-center leading-[30px]">Customize your server</h1>
                            <div class="text-[#4e5058] text-base leading-5 text-center mt-2">
                                Give your new server a personality with a name and an icon. You can always change it later.
                            </div>
                        </div>
                        <div class="my-4 pl-4 pr-4">
                            <form enctype="multipart/form-data">
                                <!-- Server icon -->
                                <div class="pt-1 w-full flex justify-center items-center">
                                    <label for="image" class="cursor-pointer">
                                        <div class="w-20 h-20">
                                            <svg width="80" height="80" viewBox="0 0 80 80" class="text-[#4e5058]"
                                                v-if="!newServer.image">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M54.8694 2.85498C53.8065 2.4291 52.721 2.04752 51.6153 1.71253L51.3254 2.66957L51.0354 3.62661C51.9783 3.91227 52.9057 4.23362 53.8161 4.58911C54.1311 3.98753 54.4832 3.40847 54.8694 2.85498ZM75.4109 26.1839C76.0125 25.8689 76.5915 25.5168 77.145 25.1306C77.5709 26.1935 77.9525 27.279 78.2875 28.3847L77.3304 28.6746L76.3734 28.9646C76.0877 28.0217 75.7664 27.0943 75.4109 26.1839ZM78.8148 43.8253L79.8102 43.9222C79.9357 42.6318 80 41.3234 80 40C80 38.6766 79.9357 37.3682 79.8102 36.0778L78.8148 36.1747L77.8195 36.2715C77.9389 37.4977 78 38.7414 78 40C78 41.2586 77.9389 42.5023 77.8195 43.7285L78.8148 43.8253ZM43.8253 1.18515L43.9222 0.189853C42.6318 0.0642679 41.3234 0 40 0C38.6766 0 37.3682 0.064268 36.0778 0.189853L36.1747 1.18515L36.2715 2.18045C37.4977 2.06112 38.7414 2 40 2C41.2586 2 42.5023 2.06112 43.7285 2.18045L43.8253 1.18515ZM28.6746 2.66957L28.3847 1.71253C25.8549 2.47897 23.4312 3.48925 21.1408 4.71604L21.6129 5.59756L22.0851 6.47907C24.2606 5.3138 26.5624 4.35439 28.9646 3.62661L28.6746 2.66957ZM15.2587 9.85105L14.6239 9.0784C12.5996 10.7416 10.7416 12.5996 9.0784 14.6239L9.85105 15.2587L10.6237 15.8935C12.2042 13.9699 13.9699 12.2042 15.8935 10.6237L15.2587 9.85105ZM5.59756 21.6129L4.71604 21.1408C3.48925 23.4312 2.47897 25.8549 1.71253 28.3847L2.66957 28.6746L3.62661 28.9646C4.35439 26.5624 5.3138 24.2607 6.47907 22.0851L5.59756 21.6129ZM0 40C0 38.6766 0.0642679 37.3682 0.189853 36.0778L1.18515 36.1747L2.18045 36.2715C2.06112 37.4977 2 38.7414 2 40C2 41.2586 2.06112 42.5023 2.18045 43.7285L1.18515 43.8253L0.189853 43.9222C0.064268 42.6318 0 41.3234 0 40ZM2.66957 51.3254L1.71253 51.6153C2.47897 54.1451 3.48926 56.5688 4.71604 58.8592L5.59756 58.3871L6.47907 57.9149C5.3138 55.7394 4.35439 53.4376 3.62661 51.0354L2.66957 51.3254ZM9.85105 64.7413L9.0784 65.3761C10.7416 67.4004 12.5996 69.2584 14.6239 70.9216L15.2587 70.1489L15.8935 69.3763C13.9699 67.7958 12.2042 66.0301 10.6237 64.1065L9.85105 64.7413ZM21.6129 74.4024L21.1408 75.284C23.4312 76.5107 25.8549 77.521 28.3847 78.2875L28.6746 77.3304L28.9646 76.3734C26.5624 75.6456 24.2607 74.6862 22.0851 73.5209L21.6129 74.4024ZM36.1747 78.8148L36.0778 79.8102C37.3682 79.9357 38.6766 80 40 80C41.3234 80 42.6318 79.9357 43.9222 79.8102L43.8253 78.8148L43.7285 77.8195C42.5023 77.9389 41.2586 78 40 78C38.7414 78 37.4977 77.9389 36.2715 77.8195L36.1747 78.8148ZM51.3254 77.3304L51.6153 78.2875C54.1451 77.521 56.5688 76.5107 58.8592 75.284L58.3871 74.4024L57.9149 73.5209C55.7394 74.6862 53.4376 75.6456 51.0354 76.3734L51.3254 77.3304ZM64.7413 70.1489L65.3761 70.9216C67.4004 69.2584 69.2584 67.4004 70.9216 65.3761L70.1489 64.7413L69.3763 64.1065C67.7958 66.0301 66.0301 67.7958 64.1065 69.3763L64.7413 70.1489ZM74.4024 58.3871L75.284 58.8592C76.5107 56.5688 77.521 54.1451 78.2875 51.6153L77.3304 51.3254L76.3734 51.0354C75.6456 53.4375 74.6862 55.7393 73.5209 57.9149L74.4024 58.3871Z"
                                                    fill="currentColor"></path>
                                                <circle cx="68" cy="12" r="12" fill="#5865f2"></circle>
                                                <path
                                                    d="M73.3332 11.4075H68.5924V6.66675H67.4072V11.4075H62.6665V12.5927H67.4072V17.3334H68.5924V12.5927H73.3332V11.4075Z"
                                                    fill="white"></path>
                                                <path
                                                    d="M40 29C37.794 29 36 30.794 36 33C36 35.207 37.794 37 40 37C42.206 37 44 35.207 44 33C44 30.795 42.206 29 40 29Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M48 26.001H46.07C45.402 26.001 44.777 25.667 44.406 25.111L43.594 23.891C43.223 23.335 42.598 23 41.93 23H38.07C37.402 23 36.777 23.335 36.406 23.89L35.594 25.11C35.223 25.667 34.598 26 33.93 26H32C30.895 26 30 26.896 30 28V39C30 40.104 30.895 41 32 41H48C49.104 41 50 40.104 50 39V28C50 26.897 49.104 26.001 48 26.001ZM40 39C36.691 39 34 36.309 34 33C34 29.692 36.691 27 40 27C43.309 27 46 29.692 46 33C46 36.31 43.309 39 40 39Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M24.6097 52.712V47.72H22.5457V52.736C22.5457 53.792 22.0777 54.404 21.1417 54.404C20.2177 54.404 19.7377 53.78 19.7377 52.712V47.72H17.6737V52.724C17.6737 55.04 19.0897 56.132 21.1177 56.132C23.1217 56.132 24.6097 55.016 24.6097 52.712ZM26.0314 56H28.0834V53.252H28.6114C30.6154 53.252 31.9474 52.292 31.9474 50.42C31.9474 48.62 30.7114 47.72 28.6954 47.72H26.0314V56ZM29.9554 50.456C29.9554 51.308 29.4514 51.704 28.5394 51.704H28.0594V49.268H28.5754C29.4874 49.268 29.9554 49.664 29.9554 50.456ZM37.8292 56L37.5532 54.224H35.0092V47.72H32.9572V56H37.8292ZM45.9558 51.848C45.9558 49.292 44.4078 47.564 42.0078 47.564C39.6078 47.564 38.0478 49.304 38.0478 51.872C38.0478 54.428 39.6078 56.156 41.9838 56.156C44.3958 56.156 45.9558 54.404 45.9558 51.848ZM43.8918 51.86C43.8918 53.504 43.1958 54.548 41.9958 54.548C40.8078 54.548 40.0998 53.504 40.0998 51.86C40.0998 50.216 40.8078 49.172 41.9958 49.172C43.1958 49.172 43.8918 50.216 43.8918 51.86ZM52.2916 56.084L54.3676 55.748L51.4876 47.684H49.2316L46.2556 56H48.2716L48.8236 54.284H51.6916L52.2916 56.084ZM50.2516 49.796L51.1756 52.676H49.3156L50.2516 49.796ZM62.5174 51.848C62.5174 49.388 61.0174 47.72 58.1374 47.72H55.2814V56H58.1854C60.9814 56 62.5174 54.308 62.5174 51.848ZM60.4534 51.86C60.4534 53.636 59.5414 54.404 58.0774 54.404H57.3334V49.316H58.0774C59.4814 49.316 60.4534 50.12 60.4534 51.86Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                            <img :src="imgPreview" alt="" class="w-20 h-20 rounded-full" v-else>
                                        </div>
                                    </label>
                                    <input type="file" id="image" class="hidden" ref="image" name="image"
                                        @change="onImageChange" accept=".jpg,.jpeg,.png,.gif">
                                </div>
                                <!-- Server name -->
                                <div class="mt-6">
                                    <div class="mb-2 uppercase text-xs font-bold text-[#4e5058]">
                                        Server Name
                                    </div>
                                    <input type="text" name="name" v-model="newServer.name" required
                                        class="w-full h-[2.5rem] p-2.5 focus:ring-0 bg-[#ebebeb] border-none rounded">
                                </div>
                            </form>
                            <div class="mt-2 pb-1 text-xs text-[#5c5e66]">
                                By creating a server, you agree to dKlone's
                                <strong>
                                    <a href="#" class="text-[#006ce7] hover:underline">
                                        Community Guidelines
                                    </a>
                                </strong>
                            </div>
                        </div>
                        <div class="w-full bg-[#f2f3f5] p-4 rounded flex justify-between">
                            <button class="h-[38px] px-1 py-0.5 text-sm leading-4 font-semibold " @click="togglePage(2)">
                                Back
                            </button>
                            <div @click="createServer"
                                class="w-[96px] h-[38px] text-white px-4 py-0.5 text-sm leading-4 font-semibold bg-[#5561e9] rounded flex justify-center items-center cursor-pointer">
                                Create
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { reactive, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import AddServerContainer from "./AddServerContainer.vue";
import { useRouter } from "vue-router";
import { useServersStore } from "../stores/servers";

const props = defineProps({
    state: Boolean
});

const emit = defineEmits(['closeAddServerModal', 'serverCreated']);

const router = useRouter();

const openPage = ref(1);

const authStore = useAuthStore();
const serversStore = useServersStore();

const newServer = reactive({
    name: authStore.user.display_name + '\'s server',
    image: '',
    template: ''
});

const inputErrors = ref([]);

const imgPreview = ref('');

const clearAddServer = () => {
    emit('closeAddServerModal');
    imgPreview.value = '';
    newServer.name = authStore.user.display_name + '\'s server';
    newServer.image = '';
    newServer.template = '';
    openPage.value = 1;
}

const onImageChange = (e) => {
    newServer.image = e.target.files[0];
    imgPreview.value = URL.createObjectURL(newServer.image);
}

const createServer = async () => {
    await axios.post('/api/createServer', newServer, { headers: { 'Content-Type': 'multipart/form-data' } })
        .then(res => {
            serversStore.addServer(res.data);
            clearAddServer();
            // console.log(res.data);
            router.push({ name: 'channel', params: { server: res.data.id, channel: res.data.first_channel.id } });
            emit('closeAddServerModal');
        });
}

const togglePage = (pageNumber, template) => {
    openPage.value = pageNumber;
    if (template !== undefined) {
        newServer.template = template;
    }
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

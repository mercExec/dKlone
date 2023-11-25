<template>
    <section class="bg-[#5865f2] ">
        <div class="flex flex-col items-center justify-center h-screen">
            <div class="w-[49rem] h-[404px] bg-[#313338] shadow rounded-md">
                <div class="px-8 py-8">
                    <h1
                        class="text-2xl font-semibold leading-tight tracking-tight text-[#f2f3f5] dark:text-white text-center">
                        Welcome back!
                    </h1>
                    <div class="text-[#9ca1a8] text-base font-normal text-center pt-1">
                        We're so excited to see you again!
                    </div>
                    <div>
                        <form @submit.prevent="authStore.handleLogin(form)">
                            <div class="space-y-6 mt-5">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Email<span
                                            class="text-[#f23f42] pl-1">*</span></label>
                                    <input type="email" name="email" id="email" v-model="form.email"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.email">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.email[0] }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Password<span
                                            class="text-[#f23f42] pl-1">*</span></label>
                                    <input type="password" name="password" id="password" v-model="form.password"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded-sm ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.password">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.password[0] }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <a href="#" class="text-sm mt-1 mb-5 font-medium text-[#00a8fc] hover:underline">Forgot your
                                    password?</a>
                            </div>
                            <button
                                class="w-full h-[44px] text-white bg-[#5865f2] font-semibold rounded text-sm px-4 py-[2px] mb-2 text-center ">Log
                                In</button>
                            <p class="text-sm font-normal text-[#949ba4]">
                                Need an account? <router-link :to="{ name: 'register' }"
                                    class="text-sm font-medium text-[#00a8fc] hover:underline ">Register</router-link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { onBeforeMount, onUnmounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
const form = ref({
    email: '',
    password: ''
});

onBeforeMount(() => {
    window.Echo = null;
    window.Ably = null;
})

onUnmounted(() => {
    authStore.authErrors = [];
})

</script>

<style></style>

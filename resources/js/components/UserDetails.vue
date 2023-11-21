<template>
    <div class="flex-[0_0_auto] bg-[#232428]">
        <div class="h-[52px] text-sm leading-[14px] font-medium flex items-center px-2 mb-[1px]">
            <!-- Name -->
            <div class="items-center flex -ml-0.5 mr-2 p-0.5 min-w-[120px]">
                <div class="w-[32px] h-[32px] flex-shrink-0 cursor-pointer relative rounded-[50%] text-white bg-[#5865f2]">
                    <img :src="$storage + 'icons/profiles/0.png'" class="cursor-pointer w-full h-full rounded-3xl transition-all duration-150 ease-linear ">
                </div>
                <div class="py-1 pl-2 cursor-pointer select-text flex-grow mr-1 min-w-0">
                    <div>
                        <div class=" whitespace-nowrap text-ellipsis overflow-hidden text-[#f2f3f5] text-sm leading-[18px] font-semibold"
                            v-if="authStore.user">
                            {{ authStore.user.display_name }}
                        </div>
                    </div>
                    <div>
                        <div class=" whitespace-nowrap text-ellipsis overflow-hidden text-[#b5bac1] text-xs leading-[13px] font-normal"
                            v-if="authStore.user">
                            {{ authStore.user.username }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Icons -->
            <div class="flex-initial flex-nowrap justify-end items-stretch flex flex-row ml-auto absolute left-[270px]">
                <button @click.prevent="authStore.handleLogout"
                    class="stroke-0 cursor-pointer leading-[0px] w-[32px] h-[32px] flex items-center justify-center rounded relative text-[#b5bac1] bg-transparent box-border text-sm font-medium transition-all duration-150 ease-linear group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span
                        class="absolute bottom-8 w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                        Logout
                    </span>

                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

</script>

<style></style>
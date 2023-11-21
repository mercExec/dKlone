<template>
    <section class="bg-[#5865f2] dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen">
            <div class="w-[480px] h-[686px] bg-[#313338] shadow rounded-md">
                <div class="px-8 py-8">
                    <h1
                        class="text-2xl font-semibold leading-tight tracking-tight text-[#f2f3f5] dark:text-white text-center">
                        Create an account
                    </h1>
                    <div>
                        <form action="#" @submit.prevent="register">
                            <div class="space-y-6 mt-5">
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Email<span
                                            class="text-[#f23f42] pl-1">*</span></label>
                                    <input type="email" name="email" id="email" v-model="data.email"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.email">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.email[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="display_name"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Display
                                        name</label>
                                    <input type="text" name="display_name" id="display_name" v-model="data.display_name"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.display_name">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.display_name[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="username"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Username<span
                                            class="text-[#f23f42] pl-1">*</span></label>
                                    <input type="text" name="username" id="username" v-model="data.username"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.username">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.username[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="password"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Password<span
                                            class="text-[#f23f42] pl-1">*</span></label>
                                    <input type="password" name="password" id="password" v-model="data.password"
                                        class="block w-full h-10 bg-[#1e1f22] sm:text-sm text-[#dbdee1] rounded-sm ring-0 border-0 focus:border-0 focus:ring-0"
                                        required>
                                    <div v-if="authStore.authErrors.password">
                                        <span class="text-red-400 text-sm m-2 p-2">
                                            {{ authStore.authErrors.password[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label for="dob"
                                        class="block mb-2 text-xs font-bold text-[#b5bac1] font-sans uppercase">Date of
                                        Birth<span class="text-[#f23f42] pl-1">*</span></label>
                                    <dropdown-datepicker :minYear="1900" :maxYear="2020" displayFormat="mdy"
                                        wrapperClass="space-x-3 flex justify-between" :on-day-change="getDay"
                                        :on-month-change="getMonth" :on-year-change="getYear" :required="true"
                                        dropdownClass="w-[124.8px] text-[#b5bac1] bg-[#1e1f22] rounded-sm border-none ">
                                    </dropdown-datepicker>
                                </div>
                                <div v-if="authStore.authErrors.dob">
                                    <span class="text-red-400 text-sm m-2 p-2">
                                        {{ authStore.authErrors.dob[0] }}
                                    </span>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full h-[44px] text-white bg-[#5865f2] font-semibold rounded text-sm px-4 py-[2px] mt-5 mb-2 text-center ">Continue</button>
                            <p class="text-xs font-normal text-[#949ba4]">
                                By registering, you agree to dKlone's <a href="#"
                                    class="text-xs font-medium text-[#00a8fc] hover:underline ">Terms of Service</a> and <a
                                    href="#" class="text-xs font-medium text-[#00a8fc] hover:underline ">Privacy Policy</a>.
                            </p>
                            <p class="pt-5 text-sm font-normal text-[#949ba4]">
                                <router-link :to="{ name: 'login' }"
                                    class="text-sm font-medium text-[#00a8fc] hover:underline">Already have an
                                    account?</router-link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import DropdownDatepicker from '#/vue-dropdown-datepicker/src/dropdown-datepicker.vue';
import { onBeforeMount, ref } from 'vue';
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();

const data = ref({
    email: '',
    display_name: '',
    username: '',
    password: '',
    dob: {
        day: '',
        month: '',
        year: ''
    }
});

const getDay = (day) => {
    data.value.dob.day = day;
}

const getMonth = (month) => {
    data.value.dob.month = month;
}

const getYear = (year) => {
    data.value.dob.year = year;
}

const register = () => {
    const userData = JSON.parse(JSON.stringify(data.value));
    authStore.handleRegistration(userData);
}
onBeforeMount(() => {
    authStore.authErrors = [];
})
</script>

<style></style>

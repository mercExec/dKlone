<template>
    <div @click="isModalOpen = true"
        class="stroke-0 relative flex items-center justify-center h-12 w-12 p-2 mt-3 mb-2 mx-auto shadow-lg bg-[#313338] fill-[#23a559] hover:fill-white hover:bg-green-600  rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear cursor-pointer group">
        <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px"
            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
        </svg>
        <span
            class="absolute w-auto z-10 p-2 m-2 min-w-max left-14 rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
            Add a Server
        </span>
    </div>
    <AddServerModal :state="isModalOpen" @close-add-server-modal="isModalOpen = false"/>
</template>

<script setup>
import { ref } from "vue";
import AddServerModal from './AddServerModal.vue';

const isModalOpen = ref(false);

</script>

<style></style>

<template>
    <div class="flex w-full h-[66px] border-[#80848e3d] rounded-lg border cursor-pointer">
        <div class="ml-4 my-2 mr-2 w-12 h-12 rounded-full" :class="props.bgColor">
        </div>
        <div class="font-bold text-base leading-5 self-center text-[#4f5155]">
            {{ props.text }}
        </div>
        <div class="ml-auto mr-4 self-center">
            <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                    d="m5.41667 4.2625 5.66573 5.7375-5.66573 5.7375 1.74426 1.7625 7.42237-7.5-7.42237-7.5z" fill="#4f5660"
                    fill-rule="evenodd" />
            </svg>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    text: String,
    bgColor: String
});

</script>

<style></style>

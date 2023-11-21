<template>
    <router-link :to="{ name: 'channel', params: { server: props.server.id, channel: props.server.first_channel.id } }">
        <div class="stroke-0 relative flex items-center justify-center h-12 w-12 mt-3 mb-2 mx-auto shadow-lg bg-[#313338] text-white rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear hover:bg-[#5865f2] cursor-pointer group"
            :class="{ 'rounded-xl': route.params.server == props.server.id, 'bg-[#5865f2]': !props.server.image && route.params.server == props.server.id }">
            <img v-if="props.server.image" :src="$storage + props.server.image"
                class="h-12 w-12 rounded-3xl hover:rounded-xl transition-all duration-150 ease-linear"
                :class="{ 'rounded-xl': route.params.server == props.server.id }">
            <div v-else
                class="flex justify-center items-center text-center font-medium leading-[1.2em] w-12 h-12 text-[#dbdee1]">
                <div class="whitespace-nowrap overflow-hidden">
                    {{ extractFirstLetters(props.server.name) }}
                </div>
            </div>

            <span
                class="absolute w-auto z-10 p-2 m-2 min-w-max left-14 rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                {{ props.server.name }}
            </span>
        </div>
    </router-link>
</template>

<script setup>
import { useRoute } from "vue-router"


const props = defineProps({
    server: Object
});

function extractFirstLetters(inputString) {
    const regex = /(\b\w|[^A-Za-z\s])/g; // Match word boundaries, non-alphabetical characters (excluding space)
    const matches = inputString.match(regex);

    if (matches) {
        return matches.join('');
    } else {
        return '';
    }
}

const route = useRoute();
</script>

<style></style>

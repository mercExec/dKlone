<template>
    <div v-if="contextMenu.show" class="absolute bg-[#111214] rounded z-60"
        :style="{ top: `${contextMenu.position.y}px`, left: `${contextMenu.position.x}px` }">
        <div class="min-w-[188px] max-w-[320px] box-border flex h-auto cursor-default rounded">
            <div class="overflow-hidden py-[6px] px-2 relative box-border min-h-0 flex-auto">
                <div>
                    <div v-if="contextMenu.contextMenuItems.friend"
                        @click.prevent="contextMenu.isFriend ? removeFriend() : friendsStore.addFriend(contextMenu.user.username)"
                        class="text-[#b5bac1] hover:bg-[#3c45a5] box-border flex justify-between min-h-[32px] py-[6px] px-2 mt-0.5 rounded-sm text-sm leading-[18px] font-semibold cursor-pointer">
                        <div class="flex-auto whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ contextMenu.isFriend ? 'Remove Friend' : 'Add Friend' }}
                        </div>
                    </div>
                    <div v-if="contextMenu.contextMenuItems.message" @click.prevent="goToConversation(contextMenu.user.id)"
                        class="text-[#b5bac1] hover:bg-[#3c45a5] box-border flex justify-between min-h-[32px] py-[6px] px-2 mt-0.5 rounded-sm text-sm leading-[18px] font-semibold cursor-pointer">
                        <div class="flex-auto whitespace-nowrap overflow-hidden text-ellipsis">
                            Message
                        </div>
                    </div>
                    <div v-if="contextMenu.contextMenuItems.block"
                        @click.prevent="contextMenu.isBlocked ? friendsStore.unblockUser(contextMenu.user.id) : friendsStore.blockUser(contextMenu.user.id)"
                        class="text-[#b5bac1] hover:bg-[#3c45a5] box-border flex justify-between min-h-[32px] py-[6px] px-2 mt-0.5 rounded-sm text-sm leading-[18px] font-semibold cursor-pointer">
                        <div class="flex-auto whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ contextMenu.isBlocked ? 'Unblock' : 'Block' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useConversationsStore } from '../stores/conversations';
import { useFriendsStore } from '../stores/friends';

const props = defineProps({
    contextMenu: Object
})

const contextMenu = ref(props.contextMenu);

console.log(contextMenu.value);

const friendsStore = useFriendsStore();
const conversationStore = useConversationsStore();

const router = useRouter();

const removeFriend = () => {
    friendsStore.removeFriend(contextMenu.value.user.id);
    friendsStore.userFriends.splice(contextMenu.value.friendIndex, 1);
}

const goToConversation = async (recipientId) => {
    let conversation = await conversationStore.redirectToConversation(recipientId);
    console.log(conversation);
    router.push({ name: 'conversation', params: { conversation: conversation.id } });
}

watch(
    () => props.contextMenu,
    () => { contextMenu.value = props.contextMenu; console.log('prop changed'); },
);

</script>

<style></style>

<template>
    <div class="h-screen flex w-screen overflow-hidden">
        <ServersSidebar />
        <router-view></router-view>
    </div>
</template>

<script setup>
import { onBeforeMount, onBeforeUnmount } from 'vue';
import ServersSidebar from '../components/ServersSidebar';
import { useAuthStore } from '../stores/auth';
import { useConversationsStore } from '../stores/conversations';
import { useFriendsStore } from '../stores/friends';

const authStore = useAuthStore();
const conversationStore = useConversationsStore();
const friendsStore = useFriendsStore();

onBeforeMount(async () => {
    await friendsStore.getPendingFriendships();
    await friendsStore.getFriends();
    await friendsStore.getBlockedUsers();

    if (!window.Echo && !window.Ably) {
        await authStore.connectToAbly();
    }
    await conversationStore.getNotifications();
    setTimeout(async () => {
        await authStore.subscribeToUserChannel();
        await authStore.subscribeToPresenceChannel();
    }, 1500);
})

onBeforeUnmount(async () => {
    // await authStore.disconnectFromAbly(authStore.user.id);
})
</script>

<style></style>

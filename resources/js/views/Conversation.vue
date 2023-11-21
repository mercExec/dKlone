<template>
    <div class="bg-[#313338] h-full flex-none w-full">
        <!-- Chat content -->
        <div class="w-full " v-if="conversationStore.selectedConversation && recipient">
            <section class="h-12 w-full p-2 shadow-md ">
                <div class="flex pt-[3px] pr-1 ">
                    <div class="text-[#949ba4] flex pr-2 pl-2">
                        <div class="pt-[2px]">
                            <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" role="img">
                                <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.88657 21C5.57547 21 5.3399 20.7189 5.39427 20.4126L6.00001 17H2.59511C2.28449 17 2.04905 16.7198 2.10259 16.4138L2.27759 15.4138C2.31946 15.1746 2.52722 15 2.77011 15H6.35001L7.41001 9H4.00511C3.69449 9 3.45905 8.71977 3.51259 8.41381L3.68759 7.41381C3.72946 7.17456 3.93722 7 4.18011 7H7.76001L8.39677 3.41262C8.43914 3.17391 8.64664 3 8.88907 3H9.87344C10.1845 3 10.4201 3.28107 10.3657 3.58738L9.76001 7H15.76L16.3968 3.41262C16.4391 3.17391 16.6466 3 16.8891 3H17.8734C18.1845 3 18.4201 3.28107 18.3657 3.58738L17.76 7H21.1649C21.4755 7 21.711 7.28023 21.6574 7.58619L21.4824 8.58619C21.4406 8.82544 21.2328 9 20.9899 9H17.41L16.35 15H19.7549C20.0655 15 20.301 15.2802 20.2474 15.5862L20.0724 16.5862C20.0306 16.8254 19.8228 17 19.5799 17H16L15.3632 20.5874C15.3209 20.8261 15.1134 21 14.8709 21H13.8866C13.5755 21 13.3399 20.7189 13.3943 20.4126L14 17H8.00001L7.36325 20.5874C7.32088 20.8261 7.11337 21 6.87094 21H5.88657ZM9.41045 9L8.35045 15H14.3504L15.4104 9H9.41045Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="font-semibold text-white pb-2 truncate-ellipsis">{{ recipient.display_name }}</div>
                    <div class="w-[1px] h-6 mx-2 bg-[#3e4047]"></div>
                </div>
            </section>
        </div>
        <div class="h-full w-full">
            <div class="h-full flex-none place-items-start">
                <!-- Chat messages -->
                <div class="pl-4 h-[819px] w-full">
                    <div class="h-full flex flex-col-reverse">
                        <!-- Chat container -->
                        <div ref="chatContainer" class="w-full pb-[9px] pt-2 overflow-y-auto " @scroll="handleScroll">
                            <!-- <div class="text-white" v-if="endOfMessages">
                                End of messages
                            </div> -->
                            <!-- Skeleton loader -->
                            <div ref="loaderContainer" class="space-y-6 pb-6" v-if="loading">
                                <div class="w-full flex animate-pulse mb-4">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4 bg-[#3e4145] rounded-3xl"></div>
                                        <div>
                                            <div class="flex">
                                                <div class="bg-[#525559] h-4 w-16 rounded-lg">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <p class="bg-[#3b3d42] h-4 w-16 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-20 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-10 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-14 rounded-lg mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex animate-pulse mb-4">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4 bg-[#3e4145] rounded-3xl"></div>
                                        <div>
                                            <div class="flex">
                                                <div class="bg-[#525559] h-4 w-16 rounded-lg">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <p class="bg-[#3b3d42] h-4 w-16 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-20 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-10 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-14 rounded-lg mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex animate-pulse mb-4">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4 bg-[#3e4145] rounded-3xl"></div>
                                        <div>
                                            <div class="flex">
                                                <div class="bg-[#525559] h-4 w-16 rounded-lg">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <p class="bg-[#3b3d42] h-4 w-16 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-20 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-10 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-14 rounded-lg mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex animate-pulse mb-4">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4 bg-[#3e4145] rounded-3xl"></div>
                                        <div>
                                            <div class="flex">
                                                <div class="bg-[#525559] h-4 w-16 rounded-lg">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <p class="bg-[#3b3d42] h-4 w-16 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-20 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-10 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-14 rounded-lg mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex animate-pulse mb-4">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4 bg-[#3e4145] rounded-3xl"></div>
                                        <div>
                                            <div class="flex">
                                                <div class="bg-[#525559] h-4 w-16 rounded-lg">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <p class="bg-[#3b3d42] h-4 w-16 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-20 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-10 rounded-lg mt-2"></p>
                                                <p class="bg-[#3b3d42] h-4 w-14 rounded-lg mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- !Skeleton loader! -->
                            <!-- Messages -->
                            <div id="all-messages" v-if="conversationStore.selectedConversation && recipient">
                                <div class="w-full flex message" v-for="(group, index) in groupedMessages" :key="index">
                                    <div class="flex">
                                        <div class="w-10 h-10 mr-4" v-if="group[0].user">
                                            <img :src="$storage + 'icons/profiles/0.png'"
                                                class="cursor-pointer w-10 h-10 rounded-3xl">
                                        </div>
                                        <div class="">
                                            <div class="flex">
                                                <div @contextmenu.prevent="showContextMenu($event, group[0].user)"
                                                    class="font-medium text-[#f2f3f5] cursor-pointer text-base leading-[1.375rem] hover:underline mr-1">
                                                    {{ group[0].user.display_name }}
                                                </div>

                                                <div
                                                    class="ml-1 font-medium text-xs leading-[1.375rem] text-[#949ba4] pt-[1.5px]">
                                                    {{ group[0].created_at }}
                                                </div>
                                            </div>
                                            <template v-for="(message, messageIndex) in group" :key="messageIndex">
                                                <p :id="`message-${message.id}`"
                                                    class="text-[#dbdee1] text-base leading-[1.375rem] pt-2"
                                                    :class="{ 'mb-4': messageIndex === group.length - 1 }">
                                                    {{ message.content }}
                                                </p>

                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ContextMenu :contextMenu="contextMenu" @closeContextMenu="contextMenu.show = false" />
                            <!-- !Messages! -->
                        </div>
                    </div>
                </div>
                <!-- Input field -->
                <div class="h-[68px] w-[84%] pb-6 px-4">
                    <form @submit.prevent="sendMessage"
                        v-if="conversationStore.selectedConversation && recipient">
                        <div class="flex rounded-lg overflow-hidden">
                            <span class="text-3xl text-grey bg-[#383a40] px-4 py-2.5">
                                <svg width="24" height="24" viewBox="0 0 24 24" class="text-[#b5bac1]">
                                    <path class="attachButtonPlus-3IYelE" fill="currentColor"
                                        d="M12 2.00098C6.486 2.00098 2 6.48698 2 12.001C2 17.515 6.486 22.001 12 22.001C17.514 22.001 22 17.515 22 12.001C22 6.48698 17.514 2.00098 12 2.00098ZM17 13.001H13V17.001H11V13.001H7V11.001H11V7.00098H13V11.001H17V13.001Z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" v-model="message.content" name="content" ref="messageInput"
                                class="w-full p-0 bg-[#383a40] focus:ring-0 border-none rounded text-[#dbdee1] placeholder:text-[#6d6f78] text-base leading-[22px]"
                                :placeholder="'Message #' + recipient.display_name ?? ''" />
                        </div>
                        <div class="text-red-400 text-xs justify-start items-start" v-if="messageError">
                            {{ messageError }}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { computed, nextTick, onBeforeMount, onBeforeUnmount, onMounted, reactive, ref, watch } from "vue";
import { onBeforeRouteUpdate, useRoute } from "vue-router";
import { useAuthStore } from "../stores/auth";
import { useFriendsStore } from "../stores/friends";
import { useConversationsStore } from "../stores/conversations";
import ContextMenu from '../components/ContextMenu.vue';

const route = useRoute();
let conversationId = route.params.conversation;
const recipient = ref(null);

const authStore = useAuthStore();
const conversationStore = useConversationsStore();
const friendsStore = useFriendsStore();

const message = reactive({
    content: ''
});
const messageError = ref(null);

const ablyChannel = ref();

const messageInput = ref();
const chatContainer = ref();
const loaderContainer = ref();
const messages = ref([]);
const usersInConversation = ref([]);
// messages are paginated in batches of 30 messages
const page = ref(1);
// Store eference to last message
const lastMessage = ref();
// When all messages are loaded, this will be true
const endOfMessages = ref(false);
// To check if the loader needs to be displayed or not
const loading = ref(true);
const contextMenu = ref({
    show: false,
    position: { x: 0, y: 0 },
    user: null,
    isBlocked: false,
    isFriend: false,
    blockedIndex: null,
    friendIndex: null,
    contextMenuItems: {
        message: false,
        block: true,
        friend: true
    }
});
const userScrolled = ref(false);

const showContextMenu = (event, user) => {

    if (user.id !== authStore.user.id) {
        contextMenu.value.position = { x: event.pageX, y: event.pageY };

        let blocked = friendsStore.blockedUsers.find((blockedUser, index) => {
            if (blockedUser.recipient_id == user.id) {
                console.log('user is blocked: ' + blockedUser.recipient.display_name);
                contextMenu.value.isBlocked = true;
                contextMenu.value.blockedIndex = index;
                return true;
            }
        });

        if (!blocked) {
            contextMenu.value.isBlocked = false;
            contextMenu.value.blockedIndex = null;
            console.log('No blocked user found');
        }

        let friend = friendsStore.friends.find((friend, index) => {
            if (friend.id == user.id) {
                console.log('user is friend');
                contextMenu.value.isFriend = true;
                contextMenu.value.friendIndex = index;
                return true;
            }
        });

        if (!friend) {
            contextMenu.value.isFriend = false;
            contextMenu.value.friendIndex = null;
        }

        contextMenu.value.user = user;
        contextMenu.value.show = true;
    }
}

const getMessages = async () => {
    // Get latest initial messages. This api returns paginated results (30 records)
    await axios.get('/api/getDirectMessages/' + conversationId + '?page=' + page.value)
        .then(async (res) => {
            // Wait until messages are loaded
            // Put in messages array
            await messages.value.push(...res.data.data);

            // Check if all messages have been retrieved
            endOfMessages.value = res.data.data.length < 30 ? true : false;
            if (endOfMessages.value == true) {
                loading.value = false
            }

            // Set lastMessage to the the last message in the initial batch
            if (res.data.data.length > 0) {
                lastMessage.value = res.data.data[res.data.data.length - 1];
            }
        });

    return true;
}

const getMoreMessages = async () => {
    // Get the id of the last message before loading the new batch
    if (lastMessage.value) {
        const previousLastMessageId = 'message-' + lastMessage.value.id;
        // Get the next page of results
        ++page.value;

        await getMessages();
        // After adding new message(s), set scroll to position of
        // what was the last message
        if (endOfMessages.value == false && previousLastMessageId) {
            const previousLastMessage = document.getElementById(previousLastMessageId);
            if (previousLastMessage) {
                previousLastMessage.scrollIntoView({ block: 'nearest', inline: 'nearest' });
            }
        }
    }
}

const groupedMessages = computed(() => {
    const grouped = [];
    let group = [];
    let lastUser = null; // Keep track of the last user

    for (let i = messages.value.length - 1; i >= 0; i--) {
        const message = messages.value[i];

        if (group.length === 0) {
            group.push(message);
        } else if (lastUser && lastUser.id === message.user.id) {
            group.push(message);
        } else {
            grouped.push([...group]);
            group = [message];
        }

        lastUser = message.user; // Update the last user

        if (i === 0) {
            // Only push the last group if it's not empty
            if (group.length > 0) {
                grouped.push([...group]);
            }
        }
    }

    return grouped;
});

const scrollToBottom = () => {
    // Scroll to the bottom of chat container
    chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
}

const sendMessage = () => {
    axios.post('/api/sendDirectMessage/ ' + recipient.value.id + '/' + conversationId, message)
        .then(async (res) => {
            scrollToBottom();

            // If the receiver is not in the conversation widnow, create a notification in the database and fire a notification event
            if (usersInConversation.value.length == 1) {
                console.log('creating notification...');
                await axios.post('/api/createNotification/' + authStore.user.id + '/' + recipient.value.id + '/' + conversationId)
            }
        })
        .catch(err => {
            if (err.response.status == 422) {
                messageError.value = err.response.data.errors.content[0];
                setTimeout(() => {
                    messageError.value = '';
                }, 3500);
            }
        });
    message.content = '';
}

const intersectionOptions = {
    root: null, // Use the viewport as the root
    rootMargin: '0px', // No margins
    threshold: 0.1, // When at least 10% of the element is in the viewport
}

const handleIntersection = async (entries) => {
    // We have 1 entry and that's the loader
    if (entries[0].isIntersecting) {
        // Load more messages when the loader is in the viewport
        await getMoreMessages();
    }
}

// Watch for changes in conversation parameter
watch(() => route.params.conversation, () => {
    // Reinitialize the Intersection Observer when the conversation parameter change
    if (route.params.conversation) {
        const loaderObserver = new IntersectionObserver(handleIntersection, intersectionOptions);

        // Start observing the loader
        if (loaderContainer.value) {
            loaderObserver.observe(loaderContainer.value);
        }
    }
});

const connectToAblyChannel = async () => {
    if (conversationStore.selectedConversation) {
        ablyChannel.value = await window.Echo.join('conversation:' + conversationStore.selectedConversation.id)
            .subscribed(function () {
                console.log('Connected to conversation');
                nextTick(() => {
                    if (messageInput.value) {
                        messageInput.value.focus({ preventScroll: true });
                    }
                    // Remove any notifications from the UI
                    conversationStore.conversationNotifications.find((notification, i) => {
                        if (notification && notification.conversation_id == conversationStore.selectedConversation.id) {
                            conversationStore.conversationNotifications.splice(i, 1);
                        }
                    });
                });
            })
            .here(users => {
                users.every((user) => {
                    if (user.id !== authStore.user.id) {
                        usersInConversation.value.push(user);
                    }
                });
            })
            .joining((user) => {
                console.log(user.name + ' joinned channel');
                usersInConversation.value.push(user);
            })
            .leaving((leavingUser) => {
                usersInConversation.value.find((user, i) => {
                    if (leavingUser.id == user.id) {
                        usersInConversation.value.splice(i, 1);
                        return true;
                    }
                });
            })
            .listen('.directMessage.new', (data) => {
                messages.value.unshift(data.message)
            });
    }
}

const disconnectFromAbly = async () => {
    await window.Echo.leaveChannel(ablyChannel.value.name);
}

const handleScroll = () => {
    const atBottom = chatContainer.value.scrollHeight - chatContainer.value.scrollTop - chatContainer.value.clientHeight < 170;
    userScrolled.value = !atBottom;
};

watch(messages.value, () => {
    if (!userScrolled.value) {
        // Use nextTick to ensure the DOM has been updated
        nextTick(() => {
            scrollToBottom();
        });
    }
});


onBeforeMount(async () => {
    await conversationStore.getConversation(conversationId)
        .then(async (res) => {
            recipient.value = conversationStore.selectedConversation.user1.id == authStore.user.id ? conversationStore.selectedConversation.user2 : conversationStore.selectedConversation.user1;

            await connectToAblyChannel();
            await getMessages();
            scrollToBottom();
        });
})

onMounted(() => {
    const loaderObserver = new IntersectionObserver(handleIntersection, intersectionOptions);

    // Start observing the chat container
    if (loaderContainer.value) {
        loaderObserver.observe(loaderContainer.value);
    }

    // Stop observing when the component is unmounted
    onBeforeMount(() => {
        loaderObserver.disconnect();
    })

    // Detect click outside context menu
    window.addEventListener('click', () => {
        contextMenu.value.show = false;
    });
})

onBeforeUnmount(async () => {
    await disconnectFromAbly();
    conversationStore.selectedConversation = null;
})

onBeforeRouteUpdate(async (to, from, next) => {
    const newConversationId = to.params.conversation;
    const oldConversationId = from.params.conversation;
    if (newConversationId !== oldConversationId) {
        await disconnectFromAbly();
        conversationId = newConversationId;
        page.value = 1;
        messages.value = [];
        message.content = '';
        messageError.value = null;
        lastMessage.value = '';
        endOfMessages.value = false;
        loading.value = true;
        recipient.value = null;
        userScrolled.value = false;

        // Fetch new conversation data when navigating to a different conversation
        await conversationStore.getConversation(conversationId)
            .then(async () => {
                recipient.value = conversationStore.selectedConversation.user1.id == authStore.user.id ? conversationStore.selectedConversation.user2 : conversationStore.selectedConversation.user1;
                // // Remove any notifications from the UI
                await connectToAblyChannel();
                await getMessages();
                scrollToBottom();
                next();
            });
    } else {
        next();
    }
});
</script>

<style></style>

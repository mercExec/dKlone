<script setup>

let messages = [
    {
        sender: {
            username: 'user332',
            profilePicture: '0',
        },
        message: 'testing',
        date: '10/09/2023 11:14 AM',
    },
    {
        sender: {
            username: 'user332',
            profilePicture: '0',
        },
        message: 'asdasda',
        date: '10/09/2023 11:14 AM',
    },
    {
        sender: {
            username: 'user332',
            profilePicture: '0',
        },
        message: 'asdsadsa',
        date: '10/09/2023 11:14 AM',
    },
    {
        sender: {
            username: 'iig3',
            profilePicture: '2',
        },
        message: 'asdsadsada',
        date: '10/09/2023 11:14 AM',
    },
    {
        sender: {
            username: 'iig3',
            profilePicture: '2',
        },
        message: 'dsadsad',
        date: '10/09/2023 11:14 AM',
    },
    {
        sender: {
            username: 'iig3',
            profilePicture: '2',
        },
        message: 'asd',
        date: '10/09/2023 11:14 AM',
    },
];

const isFirstMessageFromUser = (index, sender) => {
    if (index === 0) {
        return true;
    }

    const previousMessage = messages[index - 1];
    return (
        sender.username !== previousMessage.sender.username ||
        sender.profilePicture !== previousMessage.sender.profilePicture
    );
};

const isLastMessageFromUser = (index, sender) => {
    if (index === messages.length - 1) {
        return true;
    }

    const nextMessage = messages[index + 1];
    return (
        sender.username !== nextMessage.sender.username ||
        sender.profilePicture !== nextMessage.sender.profilePicture
    );
};
</script>

<template>
    <div class="bg-[#313338] h-screen flex w-full">
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Chat messages -->
            <div class="pl-4 flex-1">
                <div class="h-full relative overflow-y-scroll">
                    <div class="absolute bottom-0 w-full pb-[9px]" v-if="messages">
                        <div class="w-full flex" v-for="(message, index) in messages" :key="index">
                            <div v-if="isFirstMessageFromUser(index, message.sender)" class="flex">
                                <!-- Profile Picture -->
                                <div class="w-10 h-10 mr-4 pt-[10px]">
                                    <img :src="`https://cdn.discordapp.com/embed/avatars/${message.sender.profilePicture}.png`"
                                        class="cursor-pointer w-10 h-10 rounded-3xl" />
                                </div>
                                <div>
                                    <div class="flex">
                                        <!-- Username -->
                                        <div
                                            class=" font-medium text-[#f2f3f5] cursor-pointer text-base leading-[1.375rem] hover:underline mr-1">
                                            {{ message.sender.username }}
                                        </div>
                                        <!-- Date -->
                                        <div class=" ml-1 font-medium text-xs leading-[1.375rem] text-[#949ba4] pt-[1.5px]">
                                            {{ message.date }}
                                        </div>
                                    </div>
                                    <!-- Message -->
                                    <p class="text-[#dbdee1] text-base leading-[1.375rem]">
                                        {{ message.message }}
                                    </p>
                                </div>
                            </div>
                            <!-- Message -->
                            <p v-else class=" flex text-[#dbdee1] text-base leading-[1.375rem] py-0.5 ml-[56px]"
                                :class="{ 'mb-4': isLastMessageFromUser(index, message.sender) }">
                                {{ message.message }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

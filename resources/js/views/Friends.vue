<template>
    <div class="h-full flex w-full">
        <DirectMessages />
        <div class="bg-[#313338] w-full" v-if="!route.params.conversation">
            <div class="flex flex-col h-full">
                <section class="h-12 w-full p-2 shadow-md ">
                    <div class="flex pt-[3px] pr-1">
                        <div class="text-white fill-[#80848e] flex pr-2 pl-2">
                            <div class="pr-2 pt-[3px]">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.2em"
                                    viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
                                </svg>
                            </div>
                            <span class="font-semibold">Friends</span>
                        </div>

                        <div class="w-[1px] h-6 mx-2 bg-[#3e4047]"></div>

                        <div class="space-x-4 text-[#b5bac1] pl-2 flex">
                            <div class="px-2 cursor-pointer" @click="toggleTabs(1)"
                                :class="{ ' bg-[#42444a] text-white rounded-[3px] ': openTab === 1 }">Online</div>
                            <div class="px-2 cursor-pointer" @click="toggleTabs(2)"
                                :class="{ ' bg-[#42444a] text-white rounded-[3px]': openTab === 2 }">All</div>
                            <div class="px-2 cursor-pointer" @click="toggleTabs(3)"
                                :class="{ ' bg-[#42444a] text-white rounded-[3px]': openTab === 3 }">

                                <div class="flex justify-center items-center text-center min-w-10 rounded  ">
                                    Pending
                                    <div class="pt-1" v-if="incomingRequests > 0">
                                        <div class="bg-[#f23f42] w-4 h-4 min-w-[16px] min-h-[16px] ml-2 pr-[1px] flex items-center justify-center rounded-lg text-center flex-[0_0_auto] text-xs font-bold tracking-[0.02em] text-white">
                                            {{ incomingRequests }}
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="px-2 cursor-pointer" @click="toggleTabs(4)"
                                :class="{ ' bg-[#42444a] text-white rounded-[3px]': openTab === 4 }">Blocked</div>
                            <div class="px-2 cursor-pointer font-semibold" @click="toggleTabs(5)"
                                :class="{ ' text-[#2dc770]': openTab === 5, 'text-white bg-[#248046] rounded-[3px]': openTab !== 5 }">Add
                                Friend</div>
                        </div>
                    </div>
                </section>
                <div class="flex-1 overflow-auto">
                    <div class="flex h-full">
                        <!-- Online Tab -->
                        <div class="flex-1 overflow-auto h-full" :class="{ 'hidden': openTab !== 1 }">
                            <div class="flex flex-col h-full">
                                <div class="mt-4 mb-2 mr-5 ml-[30px]">
                                    <div
                                        class="p-[1px] flex items-center bg-[#1e1f22] focus-within:border-solid rounded focus-within:border-[#00a8fc]">
                                        <input v-model="searchOnlineUser" type="text"
                                            class="h-[30px] w-full px-2 m-[1px] bg-[#1e1f22] text-[#dbdee1] focus:ring-0 outline-0 border-0  placeholder:font-medium placeholder:text-base placeholder:leading-8 placeholder:text-[#777a7c]"
                                            placeholder="Search">
                                        <div class="text-[#b5bac1] w-8 h-8 flex justify-center items-center">
                                            <div class="w-5 h-5 relative">
                                                <svg v-if="!searchOnlineUser" class="w-full h-full absolute top-0 left-0"
                                                    aria-label="Search" aria-hidden="false" role="img" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M21.707 20.293L16.314 14.9C17.403 13.504 18 11.799 18 10C18 7.863 17.167 5.854 15.656 4.344C14.146 2.832 12.137 2 10 2C7.863 2 5.854 2.832 4.344 4.344C2.833 5.854 2 7.863 2 10C2 12.137 2.833 14.146 4.344 15.656C5.854 17.168 7.863 18 10 18C11.799 18 13.504 17.404 14.9 16.314L20.293 21.706L21.707 20.293ZM10 16C8.397 16 6.891 15.376 5.758 14.243C4.624 13.11 4 11.603 4 10C4 8.398 4.624 6.891 5.758 5.758C6.891 4.624 8.397 4 10 4C11.603 4 13.109 4.624 14.242 5.758C15.376 6.891 16 8.398 16 10C16 11.603 15.376 13.11 14.242 14.243C13.109 15.376 11.603 16 10 16Z">
                                                    </path>
                                                </svg>
                                                <svg v-else aria-label="Clear" aria-hidden="false" role="img"
                                                    class="w-full h-full absolute top-0 left-0" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between items-center">
                                    <h2
                                        class="mt-4 mb-2 mr-5 ml-[30px] uppercase text-ellipsis whitespace-nowrap overflow-hidden text-xs tracking-[0.02em] font-semibold text-[#b5bac1] flex-1 box-border ">
                                        Online — {{ onlineFriends.length }} <!-- Number of blocked users -->
                                    </h2>
                                </div>
                                <div class="pb-2 mt-2  overflow-y-scroll h-full  ">
                                    <div>
                                        <!-- Online User -->
                                        <div v-for="(onlineFriend, index) in onlineFriends" :key="index"
                                            @contextmenu.prevent="showContextMenu($event, onlineFriend, 'online')"
                                            class="h-[62px] opacity-100 flex flex-row ml-[30px] mr-5 font-medium text-base leading-5 box-border border-t border-solid border-[#4e50587a] hover:bg-[#393c41] hover:rounded-lg">
                                            <div class="flex flex-[0_1_100%] items-center leading-5 cursor-pointer">
                                                <div class="flex overflow-hidden">
                                                    <div
                                                        class="h-[32px] w-[32px] mr-3 mb-[6px] shrink-0 relative rounded-[50%]">
                                                        <img :src="$storage + 'icons/profiles/0.png'"
                                                            class="w-full h-full object-cover cursor-pointer rounded-3xl">
                                                    </div>
                                                </div>
                                                <div class="flex flex-col overflow-hidden pb-[7px]">
                                                    <div
                                                        class=" overflow-hidden flex-grow items-end justify-start leading-[17.6px]">
                                                        <span
                                                            class=" whitespace-nowrap text-ellipsis overflow-hidden block flex-initial font-semibold text-base text-[#f2f3f5]">
                                                            {{ onlineFriend.display_name }}
                                                        </span>
                                                        <div class="text-xs font-medium text-[#b5bac1]">
                                                            Online
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex ml-auto">
                                                    <div @click="goToConversation(onlineFriend.id)"
                                                        class="flex ml-auto items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path fill="currentColor" class=" group-hover:fill-[#dbdee1]"
                                                                d="M4.79805 3C3.80445 3 2.99805 3.8055 2.99805 4.8V15.6C2.99805 16.5936 3.80445 17.4 4.79805 17.4H7.49805V21L11.098 17.4H19.198C20.1925 17.4 20.998 16.5936 20.998 15.6V4.8C20.998 3.8055 20.1925 3 19.198 3H4.79805Z">
                                                            </path>
                                                        </svg>
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                            Message
                                                        </span>
                                                    </div>
                                                    <div @click.stop.prevent ="showContextMenu($event, onlineFriend, 'more')"
                                                        class="flex ml-[10px] items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path d="M24 0v24H0V0z"></path>
                                                                <path fill="currentColor"
                                                                    class=" group-hover:fill-[#dbdee1]"
                                                                    d="M12 16c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2zm0-6c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2zm0-6c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                            More
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- !Online User -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- !Online Tab -->
                        <!-- All Friends Tab -->
                        <div class="flex-1 overflow-auto h-full" :class="{ 'hidden': openTab !== 2 }">
                            <div class="flex flex-col h-full">
                                <div class="mt-4 mb-2 mr-5 ml-[30px]">
                                    <div
                                        class="p-[1px] flex items-center bg-[#1e1f22] focus-within:border-solid rounded focus-within:border-[#00a8fc]">
                                        <input v-model="searchAllUsers" type="text"
                                            class="h-[30px] w-full px-2 m-[1px] bg-[#1e1f22] text-[#dbdee1] focus:ring-0 outline-0 border-0  placeholder:font-medium placeholder:text-base placeholder:leading-8 placeholder:text-[#777a7c]"
                                            placeholder="Search">
                                        <div class="text-[#b5bac1] w-8 h-8 flex justify-center items-center">
                                            <div class="w-5 h-5 relative">
                                                <svg v-if="!searchAllUsers" class="w-full h-full absolute top-0 left-0"
                                                    aria-label="Search" aria-hidden="false" role="img" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M21.707 20.293L16.314 14.9C17.403 13.504 18 11.799 18 10C18 7.863 17.167 5.854 15.656 4.344C14.146 2.832 12.137 2 10 2C7.863 2 5.854 2.832 4.344 4.344C2.833 5.854 2 7.863 2 10C2 12.137 2.833 14.146 4.344 15.656C5.854 17.168 7.863 18 10 18C11.799 18 13.504 17.404 14.9 16.314L20.293 21.706L21.707 20.293ZM10 16C8.397 16 6.891 15.376 5.758 14.243C4.624 13.11 4 11.603 4 10C4 8.398 4.624 6.891 5.758 5.758C6.891 4.624 8.397 4 10 4C11.603 4 13.109 4.624 14.242 5.758C15.376 6.891 16 8.398 16 10C16 11.603 15.376 13.11 14.242 14.243C13.109 15.376 11.603 16 10 16Z">
                                                    </path>
                                                </svg>
                                                <svg v-else aria-label="Clear" aria-hidden="false" role="img"
                                                    class="w-full h-full absolute top-0 left-0" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between items-center">
                                    <h2
                                        class="mt-4 mb-2 mr-5 ml-[30px] uppercase text-ellipsis whitespace-nowrap overflow-hidden text-xs tracking-[0.02em] font-semibold text-[#b5bac1] flex-1 box-border ">
                                        All Friends — {{ friendsStore.friends.length }} <!-- Number of users -->
                                    </h2>
                                </div>
                                <div class="pb-2 mt-2  overflow-y-scroll h-full  ">
                                    <div>
                                        <!-- User -->
                                        <div v-for="(friend, index) in friendsStore.userFriends" :key="index"
                                            @contextmenu.prevent="showContextMenu($event, friend, 'all')"
                                            class="h-[62px] opacity-100 flex flex-row ml-[30px] mr-5 font-medium text-base leading-5 box-border border-t border-solid border-[#4e50587a] hover:bg-[#393c41] hover:rounded-lg">
                                            <div class="flex flex-[0_1_100%] items-center leading-5 cursor-pointer">
                                                <div class="flex overflow-hidden">
                                                    <div
                                                        class="h-[32px] w-[32px] mr-3 mb-[6px] shrink-0 relative rounded-[50%]">
                                                        <img :src="$storage + 'icons/profiles/0.png'"
                                                            class="w-full h-full object-cover cursor-pointer rounded-3xl">
                                                    </div>
                                                </div>
                                                <div class="flex flex-col overflow-hidden pb-[7px]">
                                                    <div
                                                        class=" overflow-hidden flex-grow items-end justify-start leading-[17.6px]">
                                                        <span
                                                            class=" whitespace-nowrap text-ellipsis overflow-hidden block flex-initial font-semibold text-base text-[#f2f3f5]">
                                                            {{ friend.display_name }}
                                                        </span>
                                                        <div class="text-xs font-medium text-[#b5bac1]">
                                                            {{ friend.status == userStatus.ONLINE ? 'Online' : 'Offline' }}
                                                            <!-- Modify to show user status after adding 'status' column to users table -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex ml-auto">
                                                    <div @click="goToConversation(friend.id)"
                                                        class="flex ml-auto items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path fill="currentColor" class=" group-hover:fill-[#dbdee1]"
                                                                d="M4.79805 3C3.80445 3 2.99805 3.8055 2.99805 4.8V15.6C2.99805 16.5936 3.80445 17.4 4.79805 17.4H7.49805V21L11.098 17.4H19.198C20.1925 17.4 20.998 16.5936 20.998 15.6V4.8C20.998 3.8055 20.1925 3 19.198 3H4.79805Z">
                                                            </path>
                                                        </svg>
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                            Message
                                                        </span>
                                                    </div>
                                                    <div @click.stop.prevent="showContextMenu($event, friend, 'more')"
                                                        class="flex ml-[10px] items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path d="M24 0v24H0V0z"></path>
                                                                <path fill="currentColor"
                                                                    class=" group-hover:fill-[#dbdee1]"
                                                                    d="M12 16c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2zm0-6c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2zm0-6c1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2-2-.8954305-2-2 .8954305-2 2-2z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                            More
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- !User -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- !All Friends Tab -->
                        <!-- Pending Tab -->
                        <div class="flex-1 overflow-auto h-full" :class="{ 'hidden': openTab !== 3 }">
                            <div class="flex flex-col h-full">
                                <div class="mt-4 mb-2 mr-5 ml-[30px]">
                                    <div
                                        class="p-[1px] flex items-center bg-[#1e1f22] focus-within:border-solid rounded focus-within:border-[#00a8fc]">
                                        <input v-model="searchPendingUser" type="text"
                                            class="h-[30px] w-full px-2 m-[1px] bg-[#1e1f22] text-[#dbdee1] focus:ring-0 outline-0 border-0  placeholder:font-medium placeholder:text-base placeholder:leading-8 placeholder:text-[#777a7c]"
                                            placeholder="Search">
                                        <div class="text-[#b5bac1] w-8 h-8 flex justify-center items-center">
                                            <div class="w-5 h-5 relative">
                                                <svg v-if="!searchPendingUser" class="w-full h-full absolute top-0 left-0"
                                                    aria-label="Search" aria-hidden="false" role="img" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M21.707 20.293L16.314 14.9C17.403 13.504 18 11.799 18 10C18 7.863 17.167 5.854 15.656 4.344C14.146 2.832 12.137 2 10 2C7.863 2 5.854 2.832 4.344 4.344C2.833 5.854 2 7.863 2 10C2 12.137 2.833 14.146 4.344 15.656C5.854 17.168 7.863 18 10 18C11.799 18 13.504 17.404 14.9 16.314L20.293 21.706L21.707 20.293ZM10 16C8.397 16 6.891 15.376 5.758 14.243C4.624 13.11 4 11.603 4 10C4 8.398 4.624 6.891 5.758 5.758C6.891 4.624 8.397 4 10 4C11.603 4 13.109 4.624 14.242 5.758C15.376 6.891 16 8.398 16 10C16 11.603 15.376 13.11 14.242 14.243C13.109 15.376 11.603 16 10 16Z">
                                                    </path>
                                                </svg>
                                                <svg v-else aria-label="Clear" aria-hidden="false" role="img"
                                                    class="w-full h-full absolute top-0 left-0" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between items-center">
                                    <h2
                                        class="mt-4 mb-2 mr-5 ml-[30px] uppercase text-ellipsis whitespace-nowrap overflow-hidden text-xs tracking-[0.02em] font-semibold text-[#b5bac1] flex-1 box-border ">
                                        Pending — {{ friendsStore.pendingRequests.length }} <!-- Number of pending users -->
                                    </h2>
                                </div>
                                <div class="pb-2 mt-2  overflow-y-scroll h-full  ">
                                    <div>
                                        <!-- Pending User -->
                                        <div v-for="(friendRequest, index) in friendsStore.pendingRequests" :key="index"
                                            @contextmenu.prevent="showContextMenu($event, friendRequest.sender_id == authStore.user.id ? friendRequest.recipient : friendRequest.sender, 'pending')"
                                            class="h-[62px] opacity-100 flex flex-row ml-[30px] mr-5 font-medium text-base leading-5 box-border border-t border-solid border-[#4e50587a] hover:bg-[#393c41] hover:rounded-lg">
                                            <div class="flex flex-[0_1_100%] items-center leading-5 cursor-pointer">
                                                <div class="flex overflow-hidden">
                                                    <div
                                                        class="h-[32px] w-[32px] mr-3 mb-[6px] shrink-0 relative rounded-[50%]">
                                                        <img :src="$storage + 'icons/profiles/0.png'"
                                                            class="w-full h-full object-cover cursor-pointer rounded-3xl">
                                                    </div>
                                                </div>
                                                <div class="flex flex-col overflow-hidden pb-[7px]">
                                                    <div
                                                        class=" overflow-hidden flex-grow items-end justify-start leading-[17.6px]">
                                                        <span
                                                            class=" whitespace-nowrap text-ellipsis overflow-hidden block flex-initial font-semibold text-base text-[#f2f3f5]">
                                                            {{ friendRequest.sender_id == authStore.user.id ?
                                                                friendRequest.recipient.display_name :
                                                                friendRequest.sender.display_name
                                                            }}
                                                        </span>
                                                        <div class="text-xs font-medium text-[#b5bac1]">
                                                            {{ friendRequest.sender_id == authStore.user.id ? 'Outgoing Friend Request' : 'Incoming Friend Request' }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-if="friendRequest.sender_id == authStore.user.id"
                                                    @click.prevent="friendsStore.removeFriendRequest(friendRequest.id, index)"
                                                    class="w-9 h-9 rounded-[50%] flex ml-auto items-center justify-center bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                    <svg aria-hidden="true" role="img" class="w-5 h-5" width="24"
                                                        height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" class="group-hover:fill-[#f23f42]"
                                                            d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                        </path>
                                                    </svg>
                                                    <!-- check index. if it's the first element, add '-left-16', if it's not, add '-top-12' -->
                                                    <span :class="index == 0 ? '-left-16' : '-top-12'"
                                                        class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                        Cancel
                                                    </span>
                                                </div>
                                                <div v-else class="flex ml-auto">
                                                    <div @click="friendsStore.acceptFriendRequest(friendRequest.sender_id, index)"
                                                        class="flex ml-auto items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                class="group-hover:fill-[#23a559]" clip-rule="evenodd"
                                                                d="M8.99991 16.17L4.82991 12L3.40991 13.41L8.99991 19L20.9999 7.00003L19.5899 5.59003L8.99991 16.17Z">
                                                            </path>
                                                        </svg>
                                                        <!-- check index. if it's the first element, add '-left-20', if it's not, add '-top-12' -->
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                            Accept
                                                        </span>
                                                    </div>
                                                    <div @click="friendsStore.removeFriendRequest(friendRequest.id, index)"
                                                        class="flex ml-[10px] items-center justify-center w-9 h-9 rounded-[50%]  bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                        <svg aria-hidden="true" role="img" class="w-5 h-5" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" class="group-hover:fill-[#f23f42]"
                                                                d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                            </path>
                                                        </svg>
                                                        <!-- check index. if it's the first element, add '-left-16', if it's not, add '-top-12' -->
                                                        <span :class="index == 0 ? '-left-20' : '-top-12'"
                                                            class="absolute w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100 group-hover:fill-[#f23f42]">
                                                            Ignore
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- !Pending User -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- !Pending Tab -->
                        <!-- Blocked Tab -->
                        <div class="flex-1 overflow-auto h-full" :class="{ 'hidden': openTab !== 4 }">
                            <div class="flex flex-col h-full">
                                <div class="mt-4 mb-2 mr-5 ml-[30px]">
                                    <div
                                        class="p-[1px] flex items-center bg-[#1e1f22] focus-within:border-solid rounded focus-within:border-[#00a8fc]">
                                        <input v-model="searchBlockedUser" type="text"
                                            class="h-[30px] w-full px-2 m-[1px] bg-[#1e1f22] text-[#dbdee1] focus:ring-0 outline-0 border-0  placeholder:font-medium placeholder:text-base placeholder:leading-8 placeholder:text-[#777a7c]"
                                            placeholder="Search">
                                        <div class="text-[#b5bac1] w-8 h-8 flex justify-center items-center">
                                            <div class="w-5 h-5 relative">
                                                <svg v-if="!searchBlockedUser" class="w-full h-full absolute top-0 left-0"
                                                    aria-label="Search" aria-hidden="false" role="img" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M21.707 20.293L16.314 14.9C17.403 13.504 18 11.799 18 10C18 7.863 17.167 5.854 15.656 4.344C14.146 2.832 12.137 2 10 2C7.863 2 5.854 2.832 4.344 4.344C2.833 5.854 2 7.863 2 10C2 12.137 2.833 14.146 4.344 15.656C5.854 17.168 7.863 18 10 18C11.799 18 13.504 17.404 14.9 16.314L20.293 21.706L21.707 20.293ZM10 16C8.397 16 6.891 15.376 5.758 14.243C4.624 13.11 4 11.603 4 10C4 8.398 4.624 6.891 5.758 5.758C6.891 4.624 8.397 4 10 4C11.603 4 13.109 4.624 14.242 5.758C15.376 6.891 16 8.398 16 10C16 11.603 15.376 13.11 14.242 14.243C13.109 15.376 11.603 16 10 16Z">
                                                    </path>
                                                </svg>
                                                <svg v-else aria-label="Clear" aria-hidden="false" role="img"
                                                    class="w-full h-full absolute top-0 left-0" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M18.4 4L12 10.4L5.6 4L4 5.6L10.4 12L4 18.4L5.6 20L12 13.6L18.4 20L20 18.4L13.6 12L20 5.6L18.4 4Z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between items-center">
                                    <h2
                                        class="mt-4 mb-2 mr-5 ml-[30px] uppercase text-ellipsis whitespace-nowrap overflow-hidden text-xs tracking-[0.02em] font-semibold text-[#b5bac1] flex-1 box-border ">
                                        Blocked — {{ friendsStore.blocked.length }} <!-- Number of blocked users -->
                                    </h2>
                                </div>
                                <div class="pb-2 mt-2  overflow-y-scroll h-full  ">
                                    <div>
                                        <!-- Blocked User -->
                                        <div v-for="(blockedUser, index) in friendsStore.blockedUsers" :key="index"
                                            @contextmenu.prevent="showContextMenu($event, blockedUser.recipient, 'blocked')"
                                            class="h-[62px] opacity-100 flex flex-row ml-[30px] mr-5 font-medium text-base leading-5 box-border border-t border-solid border-[#4e50587a] hover:bg-[#393c41] hover:rounded-lg">
                                            <div class="flex flex-[0_1_100%] items-center leading-5 cursor-pointer">
                                                <div class="flex overflow-hidden">
                                                    <div
                                                        class="h-[32px] w-[32px] mr-3 mb-[6px] shrink-0 relative rounded-[50%]">
                                                        <img :src="$storage + 'icons/profiles/0.png'"
                                                            class="w-full h-full object-cover cursor-pointer rounded-3xl">
                                                    </div>
                                                </div>
                                                <div class="flex flex-col overflow-hidden pb-[7px]">
                                                    <div
                                                        class=" overflow-hidden flex-grow items-end justify-start leading-[17.6px]">
                                                        <span
                                                            class=" whitespace-nowrap text-ellipsis overflow-hidden block flex-initial font-semibold text-base text-[#f2f3f5]">
                                                            {{ blockedUser.recipient.display_name }}
                                                        </span>
                                                        <div class="text-xs font-medium text-[#b5bac1]">
                                                            Blocked
                                                        </div>
                                                    </div>
                                                </div>

                                                <div @click.prevent="friendsStore.unblockUser(blockedUser.recipient_id, index)"
                                                    class="w-9 h-9 rounded-[50%] flex ml-auto items-center justify-center bg-[#2b2d31] text-[#b5bac1] stroke-0 relative transition-all duration-150 ease-linear cursor-pointer group ">
                                                    <svg class="w-5 h-5" aria-hidden="true" role="img" width="24"
                                                        height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                                                            class=" group-hover:fill-[#f23f42]"
                                                            d="M20.2949 0.298996L21.7089 1.713L19.4169 4.006L21.7089 6.299L20.2949 7.713L18.0019 5.42L15.7099 7.713L14.2949 6.299L16.5879 4.006L14.2949 1.713L15.7099 0.298996L18.0019 2.592L20.2949 0.298996ZM8.00195 13.006C10.207 13.006 12.002 11.211 12.002 9.006C12.002 6.801 10.207 5.006 8.00195 5.006C5.79695 5.006 4.00195 6.801 4.00195 9.006C4.00195 11.211 5.79695 13.006 8.00195 13.006ZM8.00195 14.006C3.29095 14.006 0.00195312 16.473 0.00195312 20.006V21.006H16.002V20.006C16.002 16.473 12.713 14.006 8.00195 14.006Z">
                                                        </path>
                                                    </svg>
                                                    <span :class="index == 0 ? '-left-16' : '-top-12'"
                                                        class="absolute  w-auto p-2 m-2 min-w-max rounded-md shadow-md text-white bg-gray-900 text-xs font-bold scale-0 origin-left group-hover:scale-100">
                                                        Unblock
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- !Blocked User -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blocked Tab -->
                        <!-- Add Friend Tab -->
                        <div class="flex-1" :class="{ 'hidden': openTab !== 5 }">
                            <div class="flex w-full h-full">
                                <div class="px-[30px] py-5 flex-1 flex">
                                    <div class="w-full">
                                        <h2 class="text-base leading-5 font-semibold uppercase text-[#f2f3f5] mb-2">
                                            ADD FRIEND
                                        </h2>
                                        <form class="w-full" @submit.prevent="addFriend">
                                            <div class="text-sm leading-5 text-[#b5bac1]">
                                                You can add friends with their Discord username.
                                            </div>
                                            <div
                                                class="px-3 mt-4 flex items-center bg-[#1e1f22] rounded-lg border-[#1e1f22] border-[1px] focus-within:border-solid focus-within:border-[#00a8fc]">
                                                <div class="py-1 mr-4 w-full">
                                                    <input v-model="addFriendInput" type="text"
                                                        class="h-10 w-full bg-[#1e1f22] text-[#dbdee1] focus:ring-0 outline-0 border-0 p-0 placeholder:font-medium placeholder:text-base placeholder:leading-5 placeholder:text-[#4c4d50]"
                                                        placeholder="You can add friends with their Discord username.">
                                                </div>
                                                <button
                                                    class="h-8 px-3 py-0.5 w-auto text-sm leading-4 font-semibold rounded relative"
                                                    :class="addFriendInput ? 'text-[#e3e5f6] bg-[#5865f2]' : 'cursor-not-allowed text-[#828490] bg-[#3b428a]'">
                                                    <div class="whitespace-pre">
                                                        Send Friend Request
                                                    </div>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- !Add Friend Tab -->
                        <ContextMenu :contextMenu="contextMenu" @closeContextMenu="contextMenu.show = false" />
                        <FriendsActivity />
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script setup>
import DirectMessages from "../components/DirectMessages.vue";
import FriendsActivity from "../components/FriendsActivity.vue";

import { computed, onBeforeMount, onMounted, ref, watch } from "vue";
import { useFriendsStore } from "../stores/friends";
import { useAuthStore } from "../stores/auth";
import { userStatus } from "../constants/userStatus";
import { useRoute, useRouter } from "vue-router";
import ContextMenu from "../components/ContextMenu.vue";
import { useConversationsStore } from "../stores/conversations";

const authStore = useAuthStore();
const friendsStore = useFriendsStore();
const conversationsStore = useConversationsStore();

const route = useRoute();
const router = useRouter();

const openTab = ref(5);

const incomingRequests = ref(friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length);

const addFriendInput = ref('');
const searchOnlineUser = ref(null);
const searchAllUsers = ref(null);
const searchPendingUser = ref(null);
const searchBlockedUser = ref(null);
const contextMenu = ref({
    show: false,
    position: { x: 0, y: 0 },
    user: null,
    isBlocked: false,
    isFriend: false,
    blockedIndex: null,
    friendIndex: null,
    contextMenuItems: {
        message: true,
        block: true,
        friend: true
    }
});

const showContextMenu = (event, user, tab) => {

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
            console.log(friend);
            if (friend.id == user.id) {
                console.log('user is friend');
                contextMenu.value.isFriend = true;
                contextMenu.value.friendIndex = index;
                return true;
            }
        });

        if (!friend) {
            console.log('No friend found');

            contextMenu.value.isFriend = false;
            contextMenu.value.friendIndex = null;
        }

        if (tab == 'more') {
            contextMenu.value.contextMenuItems.block = false;
            contextMenu.value.contextMenuItems.message = false;
        } else {
            contextMenu.value.contextMenuItems.block = true;
            contextMenu.value.contextMenuItems.message = true;
        }

        if (tab == 'blocked') {
            contextMenu.value.contextMenuItems.friend = false;
        }


        contextMenu.value.user = user;
        contextMenu.value.show = true;
        console.log(contextMenu.value.contextMenuItems);
    }
}

const goToConversation = async (recipientId) => {
    let conversation = await conversationsStore.redirectToConversation(recipientId);
    console.log(conversation);
    router.push({ name: 'conversation', params: { conversation: conversation.id } });
}


const toggleTabs = (tabNumber) => {
    openTab.value = tabNumber
}

const onlineFriends = computed(() => {
    const online = [];

    friendsStore.userFriends.forEach(friend => {
        if (friend.status == userStatus.ONLINE) {
            online.push(friend);
        }
    });

    return online;
});

const addFriend = () => {
    friendsStore.addFriend(addFriendInput.value)
        .then(() => {
            addFriendInput.value = '';
        });
}

watch(
    () => friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length,
    () => { incomingRequests.value = friendsStore.pendingRequests.filter(request => request.recipient_id == authStore.user.id).length },
);


onBeforeMount(async () => {
    await friendsStore.getPendingFriendships();
    await friendsStore.getFriends();
    await friendsStore.getBlockedUsers();
})

onMounted(() => {
    // Detect click outside context menu
    window.addEventListener('click', () => {
        contextMenu.value.show = false;
    });

})
</script>

<style></style>

import { defineStore } from "pinia";
import axios from "axios";
import { useFriendsStore } from "./friends";
import { useConversationsStore } from "./conversations";
import { userStatus } from "../constants/userStatus";

import Echo from '@ably/laravel-echo';
import * as Ably from 'ably';


export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        authErrors: [],
        authStatus: null,
        token: null,
        currentOnlineUsers: []
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors,
        status: (state) => state.authStatus,
        onlineUsers: (state) => state.currentOnlineUsers,
        friendsStore: (state) => useFriendsStore(),
        conversationsStore: (state) => useConversationsStore(),
    },
    actions: {
        async getToken() {
            await axios.get("/sanctum/csrf-cookie");
        },
        async getUser() {
            const data = await axios.get("/api/user");
            this.authUser = data.data;
        },
        async connectToAbly() {
            try {
                window.Ably = Ably;
                window.Echo = new Echo({
                    broadcaster: 'ably',
                });
                // Register a callback for listing to connection state change
                window.Echo.connector.ably.connection.on((stateChange) => {
                    if (stateChange.current === 'connected') {
                        console.log('Connected to Ably');
                    }
                    console.log("LOGGER:: Connection event :: ", stateChange);
                    if (stateChange.current === 'disconnected' && stateChange.reason?.code === 40142) { // key/token status expired
                        console.log("LOGGER:: Connection token expired https://help.ably.io/error/40142");
                    }
                    if (stateChange.current === 'disconnected') {
                        window.Echo.connector.ably.connect();
                    }
                });

            } catch (error) {
                console.log(error);
                this.connectToAbly();
            }
        },
        async subscribeToUserChannel() {
            if (this.user) {
                await window.Echo.join('user:' + this.user.id)
                    .subscribed(function () {
                    })
                    .listen('.friend.new', (data) => {
                        if (data.status == 'pending') {
                        }
                        this.friendsStore.pendingRequests.push(data.request)
                    })
                    .listen('.friend.accepted', (data) => {
                        data.friendRequest.recipient.status = userStatus.ONLINE;
                        this.friendsStore.userFriends.push(data.friendRequest.recipient);
                        this.friendsStore.pendingRequests.find((request, i) => {
                            if (request.id === data.friendRequest.id) {
                                this.friendsStore.pendingRequests.splice(i, 1);
                                return true;
                            }
                        });
                    })
                    .listen('.friend.requestDeleted', (data) => {
                        this.friendsStore.pendingRequests.find((request, i) => {
                            if (request.id === data.deletedRequest.id) {
                                this.friendsStore.pendingRequests.splice(i, 1);
                                return true;
                            }
                        });
                    })
                    .listen('.friend.blocked', (data) => {
                        this.friendsStore.userFriends.find((friend, i) => {
                            if (friend.id === data.blockedBy.id) {
                                this.friendsStore.userFriends.splice(i, 1);
                                return true;
                            }
                        });
                    })
                    .listen('.directMessage.notification', (data) => {
                        if (this.conversationsStore.conversationNotifications.length <= 0) {
                            this.conversationsStore.conversationNotifications.push(data.notification);

                        } else {
                            let notification = this.conversationsStore.conversationNotifications.find((notification, i) => {
                                if (notification.id == data.notification.id) {
                                    notification.counter++;
                                    return true;
                                }
                            });

                            // If there is no notification found, add a conversation
                            if (notification == undefined) {
                                this.conversationsStore.conversationNotifications.push(data.notification);
                            }
                        }

                        let conversation = this.conversationsStore.userConversations.find((conversation, index) => {
                            if (conversation.id == data.notification.conversation_id) {
                                return true;
                            } else {
                            }
                        });

                        // If there is no conversation found, add a conversation
                        if (conversation == undefined) {
                            this.conversationsStore.userConversations.push(data.notification.conversation);
                        }
                    });
            }
        },
        async subscribeToPresenceChannel() {
            await window.Echo.join('all')
                .here(users => {
                    this.currentOnlineUsers = users;
                    users.every((user) => {
                        this.friendsStore.userFriends.find((friend, i) => {
                            if (user.id == friend.id) {
                                this.friendsStore.userFriends[i].status = userStatus.ONLINE;
                                return true
                            }
                        });
                    });
                })
                .joining((user) => {
                    this.friendsStore.userFriends.find((friend, i) => {
                        if (user.id == friend.id) {
                            this.friendsStore.userFriends[i].status = userStatus.ONLINE;
                            return true;
                        }
                    });
                    this.currentOnlineUsers.find((onlineUser) => {
                        if (onlineUser.id == user.id) {
                            this.currentOnlineUsers.push(user)
                        }
                    });
                })
                .leaving(async (user) => {
                    this.currentOnlineUsers.find((onlineUser, i) => {
                        if (onlineUser.id == user.id) {
                            this.currentOnlineUsers.splice(i, 1);
                        }
                    });

                    await this.friendsStore.userFriends.find((friend, i) => {
                        if (user.id == friend.id) {
                            this.friendsStore.userFriends[i].status = userStatus.OFFLINE;
                            return true
                        }
                    });
                });

        },
        async disconnectFromAbly() {
            window.Echo.leave('user:' + this.user.id);
            window.Echo.leave('all');
        },
        async handleLogin(data) {
            this.authErrors = [];

            await this.getToken();

            try {
                await axios.post('/login', {
                    email: data.email,
                    password: data.password
                })
                    .then(async () => {
                        await this.getUser();
                        this.router.push({ name: 'dashboard' });
                    });

            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleRegistration(data) {
            this.authErrors = [];

            await this.getToken();

            data.dob = `${data.dob.year}-${data.dob.month}-${data.dob.day}`;

            try {
                await axios.post('/register', {
                    username: data.username,
                    display_name: data.display_name,
                    email: data.email,
                    password: data.password,
                    dob: data.dob
                })
                    .then(async () => {
                        this.handleLogin({ email: data.email, password: data.password })
                    });
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleLogout() {
            await this.disconnectFromAbly();
            await axios.post('/logout');
            this.router.push({ name: 'login' });
            this.authUser = null;
        },
        async handleForgotPassword(email) {
            this.authErrors = [];

            await this.getToken();

            try {
                const response = await axios.post('/forgot-password', {
                    email: email
                });
                this.authStatus = response.data.status;
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors
                }
            }
        },
        async handleResetPassword(resetData) {
            this.authErrors = [];

            try {
                const response = await axios.post('/reset-password', resetData);
                this.authStatus = response.data.status;
                this.router.push({ name: 'login' });
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        }
    },
    persist: true,
});

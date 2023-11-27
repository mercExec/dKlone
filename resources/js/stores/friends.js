import { defineStore } from "pinia";
import axios from "axios";
import { userStatus } from "../constants/userStatus";
import { useAuthStore } from "./auth";

export const useFriendsStore = defineStore("friends", {
    state: () => ({
        userFriends: [],
        pendingRequests: [],
        blockedUsers: [],
    }),
    getters: {
        friends: (state) => state.userFriends,
        pending: (state) => state.pendingRequests,
        blocked: (state) => state.blockedUsers,
    },
    actions: {
        async addFriend(username) {
            // Remove recipient from blocked list if he exists
            this.blockedUsers.find((blocked, index) => {
                if (blocked.username == username) {
                    this.blockedUsers.splice(index, 1);
                    console.log('found blocked user. Removing...');
                    return true;
                }
            });

            let pendingRequestIndex = null;
            // Check if a pending request for the same recipient exists
            let hasRequest = this.pendingRequests.find((request, index) => {
                console.log(request.sender.username, username);
                if (request.sender.username == username) {
                    console.log('pending request found.');
                    pendingRequestIndex = index;
                    console.log(pendingRequestIndex);
                    return true;
                }
            });

            // console.log('pending request exists: ', hasRequest);
            await axios.post('/api/addFriend/' + username)
                .then(res => {
                    if (res.data.status == 'pending') {
                        console.log('adding pending request');
                        this.pendingRequests.push(res.data);
                    } else if (res.data.status == 'accepted') {
                        console.log('request already exists. adding to friends');

                        let friend = res.data.recipient.username == username ? res.data.recipient : res.data.sender;
                        console.log(friend);
                        friend.status = userStatus.OFFLINE;

                        const authStore = useAuthStore();
                        authStore.onlineUsers.find((user) => {
                            console.log(user);
                            if (user.id == friend.id) {
                                console.log('User is online.');
                                friend.status = userStatus.ONLINE;
                            }
                        });

                        this.userFriends.push(friend);

                        if (pendingRequestIndex >= 0 && pendingRequestIndex !== undefined) {
                            console.log('pending request found. removing...');
                            this.pendingRequests.splice(pendingRequestIndex, 1);
                        }
                    }

                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        async acceptFriendRequest(senderId, index) {
            await axios.post('/api/acceptFriendRequest/' + senderId)
                .then((res) => {
                    let friend = res.data;
                    friend.status = userStatus.OFFLINE;

                    const authStore = useAuthStore();
                    authStore.onlineUsers.find((user) => {
                        if (user.id == friend.id) {
                            console.log('User is online.');
                            friend.status = userStatus.ONLINE;
                        }
                    });

                    this.userFriends.push(friend);
                    this.pendingRequests.splice(index, 1);

                    console.log(res.data);
                });
        },
        async removeFriend(userId) {
            await axios.post('/api/removeFriend/' + userId);
        },
        async removeFriendRequest(requestId, index) {
            await axios.post('/api/removeFriendRequest/' + requestId)
                .then((res) => {
                    this.pendingRequests.splice(index, 1);
                    // console.log(res.data);
                });
        },
        async getFriends() {
            await axios('/api/getFriends')
                .then(res => {
                    // console.log(res.data);
                    this.userFriends = res.data;
                });
        },
        async getPendingFriendships() {
            await axios.get('/api/getPendingFriendships')
                .then(res => {
                    console.log(res.data);
                    this.pendingRequests = res.data;
                });
        },
        async blockUser(userId) {
            console.log('Blocking user');
            this.pendingRequests.find((request, index) => {
                if (request.recipient_id == userId) {
                    this.pendingRequests.splice(index, 1);
                    console.log('found friend request. Removing...');
                    return true;
                }
            });
            this.userFriends.find((friend, index) => {
                if (friend.id == userId) {
                    this.userFriends.splice(index, 1);
                    console.log('found friend. Removing...');
                    return true;
                }
            });
            await axios.post('/api/blockUser/' + userId)
                .then(res => {
                    console.log(res.data);
                    this.blockedUsers.push(res.data)
                });
        },
        async unblockUser(userId) {
            console.log('Unblocking user');
            this.blockedUsers.find((blocked, index) => {
                if (blocked.recipient_id == userId) {
                    this.blockedUsers.splice(index, 1);
                    console.log('found blocked user. Removing...');
                    return true;
                }
            });
            await axios.post('/api/unblockUser/' + userId)
                .then(async (res) => {
                    // console.log(res.data);
                    await this.getBlockedUsers();
                });
        },
        async getBlockedUsers() {
            await axios.get('/api/getBlockedUsers')
                .then(res => {
                    // console.log(res.data);
                    this.blockedUsers = res.data;
                });
        },
    },
    persist: true,
});

import { defineStore } from "pinia";
import axios from "axios";

export const useConversationsStore = defineStore("conversations", {
    state: () => ({
        userConversations: [],
        selectedConversation: null,
        conversationNotifications: [],
    }),
    getters: {
        conversations: (state) => state.userConversations,
        selected: (state) => state.selectedConversation,
        notifications: (state) => state.conversationNotifications
    },
    actions: {
        async getConversations() {

            await axios('/api/getConversations')
                .then(res => {
                    console.log(res.data);
                    this.userConversations = res.data.conversations;
                });
        },
        async getNotifications() {

            await axios('/api/getNotifications')
                .then(res => {
                    console.log(res.data);
                    this.conversationNotifications = res.data.notifications;
                });
        },
        async getConversation(conversationId) {
            await axios.get('/api/getConversation/' + conversationId)
                .then((res) => {
                    // console.log(res.data);
                    this.selectedConversation = res.data;
                });
        },
        async deleteConversation(conversationsId, index) {
            this.userConversations.splice(index, 1);
            this.conversationNotifications.find((notification, index) => {
                if (notification.conversation_id == conversationsId) {
                    this.conversationNotifications.splice(index, 1);
                    return true;
                }
            });
            await axios.post('/api/deleteConversation/' + conversationsId);
        },
        async redirectToConversation(recipientId) {
            let conversation = null;
            await axios.get('/api/checkConversationExists/' + recipientId)
                .then(res => {
                    console.log(res.data);
                    conversation = res.data;
                });
            return conversation;
        }
    },
    persist: true,
});

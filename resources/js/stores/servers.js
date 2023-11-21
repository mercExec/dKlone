import { defineStore } from "pinia";
import axios from "axios";
import { useRouter } from "vue-router";

export const useServersStore = defineStore("servers", {
    state: () => ({
        userServers: [],
        selectedServer: null,
        selectedChannel: null
    }),
    getters: {
        servers: (state) => state.userServers,
        server: (state) => state.selectedServer,
        channel: (state) => state.selectedChannel
    },
    actions: {
        async getServers() {
            await axios('/api/getServers')
                .then(res => {
                    // console.log(res);
                    this.userServers = res.data;
                });
        },
        async getServer(serverId) {
            await axios.get('/api/getServer/' + serverId)
                .then(res => {
                    console.log(res.data);
                    this.selectedServer = res.data;
                });
        },
        async addServer(server) {
            this.userServers.push(server);
        },
        async addChannel(channel) {
            this.selectedServer.channels.push(channel);
        },
        async joinServer(serverId) {
            let server = '';
            await axios.post('/api/joinServer/' + serverId)
                .then(res => {
                    server = res.data;

                    // Add server to servers list if the user hasn't already joined the server
                    if (!res.data.hasOwnProperty('already_joined')) {
                        console.log('Adding server');
                        this.addServer(res.data.server);
                    }
                });
            return server;
        }
    },
    persist: true,
});

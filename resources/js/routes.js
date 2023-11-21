import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/js/views/Home.vue'
import Server from '@/js/views/Server.vue'
import Channel from '@/js/views/Channel.vue'
import Login from '@/js/views/Login.vue'
import Test from '@/js/views/Test.vue'
import Register from '@/js/views/Register.vue'
import Friends from '@/js/views/Friends.vue'
import Conversation from '@/js/views/Conversation.vue'
import ExploreServers from '@/js/views/ExploreServers.vue'
import { useAuthStore } from './stores/auth';


const routes = [
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
    { path: '/test', name: 'test', component: Test },

    {
        path: '/',
        component: Home,
        name: 'base',
        children: [
            {
                path: 'me', name: 'dashboard', component: Friends, meta: { requiresAuth: true }, children: [
                    { path: ':conversation', name: 'conversation', component: Conversation, meta: { requiresAuth: true }}
                ]
            },
            {
                path: 'channels/:server', name: 'server', component: Server, meta: { requiresAuth: true }, children: [
                    { path: ':channel', name: 'channel', component: Channel, meta: { requiresAuth: true } },
                ]
            },
            {
                path: 'guild-discovery', name: 'explore', component: ExploreServers, meta: { requiresAuth: true }
            }

        ]
    },
    // ...
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();

    let isAuthenticated = authStore.user;

    // check route meta if it requires auth or not
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            return next({
                name: 'login'
            });
        }
    }

    if (isAuthenticated && (to.name == 'login' || to.name == 'register')) {
        return next({
            name: 'dashboard'
        });
    }

    if (to.name == 'base') {
        if (isAuthenticated) {
            return next({
                name: 'dashboard'
            });
        } else {
            return next({
                name: 'login'
            });
        }
    }

    return next();
});

export default router;

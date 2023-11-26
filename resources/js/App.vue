<template>
    <router-view></router-view>
</template>

<script setup>
import axios from "axios";
import { useAuthStore } from "./stores/auth";

const authStore = useAuthStore();

axios.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
        authStore.handleLogout();
    }
    return Promise.reject(error);
  }
);

</script>
<style></style>

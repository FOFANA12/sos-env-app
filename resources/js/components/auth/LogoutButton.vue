<template>
  <button
    @click="handleLogout"
    class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left"
    :disabled="loading"
  >
    <Loader2 v-if="loading" class="w-4 h-4 mr-2 animate-spin" />
    <LogOut v-else class="w-4 h-4 mr-2" />
    {{ t("menus.logout") }}
  </button>
</template>

<script setup>
import { useAuthStore } from "@/js/store";
import { LogOut, Loader2 } from "lucide-vue-next";
import { route } from "ziggy-js";

const store = useAuthStore();
const loading = ref(false);

const handleLogout = async () => {
  loading.value = true;
  try {
    await store.logout();
    window.location.href = route("web.logout.redirect");
  } catch (error) {
  } finally {
    loading.value = false;
  }
};
</script>

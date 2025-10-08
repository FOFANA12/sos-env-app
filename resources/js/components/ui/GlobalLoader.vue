<template>
  <Loader
    v-model:active="loaderStore.isLoading"
    :can-cancel="loaderStore.canCancel"
    :is-full-page="loaderStore.fullPage"
    :color="loaderStore.color"
    :width="loaderStore.width"
    :height="loaderStore.height"
  />
</template>

<script setup>
import { useLoaderStore } from "@/js/store";
import Loader from "vue-loading-overlay";

const loaderStore = useLoaderStore();
</script>

<template>
  <div
    v-if="isLoading || hasError"
    class="fixed inset-0 flex items-center justify-center bg-white/30 backdrop-blur-sm z-50"
>
    <SkeletonLoader
      v-if="isLoading"
      :rows="5"
      height="h-4"
      class="w-full max-w-md"
    />
    <FetchError
      v-else
      :message="errorMessage"
      :onRetry="onRetry"
      class="w-full max-w-md"
    />
  </div>

  <div v-else>
    <slot />
  </div>
</template>

<script setup>
import SkeletonLoader from "@/js/components/ui/SkeletonLoader.vue";
import FetchError from "@/js/components/ui/FetchError.vue";

defineProps({
  isLoading: Boolean,
  hasError: Boolean,
  errorMessage: {
    type: String,
    default: "An error has occurred",
  },
  onRetry: Function,
});
</script>

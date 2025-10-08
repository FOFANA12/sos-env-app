<script setup>
import { Loader } from 'lucide-vue-next';

const props = defineProps({
  busy: {
    type: Boolean,
    default: false,
  },
  block: {
    type: Boolean,
    default: false,
  },
  customClass: {
    type: String,
    default: '',
  },
});
</script>

<template>
  <button
    type="submit"
    :disabled="busy"
    :class="[
      'flex items-center justify-center rounded-lg transition duration-150 font-medium',
      'bg-primary-500 hover:bg-primary-600',
      'py-2 px-4 text-sm',
      block ? 'w-full' : 'min-w-[100px]',
      busy ? 'cursor-not-allowed opacity-75' : '',
      customClass,
    ]"
  >
    <template v-if="busy">
      <!-- Spinner & loading icon -->
      <Loader class="animate-spin mr-2 h-5 w-5" />
      <slot name="loading">Loading...</slot>
    </template>
    <template v-else>
      <slot name="default">Submit</slot>
    </template>
  </button>
</template>

<style scoped></style>

<template>
    <div class="flex flex-col items-center justify-center text-center space-y-4">
      <div
        class="bg-white rounded-xl shadow-sm border-t-4 border-t-red-500 p-6 w-full"
      >
        <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4">
          <AlertTriangle class="h-10 w-10 text-red-600" />
        </div>
  
        <p class="text-base text-gray-700 whitespace-pre-line break-words">
          {{ message }}
        </p>
  
        <button
          @click="$emit('retry')"
          class="mt-4 px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg"
        >
          {{ t('common.buttons.errorRetry') }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { AlertTriangle } from 'lucide-vue-next';
  
  defineProps({
    message: {
      type: String,
      default: 'An unexpected error occurred.',
    },
  });
  
  defineEmits(['retry']);
  </script>
  
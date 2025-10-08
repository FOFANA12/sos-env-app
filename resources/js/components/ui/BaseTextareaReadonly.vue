<template>
  <div>
    <label
      v-if="label"
      :for="id"
      class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
    >
      {{ label }}
    </label>

    <textarea
      :id="id"
      :name="name"
      :rows="rows"
      :placeholder="placeholder"
      disabled
      readonly
      class="w-full py-2.5 px-3 rounded-lg border text-sm bg-gray-50 text-gray-800 cursor-not-allowed border-gray-300 resize-none"
      >{{ modelValue }}</textarea
    >
  </div>
</template>

<script setup>
defineProps({
  modelValue: String,
  name: String,
  id: String,
  label: String,
  placeholder: String,
  rows: {
    type: Number,
    default: 4,
  },
});
</script>

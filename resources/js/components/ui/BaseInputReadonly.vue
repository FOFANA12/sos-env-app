<template>
  <div>
    <label
      v-if="label"
      :for="id"
      class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400"
    >
      {{ label }}
    </label>

    <input
      :id="id"
      :name="name"
      :type="type"
      :value="modelValue"
      :placeholder="placeholder"
      disabled
      readonly
      class="w-full py-2.5 px-3 rounded-lg border text-sm bg-gray-50 text-gray-800 cursor-not-allowed border-gray-300"
    />
  </div>
</template>

<script setup>
defineProps({
  modelValue: [String, Number],
  name: String,
  id: String,
  type: {
    type: String,
    default: 'text',
  },
  label: String,
  placeholder: String,
});
</script>

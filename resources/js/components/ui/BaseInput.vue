<template>
  <div>
    <!-- Label -->
    <label
      :for="id"
      class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-400"
    >
      {{ label }}
      <span v-if="required" class="required-star">*</span>
    </label>

    <!-- Input with optional icon and action slot -->
    <div class="relative">
      <slot name="icon" />
      <input
        :id="id"
        :name="name"
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        :class="[
          'w-full py-2.5 px-3 rounded-lg text-sm text-gray-800 bg-white dark:bg-transparent border focus:outline-none',
          error
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500/10'
            : 'border-gray-300 focus:border-primary-300 focus:ring-primary-500/10',
          inputClass,
        ]"
      />
      <slot name="action" />
    </div>

    <!-- Error message -->
    <p v-if="error" class="text-red-500 text-xs mt-1">{{ error }}</p>

    <!-- Optional hint text -->
    <p v-if="$slots.hint" class="text-gray-500 text-xs mt-1">
      <slot name="hint" />
    </p>
  </div>
</template>

<script setup>
defineProps({
  modelValue: [String, Number],
  name: String,
  id: String,
  type: {
    type: String,
    default: "text",
  },
  label: String,
  placeholder: String,
  error: String,
  required: Boolean,
  autocomplete: {
    type: String,
    default: "off",
  },
  inputClass: {
    type: [String, Array, Object],
    default: "",
  },
});

defineEmits(["update:modelValue"]);
</script>

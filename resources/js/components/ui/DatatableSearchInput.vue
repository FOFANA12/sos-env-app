<template>
    <div class="relative w-full">
      <input
        v-model="input"
        @keyup.enter="handleSearch"
        type="text"
        :placeholder="placeholder"
        :class="[
          'w-full pl-10 pr-4 rounded-lg text-gray-800 bg-white border border-gray-300 focus:outline-none',
          heightClass,
        ]"
      />
      <Search
        class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, watch, nextTick, computed } from 'vue';
  import { Search } from 'lucide-vue-next';
  
  const props = defineProps({
    modelValue: String,
    placeholder: {
      type: String,
      default: 'Recherche...',
    },
    size: {
      type: String,
      default: 'md', // 'sm', 'md', 'lg'
      validator: (val) => ['sm', 'md', 'lg'].includes(val),
    },
  });
  
  const emit = defineEmits(['update:modelValue', 'search']);
  const input = ref(props.modelValue || '');
  
  watch(
    () => props.modelValue,
    (val) => {
      if (val !== input.value) input.value = val;
    }
  );
  
  const heightClass = computed(() => {
    switch (props.size) {
      case 'sm':
        return 'py-1 text-xs h-8';
      case 'lg':
        return 'py-3 text-base h-12';
      default:
        return 'py-2 text-sm h-10';
    }
  });
  
  function handleSearch() {
    emit('update:modelValue', input.value);
    nextTick(() => {
      emit('search');
    });
  }
  </script>
  
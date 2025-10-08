<template>
  <button
    :class="[
      'flex items-center py-2 px-3 rounded-lg transition-colors text-sm',
      variantClasses,
      customClass,
    ]"
    @click="onClick"
  >
    <component v-if="icon" :is="icon" class="w-4 h-4 mr-1" />
    <slot />
  </button>
</template>
  
  <script setup>
import { computed } from 'vue';

const props = defineProps({
  icon: {
    type: [Object, Function],
    default: null,
  },
  variant: {
    type: String,
    default: null, // Pas de style par défaut si non défini
  },
  customClass: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['click']);
const onClick = (e) => emit('click', e);

const variantClasses = computed(() => {
  switch (props.variant) {
    case 'primary':
      return 'bg-primary-500 text-white hover:bg-primary-600 border border-transparent box-border';
    case 'danger':
      return 'bg-red-500 text-white hover:bg-red-600 border border-transparent box-border';
    case 'danger-outline':
      return 'border border-red-500 text-red-500 hover:bg-red-500 hover:text-white';
    case 'secondary':
      return 'bg-gray-200 text-gray-800 hover:bg-gray-300 border border-transparent box-border';
    default:
      return '';
  }
});
</script>
  
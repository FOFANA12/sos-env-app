<template>
  <span v-if="!status" :class="[baseClass, variantClass, props.class]">
    <slot>{{ resolvedText }}</slot>
  </span>

  <div
    v-else
    class="inline-flex items-center gap-2 rounded-md py-1 text-sm font-medium"
    :class="[props.class]"
  >
    <Circle :size="16" :style="{ color: status.color }" />
   <span>{{ statusLabel }}</span>
  </div>
</template>

<script setup>
import { Circle } from 'lucide-vue-next';

const { t } = useI18n();

const props = defineProps({
  status: {
    type: Object, // { label, color }
    default: null,
  },
  variant: {
    type: String,
    default: 'default',
  },
  defaultText: {
    type: String,
    default: '',
  },
  class: {
    type: String,
    default: '',
  },
});

const baseClass = 'inline-block rounded-md px-2 py-1 text-xs';

const variantClass = computed(() => {
  switch (props.variant) {
    case 'success':
      return 'bg-green-100 text-green-800';
    case 'error':
      return 'bg-red-100 text-red-700';
    default:
      return 'bg-gray-200 text-gray-800';
  }
});

const statusLabel = computed(() => props.status?.label ?? props.status?.name ?? '-');

const resolvedText = computed(() => {
  if (props.defaultText) return props.defaultText;

  switch (props.variant) {
    case 'success':
      return t('common.table.status.active');
    case 'error':
      return t('common.table.status.inactive');
    default:
      return '-';
  }
});
</script>

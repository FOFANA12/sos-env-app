<template>
  <div :class="['space-y-2 animate-pulse', className]">
    <div
      v-for="i in rows"
      :key="i"
      :class="['bg-gray-300', height, rounded]"
      :style="{ width: getWidth(i) }"
    />
  </div>
</template>
  
<script setup>
    const props = defineProps({
    rows: { type: Number, default: 1 },
    className: { type: String, default: '' },
    height: { type: String, default: 'h-4' },
    rounded: { type: String, default: 'rounded-md' },
    widths: {
        type: Array,
        default: () => ['100%', '90%', '95%', '80%', '70%'],
    },
    });

    const getWidth = (index) => {
    return props.widths[(index - 1) % props.widths.length];
    };
</script>
  
<template>
  <a
    :href="href"
    :class="[
      'flex items-center py-2 px-3 rounded-lg transition-colors text-sm',
      variantClasses,
      customClass,
    ]"
  >
    <component v-if="icon" :is="icon" class="w-4 h-4 mr-1" />
    <slot />
  </a>
</template>

<script setup>
import { route } from "ziggy-js";

const props = defineProps({
  to: {
    type: [String, Object], // string (nom de route) ou object { name, params }
    required: true,
  },
  icon: {
    type: [Object, Function],
    default: null,
  },
  variant: {
    type: String,
    default: null,
  },
  customClass: {
    type: String,
    default: "",
  },
});

const href = computed(() => {
  if (typeof props.to === "string") {
    return route(props.to);
  }
  if (typeof props.to === "object" && props.to.name) {
    return route(props.to.name, props.to.params || {});
  }
  return "#";
});

const variantClasses = computed(() => {
  switch (props.variant) {
    case "primary":
      return "bg-primary-500 text-white hover:bg-primary-600 border border-transparent";
    case "danger":
      return "bg-red-500 text-white hover:bg-red-600 border border-transparent";
    case "danger-outline":
      return "border border-red-500 text-red-500 hover:bg-red-500 hover:text-white";
    case "secondary":
      return "bg-gray-200 text-gray-800 hover:bg-gray-300 border border-transparent";
    default:
      return "";
  }
});
</script>

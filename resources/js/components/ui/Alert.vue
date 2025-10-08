<template>
  <div :class="alertClasses" role="alert">
    <strong class="font-bold" v-if="title">{{ title }}</strong>

    <slot v-if="$slots.default"></slot>
    <span v-else class="block sm:inline">{{ message }}</span>

    <span
      v-if="closable"
      @click="closeAlert"
      class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer flex items-center"
    >
      <svg
        class="fill-current h-5 w-5"
        :class="iconColor"
        role="button"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path
          d="M14.348 14.849a1 1 0 01-1.414 0L10 11.415l-2.934 2.934a1 1 0 01-1.414-1.414l2.934-2.934-2.934-2.934a1 1 0 011.414-1.414l2.934 2.934 2.934-2.934a1 1 0 011.414 1.414L11.415 10l2.934 2.934a1 1 0 010 1.415z"
        />
      </svg>
    </span>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, computed } from "vue";

const props = defineProps({
  type: {
    type: String,
    default: "danger",
  },
  title: {
    type: String,
    default: null,
  },
  message: {
    type: String,
    default: null,
  },
  closable: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(["close"]);

const closeAlert = () => {
  emit("close");
};

const alertClasses = computed(() => {
  const base =
    "relative w-full px-5 py-4 border rounded-lg flex items-start gap-3";
  switch (props.type) {
    case "success":
      return `${base} bg-green-100 border-green-400 text-green-700`;
    case "warning":
      return `${base} bg-yellow-100 border-yellow-400 text-yellow-700`;
    case "info":
      return `${base} bg-blue-100 border-blue-400 text-blue-700`;
    default:
      return `${base} bg-red-100 border-red-400 text-red-700`;
  }
});

const iconColor = computed(() => {
  switch (props.type) {
    case "success":
      return "text-green-700";
    case "warning":
      return "text-yellow-700";
    case "info":
      return "text-blue-700";
    default:
      return "text-red-700";
  }
});
</script>
